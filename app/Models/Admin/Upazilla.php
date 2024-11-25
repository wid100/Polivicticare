<?php

namespace App\Models\Admin;

use App\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Upazilla extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'district_id'];
    public function district()
    {
        return $this->belongsTo(District::class);
    }


    public function users()
    {
        return $this->hasMany(User::class, 'upazilla_id', 'id');
    }
}
