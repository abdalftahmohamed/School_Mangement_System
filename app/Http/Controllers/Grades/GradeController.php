<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use function Symfony\Component\Translation\t;

class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Grades.Grades', compact('Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreGrades $request)
    {
//        if(Grade::where('Name->ar',$request->Name_ar)->orwhere('Name->en',$request->Name_en)->exists()){
//            return redirect()->back()->withErrors(['error','this is repeated']);
//        }
        try {
            // Retrieve the validated input data...
            $validated = $request->validated();
            Grade::create([
                'Name' => [
                    'en' => $request->Name_en,
                    'ar' => $request->Name
                ],
                'Notes' => $request->Notes,
            ]);

//            toastr()->success(trans('messages.success'));
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('Grades.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreGrades $request)
    {
        try {
            $Grades = Grade::findOrFail($request->id);
            $Grades->update([
                'Name' => [
                    'en' => $request->Name_en,
                    'ar' => $request->Name
                ],
                'Notes' => $request->Notes,
            ]);
//toastr()->success("kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk");

//            toastr()->success(trans('messages.success'));
            session()->flash('Update', trans('notifi.update'));
            return redirect()->route('Grades.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        try {
            $my_class_id=Classroom::where('Grade_id',$request->id)->pluck('Grade_id');

            if ($my_class_id->count()==0){
                $Grades = Grade::findOrFail($request->id);
                $Grades->delete();
                session()->flash('delete', trans('notifi.delete'));
                return redirect()->route('Grades.index');
            }else
            {
                session()->flash('delete', trans('notifi.delete_error'));
                return redirect()->route('Grades.index');
            }
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
//        DB::table('grades')->truncate();
//        return redirect()->back();
    }

}


