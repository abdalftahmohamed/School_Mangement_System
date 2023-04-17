<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Student;
use App\Repository\PormotionStudentRepository;
use App\services\PormotionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{

    private PormotionStudentRepository $repository;
    private PormotionService $service;

    function __construct(PormotionService $service){
        $this->service = $service;

//        $this->repository = $this->service->getRepository();
        //Middleware for authentication and user-separation goes here...
    }

    public function index()
    {
        return $this->service->showindex();
    }


    public function create()
    {
        return $this->service->showcreate();
    }


    public function store(Request $request)
    {
        return $this->service->showstore($request);
    }


    public function show(Promotion $promotion)
    {
        //
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
        return $this->service->showdestroy($request);
    }
}
