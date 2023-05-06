<?php

namespace App\Repository;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Type_Blood;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{

    public function Get_Student()
    {

        $students = Student::all();
        return view('pages.Students.index', compact('students'));
    }

    public function Show_Student($id)
    {

        $Student = Student::findorfail($id);
//        return $Student;
        return view('pages.Students.show', compact('Student'));
    }

    public function Edit_Student($id)
    {
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        $Students = Student::findorfail($id);
        return view('pages.Students.edit', $data, compact('Students'));
    }

    public function Update_Student($request)
    {
        try {
            $students1 = Student::findorfail($request->id);
            $students1->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students1->email = $request->email;
            $students1->password = Hash::make($request->password);
            $students1->gender_id = $request->gender_id;
            $students1->nationalitie_id = $request->nationalitie_id;
            $students1->blood_id = $request->blood_id;
            $students1->Date_Birth = $request->Date_Birth;
            $students1->Grade_id = $request->Grade_id;
            $students1->Classroom_id = $request->Classroom_id;
            $students1->section_id = $request->section_id;
            $students1->parent_id = $request->parent_id;
            $students1->academic_year = $request->academic_year;
            $students1->save();
            session()->flash('Update', trans('notifi.update'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Delete_Student($request)
    {
        try {
//        $students = Student::findorfail($request->id);
//        $students->delete();
//
            Student::destroy($request->id);

            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Create_Student()
    {

        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Type_Blood::all();
        return view('pages.Students.add', $data);

    }

    public function Store_Student($request)
    {

        //ده علشان هو هايضيف في جدولين لو في خطأ في احدهما لا يتم الحفظ هااااااااااااام
        DB::beginTransaction();

        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            // insert img
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/' . $students->name, $file->getClientOriginalName(), 'upload_attachments');

                    // insert in image_table
                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_id = $students->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }
//هنا النهاية للكود بتاعي
            DB::commit();  // insert data
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('Students.create');
        } catch (\Exception $e) {
//            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function Upload_attachment($request)
    {
        foreach ($request->file('photos') as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/' . $request->student_name, $file->getClientOriginalName(), 'upload_attachments');

            // insert in image_table
            $images = new image();
            $images->filename = $name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        session()->flash('Add', trans('notifi.add'));
        return redirect()->route('Students.show', $request->student_id);

    }

    public function Download_attachment($studentsname, $filename)
    {
        return response()->download(public_path('attachments/students/' . $studentsname . '/' . $filename));
    }

    public function Delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/' . $request->student_name . '/' . $request->filename);

        // Delete in data
        image::where('id', $request->id)->where('filename', $request->filename)->delete();
        session()->flash('delete', trans('notifi.delete'));
        return redirect()->route('Students.show', $request->student_id);
    }


}
