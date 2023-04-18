<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repository\StudentGraduatedRepository;
use App\services\StudentGraduatedService;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{

    private StudentGraduatedRepository $repository;
    private StudentGraduatedService $service;

    function __construct(StudentGraduatedService $service){
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
        return $this->service->SoftDelete($request);
    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->service->delete($id);

    }


    public function update(Request $request)
    {
        return $this->service->ReturnData($request);
    }


    public function destroy(Request $request)
    {
        return $this->service->destroy($request);
    }
}
