<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'full_name',
    ];

    protected $casts = [
        'grades' => 'array',
        'subjects' => 'array',
    ];

    public static function getAvailableGrades(): array
    {
        return ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th'];
    }

    public static function getAvailableSubjects(): array
    {
        return ['English', 'Math', 'Science', 'History'];
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
