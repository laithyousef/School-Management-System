<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Section extends Model
{
    use HasFactory,  HasTranslations ;

    public $translatable = ['name'];
    
    protected $guarded = [];

   /**
    * Get the classes that owns the Section
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function classes()
   {
       return $this->belongsTo(ClassRoom::class, 'class_id');
   }

   
   /**
    * The roles that belong to the Section
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function teachers()
   {
       return $this->belongsToMany(Teacher::class, 'teachers_sections', 'teacher_id', 'section_id');
   }

   public function Grades()
   {
       return $this->belongsTo( Grade::class,'grade_id');
   }
   
}
