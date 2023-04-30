<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private QuestionService $service;

    function __construct(QuestionService $service){
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
