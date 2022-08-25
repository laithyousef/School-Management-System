<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Parents extends Authenticatable
{
    use HasFactory, HasTranslations;

    public $translatable = ['Name', 'Father_Name', 'Father_Job', 'Mother_Name', 'Mother_Job'];

    protected $guarded = [];
}
