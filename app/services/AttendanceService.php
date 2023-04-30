<?php

namespace App\services;

use App\Repository\AttendanceRepository;

class AttendanceService
{
    private AttendanceRepository  $repository;
    public function __construct(AttendanceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        return $this->repository->index();
    }

    public function show($id){
        return $this->repository->show($id);
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
