<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Page\PageCreateRequest;
use App\Repositories\Page\PageInterface;
use Illuminate\Http\Request;

class PageController extends BackendController
{
    protected PageInterface $dr;

    public function __construct(PageInterface $dr)
    {
        parent::__construct();
        $this->dr = $dr;
    }

    public function index(Request $request)
    {
        $postsData = $this->dr->getParentData();
        $this->data('pageData', $postsData);
        return view($this->pagePath . 'page.index', $this->data);
    }

    public function create()
    {
        $this->data('pageParent', $this->dr->getParentData());
        return view($this->pagePath . 'page.create', $this->data);

    }

    public function store(PageCreateRequest $requests)
    {
        $data = $requests->all();
        if ($data) {
            $this->dr->insert($data);
            return redirect()->route('manage-page.index')->with('success', 'data was inserted');
        } else {
            return redirect()->back()->with('error', 'data was not inserted');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->data('pageData', $this->dr->getById($id));
        return view($this->pagePath . 'page.show', $this->data);
    }


    public function edit(string $id)
    {
        $this->data('pageData', $this->dr->getById($id));
        $this->data("parentId", $this->dr->getSelectedParentId($id));
        $this->data('pageParent', $this->dr->getParentData());
        return view($this->pagePath . 'page.update', $this->data);
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:pages,slug,' . $id,
            'parent_id' => function ($attribute, $value, $fail) use ($id) {
                if ($value == $id) {
                    $fail('The news cannot be its own parent.');
                }
            },
        ]);
        if ($this->dr->update($request->all(), $id)) {
            return redirect()->route('manage-page.index')->with('success', 'data was updated');
        } else {
            return redirect()->back()->with('error', 'data was not updated');
        }
    }


    public function destroy(string $id)
    {
        try {
            if ($this->dr->delete($id)) {
                return redirect()->route('manage-page.index')->with('success', 'data was deleted');
            } else {
                return redirect()->back()->with('error', 'data was not deleted');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Cannot delete this page as it is linked to other child page.');
        }
    }


    public function pageFaq(Request $request)
    {
        $id = $request->id;
        $findData = $this->dr->getById($id);
        $tableName = $findData->getTable();
        $this->data('tableName', $tableName);
        $this->data('parentId', $id);
        return view($this->pagePath . 'page.faq.index', $this->data);

    }

}
