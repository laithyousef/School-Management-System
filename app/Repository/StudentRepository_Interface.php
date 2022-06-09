<?php

namespace App\Repository;


interface StudentRepository_Interface {


    public function index();


    public function create();


    public function store($request);


    public function edit($id);


    public function update($request);


    public function get_classes($id);

    
    public function get_sections($id);


    public function upload_attachment($request);


    public function download_attachment( $students_name, $filename);


    public function delete_attachment($request);


    public function destroy($request);


}