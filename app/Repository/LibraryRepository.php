<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Teacher;

class LibraryRepository
{

    use AttachFilesTrait;

    public function index()
    {
        $books = Library::all();

        return view('pages.library.index',compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        $Processers=Teacher::all();
        return view('pages.library.create',compact('grades','Processers'));
    }

    public function store($request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = $request->teacher_id;
            $books->save();
            $this->uploadFile($request,'file_name','library');

            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = Grade::all();

        $Processers=Teacher::all();

        $book = library::findorFail($id);
        return view('pages.library.edit',compact('book','grades','Processers'));
    }

    public function update($request)
    {
        try {
            $book = library::findorFail($request->id);
            $book->title = $request->title;

            if($request->hasfile('file_name')){

                $this->deleteFile($book->file_name);

                $this->uploadFile($request,'file_name');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = $request->teacher_id;
            $book->save();
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        return $request->file_name;
//        $this->deleteFile('library',$request->file_name);
//        library::destroy($request->id);
//        session()->flash('delete', trans('notifi.delete'));
//        return redirect()->route('library.index');
    }

    public function download($filename)
    {
        return response()->download(public_path('attachments/library/'.$filename));
    }
}
