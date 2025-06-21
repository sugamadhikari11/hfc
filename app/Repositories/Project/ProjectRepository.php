<?php

namespace App\Repositories\Project;

use App\Traits\General;
use App\Models\Project\Project;

class ProjectRepository implements ProjectInterface
{
    use General;

    protected $model;

    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getPaginated($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }
    public function updateFile($id, $data)
    {
        return $this->model->findOrFail($id)->update($data);

    }
    public function create(array $data)
    {

        // Handle image upload
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image']->store('projects', 'public'); // Save to storage/app/public/projects
            $data['files_field'] = json_encode(['image' => $path]);
            unset($data['image']); // Remove 'image' key so it doesn't try to insert into non-existing column
        }

        return $this->model->create($data) ? true : false;
    }


    public function update($id, array $data)
    {
        $record = $this->findById($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->findById($id);
        return $record->delete();
    }
}