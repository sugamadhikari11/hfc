<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Project\ProjectCreateRequest;
use App\Repositories\Project\ProjectInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends BackendController
{
    protected ProjectInterface $activityRepository;

    public function __construct(ProjectInterface $activityRepository)
    {
        parent::__construct();
        $this->activityRepository = $activityRepository;
    }

    public function index(Request $request)
    {
        $projects = $this->activityRepository->getPaginated();
        $this->data('projects', $projects);
        return view($this->pagePath . 'project.index', $this->data);
    }

    public function create()
    {
        return view($this->pagePath . 'project.create', $this->data);
    }


    public function store(ProjectCreateRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            // Save image inside files_field JSON
            $data['files_field'] = json_encode(['image' => $path]);
        }

        // Remove image key if exists to avoid error since no image column
        unset($data['image']);

        if ($this->activityRepository->create($data)) {
            return redirect()->route('manage-projects.index')->with('success', 'Project created successfully.');
        } else {
            return redirect()->back()->with('error', 'Project was not created.');
        }
    }

    public function show(string $id)
    {
        $activity = $this->activityRepository->findById($id);

        // Optional: decode the image path for convenience in Blade
        $files = json_decode($activity->files_field, true);
        $imagePath = $files['image'] ?? null;

        $this->data('activity', $activity);
        $this->data('imagePath', $imagePath);

        return view($this->pagePath . 'project.show', $this->data);
    }

    public function edit(string $id)
    {
        $activity = $this->activityRepository->findById($id);
        $this->data('activity', $activity);
        return view($this->pagePath . 'project.update', $this->data);
    }

  public function update(ProjectCreateRequest $request, string $id)
    {
        $data = $request->validated();
        $activity = $this->activityRepository->findById($id);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image from storage
            if ($activity->files_field) {
                $files = json_decode($activity->files_field, true);
                if (!empty($files['image'])) {
                    Storage::disk('public')->delete($files['image']);
                }
            }

            // Save new image to storage
            $path = $request->file('image')->store('projects', 'public');
            $data['files_field'] = json_encode(['image' => $path]);
        }

        // Remove image key to avoid DB error
        unset($data['image']);

        if ($this->activityRepository->update($id, $data)) {
            return redirect()->route('manage-projects.index')
                ->with('success', 'Project updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Project was not updated.');
        }
    }


    public function destroy(string $id)
    {
        $activity = $this->activityRepository->findById($id);
        
        // Delete image if exists
        if ($activity->image) {
            Storage::disk('public')->delete($activity->image);
        }
        
        if ($this->activityRepository->delete($id)) {
            return redirect()->route('manage-projects.index')
                ->with('success', 'Activity deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Activity was not deleted.');
        }
    }
}