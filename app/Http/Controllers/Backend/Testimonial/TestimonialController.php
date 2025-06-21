<?php

namespace App\Http\Controllers\Backend\Testimonial;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Testimonial\TestimonialCreateRequest;
use App\Repositories\Testimonial\TestimonialInterface;
use Illuminate\Http\Request;

class TestimonialController extends BackendController
{
    protected $aInterface;

    public function __construct(TestimonialInterface $aInterface)
    {
        parent::__construct();
        $this->aInterface = $aInterface;
    }

    public function index(Request $request)
    {
        $this->data('testimonial', $this->aInterface->all());
        return view($this->pagePath . 'testimonial.index', $this->data);
    }

    public function show(Request $request, $id)
    {
        $this->data('testimonial', $this->aInterface->get($id));
        return view($this->pagePath . 'testimonial.show', $this->data);
    }

    public function create(Request $request)
    {
        return view($this->pagePath . 'testimonial.create', $this->data);
    }

    public function store(TestimonialCreateRequest $request)
    {
        $this->aInterface->insert($request->all());
        return redirect()->route('manage-testimonial.index')->with('success', 'Testimonial Created Successfully');
    }


    public function edit(Request $request, $id)
    {
        $this->data('testimonial', $this->aInterface->get($id));
        return view($this->pagePath . 'testimonial.update', $this->data);
    }


    public function update(Request $request, $id)
    {
        $this->aInterface->update($request->all(), $id);
        return redirect()->route('manage-testimonial.index')->with('success', 'Testimonial Updated Successfully');
    }


    public function destroy(Request $request, $id)
    {
        $this->aInterface->delete($id);
        return redirect()->route('manage-testimonial.index')->with('success', 'Testimonial Deleted Successfully');
    }
}
