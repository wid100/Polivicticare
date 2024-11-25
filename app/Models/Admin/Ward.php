<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ward extends Model
{
    use HasFactory;
    protected $fillable = ['name',];


    public function users()
    {
        return $this->hasMany(User::class, 'ward_id', 'id');
    }
}
