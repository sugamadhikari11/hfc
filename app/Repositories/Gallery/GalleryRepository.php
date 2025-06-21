<?php

namespace App\Repositories\Gallery;

use App\Traits\FileService;
use App\Models\Gallery\Gallery;
use Illuminate\Support\Str;

class GalleryRepository implements GalleryInterface
{
    use FileService;

    protected $model;

    public function __construct(Gallery $gallery)
    {
        $this->model = $gallery;
    }
       

    public function insert($data)
    {   
        $data['slug'] = Str::slug($data['title']);
        $tableName = $this->model->getTable();
        $filePath = 'uploads/' . $tableName;

        $allUploadData = $this->uploadMultipleDeviceImages($filePath, 'images');

        if (!empty($allUploadData)) {
            // Correct way to get featured image path
            $data['featured_image'] = $allUploadData[0]['desktop'] ?? reset($allUploadData[0]);
            $data['files_field'] = json_encode($allUploadData);
        }

        return $this->model->create($data);
    }

    public function update($data, $id)
    {
        $item = $this->model->findOrFail($id);
        $tableName = $this->model->getTable();
        if ($item->update($data)) {
            $filePath = 'uploads/' . $tableName;
            $fileData = $this->deviceBasedImageUpload($filePath);
            if ($fileData) {
                $this->deleteDeviceImages(is_array($item->files_field) ? $item->files_field : json_decode($item->files_field, true));
                $item->update(['files_field' => json_encode($fileData)]);
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

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getById($criteria)
    {
        // TODO: Implement getById() method.
    }
}
