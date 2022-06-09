<?php

namespace App\Repository;


use App\Models\Grade;
use App\Models\Library;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Http\Traits\AttachFilesTrait;


 class LibraryRepository implements LibraryRepository_Interface {

    use AttachFilesTrait ;

    public function index()
    {
        $books = Library::all();

        return view('pages.libraries.index',compact('books'));
    }


    public function create()
    {
        $grades = Grade::all();
        $sections = Section::all();

        return view('pages.libraries.create', compact('grades', 'sections'));
    }



    public function store($request)
    {
        $request->validate([
            'title' => 'required',
            'file_name' => 'required|file',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'section_id' => 'required',
        ],[
            'title.required' => trans('library_trans.book_name_required'),
            'file_name.required' => trans('library_trans.file_name_required'),
            'Grade_id.required' => trans('Accounts.grade_required'),
            'Classroom_id.required' => trans('Accounts.class_name_required'),
            'section_id.required' => trans('Accounts.class_name_required'),
        ]);

        $books = new Library() ;
        $books->create([

            'title' => $request->title,
            'file_name' => $request->file('file_name')->getClientOriginalName(),
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'teacher_id' => 3,
        ]);

       $this->upload_file($request, 'file_name', 'library');

        toastr()->success(trans('messages.success'));
        return redirect()->route('libraries.index');
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = Library::findorFail($id);
        $sections = Section::all();
        $class_rooms = ClassRoom::all();
        return view('pages.libraries.edit',compact('book', 'grades', 'sections', 'class_rooms'));
    }


    public function update($request,)
    {

        $request->validate([
            'title' => 'required',
            'file_name' => 'required|file',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'section_id' => 'required',
        ],[
            'title.required' => trans('library_trans.book_name_required'),
            'file_name.required' => trans('library_trans.file_name_required'),
            'Grade_id.required' => trans('Accounts.grade_required'),
            'Classroom_id.required' => trans('Accounts.class_name_required'),
            'section_id.required' => trans('Accounts.class_name_required'),
        ]);

        $books = Library::findOrFail($request->id);
        
        if($request->hasfile('file_name')) {
            $this->delete_file($books->file_name) ;

            $this->upload_file($request, 'file_name', 'library');
        }
        
        $books->update([

            'title' => $request->title,
            'file_name' => $request->file('file_name')->getClientOriginalName(),
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'teacher_id' => 3,
        ]);

        toastr()->info(trans('messages.update'));
        return redirect()->route('libraries.index');
    }


    public function destroy($request)
    {
        $this->delete_file($request->file_name);
        Library::destroy($request->id);

        toastr()->error(trans('messages.delete'));
        return redirect()->route('libraries.index');

    }


    public function download_attachment($file_name)
    {
        return response()->download(public_path('attachments/library/'.$file_name));
    }



 }


