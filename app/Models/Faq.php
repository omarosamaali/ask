<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage',
        'question',
        'answer',
        'status',
        'images',
    ];

    protected $casts = [
        'status' => 'boolean',
        'images' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
