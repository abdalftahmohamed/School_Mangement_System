<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSection;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
//$sec=Section::find(7);
//return $sec->Teachers;
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers=Teacher::all();
        return view('pages.Sections.Sections',compact('Grades','list_Grades','teachers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSection $request)
    {

        $request->validated();
        $Sections = new Section();

        $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
        $Sections->Grade_id = $request->Grade_id;
        $Sections->Class_id = $request->Class_id;
        $Sections->Status = 1;
        $Sections->save();
        $Sections->Teachers()->attach($request->teacher_id);
        session()->flash('Add', trans('notifi.add'));
        return redirect()->route('Sections.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreSection $request, Section $section)
    {
        try {
        $validated = $request->validated();
            $Sections = Section::findOrFail($request->id);
            $Sections->update([
                'Name_Section' => ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En],
                'Grade_id' => $request->Grade_id,
                'Class_id' => $request->Class_id,
            ]);

            if(isset($request->Status)) {
                $Sections->Status = 1;
            } else {
                $Sections->Status = 2;
            }
               //important to update
            if(isset($request->teacher_id)) {
                $Sections->Teachers()->sync($request->teacher_id);
            } else {
                $Sections->Teachers()->sync(array());
            }

            $Sections->save();

            session()->flash('Update', trans('notifi.update'));
            return redirect()->route('Sections.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        try {
            $Sections = Section::findOrFail($request->id);
            $Sections->delete();
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('Sections.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

        return $list_classes;
    }
}
