<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_name',
        'category',
        'nid',
        'description',
        'location',
        'image',
        'request_amount',
        'status',
    ];

    protected $casts = [
        'image' => 'array',
    ];
}
