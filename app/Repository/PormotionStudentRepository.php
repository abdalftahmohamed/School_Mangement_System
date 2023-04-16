<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PormotionStudentRepository{

//    public function show($id) : Category
//    {
//        return Category::query()->findOrFail($id);
//    }
//
//    public function  store(array $attributes, ?Closure $func = null): Category
//    {
//        return DB::transaction(function () use ($attributes, $func) {
//
//            return tap(Category::query()->create($attributes), $func);
//
//        });
//    }
//
//    public function update($id, $attributes,?Closure $func = null) : Category
//    {
//        return DB::transaction(function () use ($id, $attributes, $func)  {
//            $oldModel = Category::query()->where('id', $id)->firstOrFail();
//            $oldModel->update($attributes);
//            $oldModel->refresh();
//            tap($oldModel, $func);
//            return $oldModel;
//        });
//    }
//
//    public function destroy(int $id)
//    {
//        $model = Category::query()->where('id', $id)->first();
//        try {
//
//            $model->delete();
//            return true;
//        } catch (Throwable $e) {
//            Log::error($e->getMessage());
//            throw new \Exception('Model does not Exist', 10);
//        }
//    }

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index',compact('Grades'));
    }

    public function create()
    {
        $promotions = promotion::all();
        return view('pages.Students.promotion.management',compact('promotions'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();

            if($students->count() < 1){
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            // update in table student
            foreach ($students as $student){

                $ids = explode(',',$student->id);
                student::whereIn('id', $ids)
                    ->update([
                        'Grade_id'=>$request->Grade_id_new,
                        'Classroom_id'=>$request->Classroom_id_new,
                        'section_id'=>$request->section_id_new,
                        'academic_year'=>$request->academic_year_new,
                    ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_Classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_Classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                ]);

            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



}

}
