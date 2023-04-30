<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use App\Models\Quizze;
use App\services\QuizzeService;
use Illuminate\Http\Request;

class QuizzeController extends Controller
{
    private QuizzeService $service;

    function __construct(QuizzeService $service){
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
