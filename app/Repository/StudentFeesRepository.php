<?php

namespace App\Repository;

use App\Models\Fee;
use App\Models\Grade;
use App\Models\Student;

class StudentFeesRepository{

    public function index()
    {
        $fees=Fee::all();
        $Grades=Grade::all();
        return view('pages.Fees.index', compact('fees','Grades'));
    }

    public function create()
    {
        $Grades=Grade::all();
        return view('pages.Fees.add',compact('Grades'));
    }

    public function store($request)
    {
        try {

            $fees = new Fee();
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  =$request->amount;
            $fees->Grade_id  =$request->Grade_id;
            $fees->Classroom_id  =$request->Classroom_id;
            $fees->description  =$request->description;
            $fees->Fee_type  =$request->Fee_type;
            $fees->year  =$request->year;
            $fees->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('Fees.index');

        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function edit($id)
    {
        try {
             $fee=Fee::findorfail($id);
            $Grades=Grade::all();
            return view('pages.Fees.edit', compact('fee','Grades'));
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update($request)
    {
        try {

            $fees = Fee::findorfail($request->id);
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  =$request->amount;
            $fees->Grade_id  =$request->Grade_id;
            $fees->Classroom_id  =$request->Classroom_id;
            $fees->description  =$request->description;
            $fees->Fee_type  =$request->Fee_type;
            $fees->year  =$request->year;
            $fees->save();
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('Fees.index');

        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function destroy($request)
    {
        Fee::findorfail($request->id)->delete();
        session()->flash('delete', trans('notifi.delete'));
        return redirect()->back();
    }


    public function delete($id){
    $Students=Student::findorfail($id);
    $Students->Delete();
    session()->flash('graduated', trans('notifi.graduated'));
    return redirect()->route('Students.index');
}
}
