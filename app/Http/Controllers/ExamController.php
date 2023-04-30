<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\services\ExamService;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    private ExamService $service;

    function __construct(ExamService $service){
        $this->service = $service;
    }
    public function index()
    {
        return $this->service->index();
    }
public function create (){
    return $this->service->create();

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
