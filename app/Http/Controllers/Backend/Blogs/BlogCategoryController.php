<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Blog\BlogCategoyCreateRequest;
use App\Repositories\Blogs\Category\BlogCategoryInterface;
use Illuminate\Http\Request;


class BlogCategoryController extends BackendController
{
    protected BlogCategoryInterface $cat;

    public function __construct(BlogCategoryInterface $cat)
    {
        parent::__construct();
        $this->cat = $cat;
    }

    public function index(Request $request)
    {

        $categoryData = $this->cat->getAll();
        $this->data('categoryData', $categoryData);
        $response = view($this->pagePath . 'blog.category.index', $this->data);
        return $response;
    }

    public function create(Request $request)
    {
        return view($this->pagePath . 'blog.category.create', $this->data);

    }

    public function store(BlogCategoyCreateRequest $request)
    {
        $data = $request->all();
        $data['slug'] = $this->make_slug($request->name);
        if ($this->cat->insert($data)) {
            return redirect()->route('manage-blog-category.index')->with('success', 'data was inserted');
        } else {
            return redirect()->back()->with('error', 'data was not inserted');
        }

    }

    public function show(string $id)
    {
        $this->data('category', $this->cat->getById($id));
        return view($this->pagePath . 'blog.category.show', $this->data);
    }

    public function edit(string $id)
    {
        $this->data('category', $this->cat->getById($id));
        $this->data('parentId', $this->cat->getById($id)->parent_id);
        return view($this->pagePath . 'blog.category.edit', $this->data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:blog_categories,name,' . $id,
            'slug' => 'required|unique:blog_categories,slug,' . $id,
            'parent_id' => function ($attribute, $value, $fail) use ($id) {
                if ($value == $id) {
                    $fail('The category cannot be its own parent.');
                }
            }
        ]);
        $data = $request->all();

        $data['slug'] = $this->make_slug($request->name);
        if ($this->cat->update($data, $id)) {
            return redirect()->route('manage-blog-category.index')->with('success', 'data was updated');
        } else {
            return redirect()->back()->with('error', 'data was not updated');
        }
    }


    public function destroy(string $id)
    {

        try {
            if ($this->cat->delete($id)) {
                return redirect()->route('manage-blog-category.index')->with('success', 'data was deleted');
            } else {
                return redirect()->back()->with('error', 'data was not deleted');
            }

        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()->back()->with('error', 'Cannot delete this category as it is linked to other child category.');
        }
    }


}
