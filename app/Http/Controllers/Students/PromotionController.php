<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Student;
use App\Repository\PormotionStudentRepository;
use App\services\StudentGraduatedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{

    private PormotionStudentRepository $repository;
    private PormotionStudentRepository $service;

    function __construct(PormotionStudentRepository $service){
        $this->service = $service;

//        $this->repository = $this->service->getRepository();
        //Middleware for authentication and user-separation goes here...
    }

    public function index()
    {
        return $this->service->index();
    }


    public function create()
    {
        return $this->service->create();
    }


    public function store(Request $request)
    {
        return $this->service->store($request);
    }





    public function edit(Promotion $promotion)
    {
        //
    }

    public function update(Request $request, Promotion $promotion)
    {
        //
    }


    public function destroy(Promotion $promotion ,Request $request)
    {
        return $this->service->destroy($request);
    }
}
