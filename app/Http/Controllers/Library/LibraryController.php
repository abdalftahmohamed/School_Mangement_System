<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\library;
use App\services\LibraryService;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    private LibraryService $service;

    function __construct(LibraryService $service){
        $this->service = $service;
    }
    public function index()
    {
        return $this->service->index();
    }
    public function create (){
        return $this->service->create();

    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }


    public function edit($id)
    {
        return $this->service->edit($id);
    }


    public function update(Request $request)
    {
        return $this->service->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->service->destroy($request);
    }
    public function download($filename){
        return $this->service->download($filename);
    }

}
