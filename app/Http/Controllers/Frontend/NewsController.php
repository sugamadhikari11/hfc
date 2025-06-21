<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News\NewsCategory;
use App\Repositories\News\NewsInterface;

class NewsController extends Controller
{
    protected $newsInterface;

    public function __construct(NewsInterface $newsInterface)
    {
        parent::__construct();
        $this->newsInterface = $newsInterface;
    }

    public function index(Request $request)
    {
        if (!empty($request->slug)) {
            // Find the news by slug
            $news = News::where('slug', $request->slug)
                ->with([
                    'category',
                    'user',
                    'details' => function ($query) {
                        $query->orderBy('sort_order', 'asc');
                    }
                ])
                ->firstOrFail();

            // Increment view count
            $news->increment('view_count');

            // Get related news from the same category
            $relatedNews = News::where('category_id', $news->category_id)
                ->where('id', '!=', $news->id)
                ->latest()
                ->take(2)
                ->get();

            // Get latest news excluding current one
            $latestNews = News::where('id', '!=', $news->id)
                ->latest()
                ->take(4)
                ->get();
            $categories = NewsCategory::withCount(['news' => function ($query) {
                $query->where('status', true);
            }])
                ->get();


            return view('frontend.pages.news.news-details', [
                'news' => $news,
                'relatedNews' => $relatedNews,
                'latestNews' => $latestNews,
                'categories' => $categories,
            ]);
        } else {
            // Get category ID from request if present
            $categoryId = $request->query('category');
        
            // Get all categories for the sidebar 
            $categories = NewsCategory::withCount(['news' => function ($query) {
                $query->where('status', true);
            }])
                ->get();
            
            // Get featured post
            $featuredPost = News::with(['category', 'user'])
                ->latest()
                ->first();
            
            // Get most read news
            $mostReadNews = News::with('category')
                ->where('status', true)
                ->orderBy('view_count', 'desc')
                ->take(5)
                ->get();
            
            // Get filtered news by category if category parameter exists
            if ($categoryId) {
                $newsData = News::with(['category', 'user'])
                    ->where('status', true)
                    ->where('category_id', $categoryId)
                    ->latest()
                    ->paginate(6);
            } else {
                // Get all news if no category filter
                $newsData = $this->newsInterface->paginate(6);
            }
            
            $this->data('categoryData', $categories);
            $this->data('featuredPost', $featuredPost);
            $this->data('mostReadNews', $mostReadNews);
            $this->data('selectedCategory', $categoryId); // Pass selected category to the view
            $this->data('newsData', $newsData);
            
            return view('frontend.pages.news.index', $this->data);
        }
    }
}
