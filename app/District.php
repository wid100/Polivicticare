<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class District extends Model
{
    public $timestamps = false;

    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }

    public function unions()
    {
        return $this->hasManyThrough(Union::class, Thana::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }


    public function users()
    {
        return $this->hasMany(User::class, 'district_id', 'id');
    }
}
