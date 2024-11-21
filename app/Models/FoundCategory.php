<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];


    public function foundRequests()
    {
        return $this->hasMany(FoundRequest::class, 'category');
    }
}
