<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Student extends Authenticatable
{
    use HasFactory,   HasTranslations, SoftDeletes;

    protected $guarded = [];

    public $translatable = ['name'];

    /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationalitie_id');
    }

      /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }

      /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'Classroom_id');
    }

      /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }


    /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parent_id');
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'student_id');
    }


    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

}
