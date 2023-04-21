<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeesRequest;
use App\Models\Fee;
use App\Repository\StudentFeesRepository;
use App\services\StudentFeesService;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    private StudentFeesRepository $repository;
    private StudentFeesService $service;

    function __construct(StudentFeesService $service){
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


    public function store(StoreFeesRequest $request)
    {
        return $this->service->store($request);
    }

    public function show(Fee $fee)
    {
        //
    }


    public function edit($id)
    {
        return $this->service->edit($id);
    }


    public function update(StoreFeesRequest $request)
    {
        return $this->service->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->service->destroy($request);
    }
}
