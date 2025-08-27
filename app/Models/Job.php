<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
        use HasFactory;

    protected $fillable = [
        'title',
        'company_id',
        'person_need',
        'category',
        'requirements',
    ];

    // Relationship: A job belongs to a company
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    
}
