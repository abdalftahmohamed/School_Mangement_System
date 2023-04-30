<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\services\AttendanceService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private AttendanceService $service;

    function __construct(AttendanceService $service){
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
