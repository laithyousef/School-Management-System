<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Library extends Model
{
    use HasFactory;

    protected $guarded = []; 


    public function grade()
    {
        return $this->belongsTo(Grade::class , 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'Classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

}
