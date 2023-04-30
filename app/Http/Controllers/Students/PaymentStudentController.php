<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\services\PaymentService;
use Illuminate\Http\Request;

class PaymentStudentController extends Controller
{

    private PaymentService $service;

    function __construct(PaymentService $service){
        $this->service = $service;
    }
    public function index()
    {
        return $this->service->index();
    }

    public function store(Request $request)
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


    public function update(Request $request)
    {
        return $this->service->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->service->destroy($request);
    }
}
