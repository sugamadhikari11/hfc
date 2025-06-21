<?php

namespace App\Repositories\Blogs;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use App\Traits\FileService;
use App\Traits\General;
use Illuminate\Support\Str;

class BlogsRepository implements BlogsInterface
{
    use General, FileService;

    protected $model;

    public function __construct(Blog $model)
    {

        $this->model = $model;

    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function paginate($perPage = null, $filter = [])
        {
            $query = $this->model->where('is_published', 1);

            // Apply category filter if provided
            if (!empty($filter['category'])) {
                $query->where('category_id', $filter['category']);
            }

            // Apply search filter if provided
            if (!empty($filter['search'])) {
                $query->where(function ($q) use ($filter) {
                    $q->where('title', 'like', '%' . $filter['search'] . '%')
                    ->orWhere('summary', 'like', '%' . $filter['search'] . '%');
                });
            }

            return $query->orderBy('created_at', 'desc')->paginate($perPage);
        }


    public function getById($criteria)
    {
        return $this->model->findOrFail($criteria);
    }


    public function insert(array $data)
    {
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['slug']);
        $item = $this->model->create($data);
        if ($item) {
            $tableName = $this->model->getTable();
            $filePath = 'uploads/' . $tableName;
            $fileData = $this->deviceBasedImageUpload($filePath);
            if ($fileData) {
                $item->update(['files_field' => $fileData]);
            }
            return $item;
        }

        return false;
    }


    public function update(array $data, $id)
    {
        $item = $this->model->findOrFail($id);
        $tableName = $this->model->getTable();
        if ($item->update($data)) {
            $filePath = 'uploads/' . $tableName;
            $fileData = $this->deviceBasedImageUpload($filePath);
            if ($fileData) {
                $this->deleteDeviceImages($item->files_field);
                $item->update(['files_field' => $fileData]);
            }
            return $item;
        }
        return false;
    }

    public function delete($id)
    {
        $item = $this->model->findOrFail($id);
        if (!empty($item->files_field)) {
            $imagePaths = is_array($item->files_field)
                ? $item->files_field
                : json_decode($item->files_field, true);
            $this->deleteDeviceImages($imagePaths);
        }
        $this->deleteImagesFromHtml($item->description);
        return $item->delete();
    }


    public function getParentData()
    {
        return $this->model->whereNull('parent_id')->orderBy('id', 'desc')->get();
    }

    public function getSelectedParentId($id)
    {
        return $this->model->findOrFail($id)->parent_id;
    }

    public function getSelectedCategoryId($id)
    {
        return $this->model->findOrFail($id)->category_id;
    }

    public function getAllCategory()
    {
        return BlogCategory::all();
    }

    public function recentBlog($limit = 4)
    {
        return $this->model->orderBy('id', 'desc')->limit($limit)->get();
    }

}

