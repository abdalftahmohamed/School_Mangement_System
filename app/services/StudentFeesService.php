<?php
namespace App\services;

use App\Repository\StudentFeesRepository;

class StudentFeesService
{
    private StudentFeesRepository $repository;

    function __construct(StudentFeesRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
        return $this->repository->index();
    }

    public function create(){
        return $this->repository->create();
    }
    public function store($request){
        return $this->repository->store($request);
    }


    public function edit($id){
        return $this->repository->edit($id);
    }

    public function update($request){
        return $this->repository->update($request);
    }
    public function destroy($request){
        return $this->repository->destroy($request);
    }

}
