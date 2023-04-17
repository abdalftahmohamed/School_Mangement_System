<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PormotionStudentRepository{

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
            session()->flash('Add', trans('notifi.add'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



    }


    public function destroy($request){
        DB::beginTransaction();

        try {

            if ($request->page_id ==1){
                $pormotions=Promotion::all();

                #update table of students

                foreach ($pormotions as $pormotion){
                  $ids = explode(',',$pormotion->student_id);
                  student::whereIn('id', $ids)
                      ->update([
                          'Grade_id'=>$pormotion->from_grade,
                          'Classroom_id'=>$pormotion->from_Classroom,
                          'section_id'=>$pormotion->from_section,
                          'academic_year'=>$pormotion->academic_year,
                      ]);

                  #delete model of pormotions tables
                  Promotion::truncate();

                }
                DB::commit();
                session()->flash('delete', trans('notifi.delete'));
                return redirect()->back();
            }else{
                $pormotion = Promotion::findorfail($request->id);

                #update table of students
                    $ids = explode(',',$pormotion->student_id);
                    student::where('id', $ids)
                        ->update([
                            'Grade_id'=>$pormotion->from_grade,
                            'Classroom_id'=>$pormotion->from_Classroom,
                            'section_id'=>$pormotion->from_section,
                            'academic_year'=>$pormotion->academic_year,
                        ]);

                    #delete from pormotions tables
                    Promotion::destroy($request->id);
                DB::commit();
                session()->flash('delete', trans('notifi.delete'));
                return redirect()->back();
            }

        }catch (\Exception $e) {
            DB::rollback();
            return false;
    }
    }

}
