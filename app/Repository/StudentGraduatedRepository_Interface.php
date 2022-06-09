<?php

namespace App\Repository;


interface StudentGraduatedRepository_Interface {


    public function index();


    public function create();


    public function graduating_Students($request);


  public function return_student();


    // public function store($request);


    // public function promotion_roll_back();


    public function destroy($request);



 


}