<?php

namespace App\services;

use App\Repository\PaymentRepository;

class PaymentService
{
    private PaymentRepository  $repository;
    public function __construct(PaymentRepository $repository)
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
