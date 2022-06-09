<?php

namespace App\Repository;


interface FeeProcessingRepository_Interface {


    public function index();


    public function show($id);


    public function store($request);


    public function edit($id);


    public function update($request);


    public function destroy($request);



}