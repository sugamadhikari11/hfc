<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Blog\BlogCreateRequest;
use App\Repositories\Blogs\BlogsInterface;
use Illuminate\Http\Request;
use App\Models\Blog\Blog;


class BlogController extends BackendController
{
    protected BlogsInterface $dr;

    public function __construct(BlogsInterface $dr)
    {
        parent::__construct();
        $this->dr = $dr;
    }

    public function index(Request $request)
    {
        $postsData = $this->dr->getParentData();
        $this->data('postsData', $postsData);
        return view($this->pagePath . 'blog.index', $this->data);
    }

    public function create()
    {
        $this->data('categoryData', $this->dr->getAllCategory());
        $this->data('blogParent', $this->dr->getParentData());
        return view($this->pagePath . 'blog.create', $this->data);

    }

    public function store(BlogCreateRequest $requests)
    {
        $data = $requests->all();
        if ($data) {
            $this->dr->insert($data);
            return redirect()->route('manage-blog.index')->with('success', 'data was inserted');
        } else {
            return redirect()->back()->with('error', 'data was not inserted');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->data('postsData', $this->dr->getById($id));
        return view($this->pagePath . 'blog.show', $this->data);
    }


    public function edit(string $id)
    {
        $this->data('blogData', $this->dr->getById($id));
        $this->data('categoryData', $this->dr->getAllCategory());
        $this->data("parentId", $this->dr->getSelectedParentId($id));
        $this->data('selectedCategoryId', $this->dr->getSelectedCategoryId($id));
        $this->data('blogParent', $this->dr->getParentData());
        return view($this->pagePath . 'blog.update', $this->data);
    }
    public function togglePublish($id)
        {
            $blog = Blog::findOrFail($id);
            $blog->is_published = !$blog->is_published;
            $blog->save();

            return redirect()->back()->with('success', 'Blog ' . ($blog->is_published ? 'published' : 'unpublished') . ' successfully.');
        }



    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug,' . $id,
            'parent_id' => function ($attribute, $value, $fail) use ($id) {
                if ($value == $id) {
                    $fail('The blog cannot be its own parent.');
                }
            },
            'category_id' => 'required',
        ]);
        if ($this->dr->update($request->all(), $id)) {
            return redirect()->route('manage-blog.index')->with('success', 'data was updated');
        } else {
            return redirect()->back()->with('error', 'data was not updated');
        }
    }


    public function destroy(string $id)
    {
        if ($this->dr->delete($id)) {
            return redirect()->route('manage-blog.index')->with('success', 'data was deleted');
        } else {
            return redirect()->back()->with('error', 'data was not deleted');
        }
    }


}
