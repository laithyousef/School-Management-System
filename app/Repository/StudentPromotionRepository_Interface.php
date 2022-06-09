<?php

namespace App\Repository;


interface StudentPromotionRepository_Interface {


    public function index();


    public function create();


    public function store($request);


    public function promotion_roll_back();


    public function destroy($request);



 


}