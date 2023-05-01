<?php

namespace App\services;

use App\Repository\OnlineClasseRepository;

class OnlineClasseService
{
    private OnlineClasseRepository $repository;

    public function __construct(OnlineClasseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function create()
    {
        return $this->repository->create();
    }
    public function indirectCreate()
    {
        return $this->repository->indirectCreate();
    }
    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function edit($id)
    {
        return $this->repository->edit($id);
    }

    public function store($request)
    {
        return $this->repository->store($request);
    }
    public function storeIndirect($request)
    {
        return $this->repository->storeIndirect($request);
    }
    public function update($request)
    {
        return $this->repository->update($request);
    }

    public function destroy($request)
    {
        return $this->repository->destroy($request);
    }
}
