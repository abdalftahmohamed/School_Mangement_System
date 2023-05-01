<?php

namespace App\Http\Controllers\OnlineClasse;

use App\Http\Controllers\Controller;
use App\services\OnlineClasseService;
use Illuminate\Http\Request;


class OnlineClasseController extends Controller
{
    private OnlineClasseService $service;

    function __construct(OnlineClasseService $service){
        $this->service = $service;
    }
    public function index()
    {
        return $this->service->index();
    }
    public function create (){
        return $this->service->create();

    }
    public function indirectCreate (){
        return $this->service->indirectCreate();

    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function storeIndirect(Request $request)
    {
        return $this->service->storeIndirect($request);
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
