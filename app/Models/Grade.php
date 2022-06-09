<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory, HasTranslations ;

    public $translatable = ['Name'];


    /**
     * Get all of the comments for the Grade
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function class_rooms()
    {
        return $this->hasMany(ClassRoom::class);
    }

   /**
    * Get all of the Sections for the Grade
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function Sections()
   {
       return $this->hasMany(Section::class, 'grade_id');
   }
}

