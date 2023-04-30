<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\services\SubjectService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    private SubjectService $service;

    function __construct(SubjectService $service){
        $this->service = $service;

//        $this->repository = $this->service->getRepository();
        //Middleware for authentication and user-separation goes here...
    }
    public function index()
    {
        return $this->service->index();
    }


    public function create()
    {
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
}
