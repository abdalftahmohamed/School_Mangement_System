<?php
namespace App\services;

use App\Repository\StudentGraduatedRepository;

class StudentGraduatedService
{
    private StudentGraduatedRepository $repository;

    function __construct(StudentGraduatedRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
        return $this->repository->index();
    }

    public function create(){
        return $this->repository->create();
    }

    public function SoftDelete($request){
        return $this->repository->SoftDelete($request);
    }

    public function ReturnData($request){
        return $this->repository->ReturnData($request);
    }

    public function destroy($request){
        return $this->repository->destroy($request);
    }


    public function delete($id){
    return $this->repository->delete($id);
    }
}
