<?php

namespace App\Repositories\Page;

use App\Models\Page\Page;
use App\Traits\FileService;
use Illuminate\Support\Str;

class PageRepository implements PageInterface
{

    use FileService;

    protected $model;

    public function __construct(Page $model)
    {

        $this->model = $model;

    }


    public function getAll()
    {
        return $this->model->all();
    }

    public function paginate($perPage = null)
    {
        return $this->model->paginate($perPage);
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
        return $this->model->whereNull('parent_id')->get();
    }


    public function getSelectedParentId($id)
    {
        return $this->model->findOrFail($id)->parent_id;
    }


}
