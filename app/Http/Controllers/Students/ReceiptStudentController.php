<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiptStudentRequest;
use App\services\ReceiptStudentService;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{
    private ReceiptStudentService $service;

    function __construct(ReceiptStudentService $service){
        $this->service = $service;
    }
    public function index()
    {
        return $this->service->index();
    }


    public function create()
    {
        return $this->service->create();
    }


    public function store(ReceiptStudentRequest $request)
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


    public function update(ReceiptStudentRequest $request)
    {
        return $this->service->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->service->destroy($request);
    }
}
