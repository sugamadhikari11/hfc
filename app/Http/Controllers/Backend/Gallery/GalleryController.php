<?php

namespace App\Http\Controllers\Backend\Gallery;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Gallery\GalleryCreateRequest;
use App\Repositories\Gallery\GalleryInterface;
use Illuminate\Http\Request;

class GalleryController extends BackendController
{

    protected GalleryInterface $gInterface;

    public function __construct(GalleryInterface $gInterface)
    {
        parent::__construct();
        $this->gInterface = $gInterface;
    }

    public function index()
    {
        $galleryData = $this->gInterface->getAll();
        $this->data('galleryData', $galleryData);
        return view($this->pagePath . 'gallery.index', $this->data);
    }


    public function store(GalleryCreateRequest $requests)
    {
        $data = $requests->all();
        if ($data) {
            $this->gInterface->insert($data);
            return redirect()->route('manage-gallery.index')->with('success', 'data was inserted');
        } else {
            return redirect()->back()->with('error', 'data was not inserted');
        }
    }


    public function update(Request $request, string $id)
    {
        if ($this->gInterface->update($request->all(), $id)) {
            return redirect()->route('manage-gallery.index')->with('success', 'data was updated');
        } else {
            return redirect()->back()->with('error', 'data was not updated');
        }
    }


    public function destroy(string $id)
    {
        if ($this->gInterface->delete($id)) {
            return redirect()->route('manage-gallery.index')->with('success', 'data was deleted');
        } else {
            return redirect()->back()->with('error', 'data was not deleted');
        }
    }

}
