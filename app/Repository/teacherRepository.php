<?php

namespace App\Repository;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;

class teacherRepository implements TeacherRepositoryInterface{

    public function getAllTeachers(){
        $Teachers=Teacher::all();
        return view('pages.Teachers.Teachers',compact('Teachers'));
    }
    public function Getspecialization_gender(){
        $specializations = specialization::all();
        $genders =  Gender::all();
        return view('pages.Teachers.create',compact('specializations','genders'));
    }

    public function StoreTeachers($request){

        try {
            $Teachers = new Teacher();
            $Teachers->email = $request->Email;
            $Teachers->password =$request->Password;
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('Teachers.index');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    public function editTeachers($id)
    {
        $Teachers= Teacher::findOrFail($id);
        $specializations = specialization::all();
        $genders =  Gender::all();
        return view('pages.Teachers.edit',compact('Teachers','specializations','genders'));
    }


    public function UpdateTeachers($request)
    {
        try {
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->email = $request->Email;
            $Teachers->password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            session()->flash('Update', trans('notifi.update'));
            return redirect()->route('Teachers.index');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function DeleteTeachers($request)
    {
        Teacher::findOrFail($request->id)->delete();
        session()->flash('delete', trans('notifi.delete'));
        return redirect()->route('Teachers.index');
    }



}
