<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs_portal';

    protected $fillable = [
        'employer_id',
        'title',
        'company',
        'location',
        'type',
        'salary_min',
        'salary_max',
        'category',
        'is_featured',
        'description',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
    
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}
