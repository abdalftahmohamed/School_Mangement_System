<?php

namespace App\services;

use App\Repository\SubjectRepository;

class SubjectService
{
    private SubjectRepository  $repository;
    public function __construct(SubjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        return $this->repository->index();
    }

    public function show($id){
        return $this->repository->show($id);
    }
    public function create(){
        return $this->repository->create();
    }
    public function edit($id){
        return $this->repository->edit($id);
    }

    public function store($request){
        return $this->repository->store($request);
    }

    public function update($request){
        return $this->repository->update($request);
    }

    public function destroy($request){
        return $this->repository->destroy($request);
    }
}
