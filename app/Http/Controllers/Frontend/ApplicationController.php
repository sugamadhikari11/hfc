<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog\Blog;
use App\Models\News\News;
use App\Models\Page\Page;
use App\Models\Team\Team;
use Illuminate\Http\Request;
use App\Models\Contact\Contact;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\GalleryCategory;
use App\Models\Project\Project;
use App\Models\Setting\Setting;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogComments;
use App\Http\Controllers\Controller;
use App\Models\Gallery\GalleryImage;
use Illuminate\Support\Facades\Mail;
use App\Models\Testimonial\Testimonial;

class ApplicationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // Get company settings
        $settings = Setting::first();

        // Get testimonials
        $testimonials = Testimonial::where('status', true)
            ->latest()
            ->get();

        // Get team members
        $team = Team::with('memberType')

            ->latest()
            ->take(3)
            ->get();

        // Get about us page content
        $aboutPage = Page::where('slug', 'about-us')
            ->first();

        $whyChooseUs = Page::where('slug', 'why-choose-us')->first();
        $features = null;

        if ($whyChooseUs) {
            $features = Page::where('parent_id', $whyChooseUs->id)
                ->where('page_section_name', 'feature')
                ->where('is_published', 1)
                ->get();
        }
        // Get projects for portfolio section
        $projects = Project::latest()
            ->get();

        $heroFeatures = Page::where('page_section_name', 'like', 'hero-feature%')
            ->where('is_published', 1)
            ->take(5) // Limit to 5 features for hero section
            ->get();

        // Add to view data
        $this->data('heroFeatures', $heroFeatures);

        // Get gallery images
        $gallery = Gallery::latest()
            ->take(8)
            ->get();

        // Get blogs for the latest posts section
        $latestBlogs = Blog::latest()
            ->take(3)
            ->get();

        $services = Page::where('parent_id', function ($query) {
            $query->select('id')
                ->from('pages')
                ->where('slug', 'services');
        })
            ->where('is_published', 1)
            ->take(3) // Limit to 6 services for the homepage
            ->latest()
            ->get();

        $this->data('services', $services);

        $this->data('settings', $settings);
        $this->data('testimonials', $testimonials);
        $this->data('team', $team);
        $this->data('aboutPage', $aboutPage);
        $this->data('whyChooseUs', $whyChooseUs);
        $this->data('features', $features);
        $this->data('projects', $projects);
        $this->data('gallery', $gallery);
        $this->data('latestBlogs', $latestBlogs);

        return view('frontend.pages.home.home', $this->data);
    }

    // Other methods remain unchanged
    public function contact()
    {
        $settings = \App\Models\Setting\Setting::first();

        $agents = \App\Models\Team\Team::with('memberType')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('frontend.pages.contact.index', [
            'settings' => $settings,
            'agents' => $agents
        ]);
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'pending'
        ]);



        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
    public function about()
    {
        $aboutPage = Page::where('slug', 'about-us')
            ->where('is_published', 1)
            ->first();

        $settings = Setting::first();

        $team = Team::with('memberType')->latest()->take(6)->get();

        return view('frontend.pages.about.index', [
            'aboutPage' => $aboutPage,
            'settings' => $settings,
            'team' => $team
        ]);
    }

    // Add these methods to your existing ApplicationController class
    public function blogs(Request $request, $slug = null)
    {
        if ($slug) {
            return $this->blogDetail($request, $slug);
        }

        $query = Blog::where('is_published', true);

        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Get paginated results
        $blogs = $query->latest()->paginate(6);

        // Get categories with post counts for sidebar
        $categories = BlogCategory::withCount('blogs')->get();

        // Get recent posts for sidebar
        $recentPosts = Blog::where('is_published', true)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.pages.blogs.index', [
            'blogs' => $blogs,
            'categories' => $categories,
            'recentPosts' => $recentPosts
        ]);
    }

    public function blogDetail(Request $request, $slug)
    {
        $blog = Blog::with(['user', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $categories = BlogCategory::withCount('blogs')->get();

        // Get recent posts for sidebar
        $recentPosts = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();


        return view('frontend.pages.blogs.detail', [
            'blog' => $blog,
            'categories' => $categories,
            'recentPosts' => $recentPosts
        ]);
    }
    public function gallery()
    {
        // Get gallery categories for filtering
        $galleryCategories = \App\Models\Gallery\GalleryCategory::where('status', true)->get();

        // Get main galleries with eager loading of categories and related images
        $galleries = \App\Models\Gallery\Gallery::with(['category', 'images'])
            ->where('status', true)
            ->latest()
            ->get();

        // Remove this debug output
        // echo '<pre>';
        // print_r($galleries);

       $allGalleryImages = collect();

        foreach ($galleries as $gallery) {
            // Add featured image
            if (!empty($gallery->featured_image)) {
                $allGalleryImages->push([
                    'title' => $gallery->title,
                    'description' => $gallery->description,
                    'image' => '' . $gallery->featured_image, // fix this
                    'category' => $gallery->category,
                    'is_main' => true
                ]);
            }

            // Add related gallery images
            foreach ($gallery->images as $image) {
                if (!empty($image->image_path)) {
                    $allGalleryImages->push([
                        'title' => $image->title ?? $gallery->title,
                        'description' => $image->caption ?? $gallery->description,
                        'image' => '' . $image->image_path, // fix this
                        'category' => $gallery->category,
                        'is_main' => false
                    ]);
                }
            }
        }


        $perPage = 12;
        $page = request()->get('page', 1);

        $galleryImages = new \Illuminate\Pagination\LengthAwarePaginator(
            $allGalleryImages->forPage($page, $perPage),
            $allGalleryImages->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('frontend.pages.gallery.index', [
            'galleryImages' => $galleryImages,
            'galleryCategories' => $galleryCategories
        ]);
    }

    public function projects()
    {
        $projects = \App\Models\Project\Project::latest()
            ->paginate(12);

        return view('frontend.pages.project.index', [
            'projects' => $projects
        ]);
    }
    public function faq(Request $request)
    {
        return view('frontend.pages.faq.index');
    }


    public function services(Request $request, $slug = null)
    {
        // If a slug is provided, show the detail view
        if ($slug) {
            // Get the specific service page
            $servicePage = Page::where('slug', $slug)
                ->where('is_published', 1)
                ->firstOrFail();

            // Get the parent service page for breadcrumbs
            $parentPage = null;
            if ($servicePage->parent_id) {
                $parentPage = Page::find($servicePage->parent_id);
            }

            // Get other related services (siblings)
            $relatedServices = Page::where('parent_id', $servicePage->parent_id)
                ->where('id', '!=', $servicePage->id)
                ->where('is_published', 1)
                ->take(3)
                ->get();

            return view('frontend.pages.services.detail', [
                'servicePage' => $servicePage,
                'parentPage' => $parentPage,
                'relatedServices' => $relatedServices
            ]);
        }
        // Otherwise show the index/listing view
        else {
            // Get the main Services page
            $mainServicePage = Page::where('slug', 'services')
                ->where('is_published', 1)
                ->first();

            // Get all child service pages
            $servicePages = Page::where('parent_id', $mainServicePage->id)
                ->where('is_published', 1)
                ->latest()
                ->get();

            return view('frontend.pages.services.index', [
                'mainServicePage' => $mainServicePage,
                'servicePages' => $servicePages
            ]);
        }
    }
}
