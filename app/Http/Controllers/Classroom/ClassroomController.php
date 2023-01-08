<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $My_Classes=Classroom::all();
        $Grades = Grade::all();
        return view('pages/My_Classes/My_Classes',compact('My_Classes','Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreClassroom $request)
    {
        try {
            // Retrieve the validated input data...
            $request->validated();

            $List_Classes=$request->List_Classes;

            foreach ($List_Classes as $List_Class)
            {
                if(Classroom::where('Name_Class->ar',$List_Class['Name'])->orwhere('Name_Class->en',$List_Class['Name_class_en'])->exists()){
                    return redirect()->back()->withErrors(['error','this is repeated']);
                }

                $my_Classes=new Classroom();
                $my_Classes->Name_Class = [
                'en' => $List_Class['Name_class_en'],
                'ar' => $List_Class['Name'],
            ];
                $my_Classes->Grade_id=$List_Class['Grade_id'];
                $my_Classes->save();
            }
//            toastr()->success(trans('messages.success'));
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('Classrooms.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        try {
            $Classroom = Classroom::findOrFail($request->id);
            $Classroom->update([
                'Name_Class' => [
                    'en' => $request->Name_class_en,
                    'ar' => $request->Name
                ],
                'Grade_id' => $request->Grade_id,
            ]);
//            toastr()->success(trans('messages.success'));
            session()->flash('Update', trans('notifi.update'));
            return redirect()->route('Classrooms.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        try {
            $Classroom = Classroom::findOrFail($request->id);
            $Classroom->delete();
//            toastr()->error('hhhhhhhhhhhhh');
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('Classrooms.index');


        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
