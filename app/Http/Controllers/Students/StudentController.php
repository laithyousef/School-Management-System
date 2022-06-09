<?php

namespace App\Http\Controllers\Students;

use App\Models\Section;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\StudentRepository_Interface;

class StudentController extends Controller
{
    protected $Students;



    public function __construct(StudentRepository_Interface $Students)
    {
        $this->Students = $Students ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->Students->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->Students->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->Students->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->Students->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->Students->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->Students->update($request);
        
    }


    public function get_classes($id)
    {
        return $this->Students->get_classes($id);
    }

    public function get_sections($id)
    {
        return $this->Students->get_sections($id);
    }
    


    public function upload_attachment(Request $request)
    {
       return  $this->Students->upload_attachment($request);
    }

    public function download_attachment( $students_name, $filename)
    {
        return  $this->Students->download_attachment($students_name, $filename);
    }


    public function delete_attachment($request)
    {
        return  $this->Students->delete_attachment($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->Students->destroy($request);
        
    }

}
