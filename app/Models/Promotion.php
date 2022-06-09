<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;

    protected $guarded = [] ;


    public function f_grade()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }

      /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function f_classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'from_classroom');
    }



    /**
     * Get the user that owns the Promotion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function f_section()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }



      /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }



    public function t_grade()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }

      /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function t_classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'to_classroom');
    }

      /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    /**
     * Get the user that owns the Promotion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function t_section()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }

}
