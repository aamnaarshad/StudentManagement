<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $fillable = ['name', 'course_code', 'credit_hours'];

    /**
     * A course can have many students registered in it.
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }
}
