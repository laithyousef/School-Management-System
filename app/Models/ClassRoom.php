<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ClassRoom extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];
    
    protected $guarded = [];
   /**
    * Get the user that owns the ClassRoom
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    
   public function grades()
   {
       return $this->belongsTo(Grade::class, 'grade_id');
   }


}
