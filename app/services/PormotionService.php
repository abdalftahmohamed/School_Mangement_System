<?php
namespace App\services;

use App\Repository\PormotionStudentRepository;

class PormotionService
{
    private PormotionStudentRepository $repository;

    function __construct(PormotionStudentRepository $repository)
    {
        $this->repository = $repository;
    }
    public function showindex()
    {
        return $this->repository->index();
    }

    public function showcreate()
    {
        return $this->repository->create();
    }

    public function showstore($request)
    {
        return $this->repository->store($request);
    }

    public function showdestroy($request)
    {
        return $this->repository->destroy($request);
    }

//    public function save($attributes)
//    {
//        $this->repository->store($attributes, function (Category $category) {
//            // Code done on Category after saving;
//
//
//        });
//    }
//
//    public function update($id, $attributes)
//    {
//        $this->repository->update($id, $attributes, function (Category $category) {
//            // code done on Category after updating;
//
//
//        });
//
//    }

//    public function getRepository() : PormotionStudentRepository{
//        return $this->repository;
//    }
}
