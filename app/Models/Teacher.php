<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Teacher extends Authenticatable
{
    use HasFactory,  HasTranslations;

    protected $guarded = [];

    public $translatable = ['Name'];


    /**
     * Get the user that owns the Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specializations()
    {
        return $this->belongsTo(Specialization::class, 'Specialization_id');
    }

    /**
     * Get the genders that owns the Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genders()
    {
        return $this->belongsTo(Gender::class, 'Gender_id');
    }

    /**
     * The roles that belong to the Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Sections()
    {
        return $this->belongsToMany(Section::class, 'teachers_sections', 'teacher_id', 'section_id');
    }

}
