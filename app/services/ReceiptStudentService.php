<?php

namespace App\services;

use App\Repository\ReceiptStudentRepository;

class ReceiptStudentService
{
private ReceiptStudentRepository $repository;
public function __construct(ReceiptStudentRepository $repository)
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

    public function show($id){
        return $this->repository->show($id);
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


    public function delete($id){
        return $this->repository->delete($id);
    }
}
