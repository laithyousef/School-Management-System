<?php

namespace App\Repository;


interface FeesInvoicesRepository_Interface {


    public function index();


    public function show($id);


    public function store($request);


    public function edit($id);


    public function update($request, $id);


    public function destroy($id);



}