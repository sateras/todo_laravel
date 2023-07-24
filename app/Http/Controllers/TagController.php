<?php

namespace App\Http\Controllers;

use App\Services\TagService;

class TagController extends Controller
{
    protected $service;

    public function __construct(TagService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        // $data = $request->validated();

        return $this->service->index();
    }

    // public function create(CreateTagRequest $request)
    // {
    //     $request->validated();

    //     $this->service->create($request);

    //     return redirect(route('home'));
    // }

    // public function update(Request $request)
    // {
    //     //
    // }

    // public function delete(Tag $id)
    // {
    //     $this->service->delete($id);

    //     return redirect(route('home'));
    // }
}
