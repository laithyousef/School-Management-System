<?php

namespace App\Repository;


interface LibraryRepository_Interface {


    public function index();


    public function create();


    public function store($request);


    public function edit($id);


    public function update($request);


    public function destroy($request);


    public function download_attachment($file_name);



}