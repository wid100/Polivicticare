<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use App\Models\Admin\Pourashava;

class District extends Model
{
    public $timestamps = false;

    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }


    public function unions()
    {
        return $this->hasMany(Union::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function pourashava()
    {
        return $this->hasMany(Pourashava::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'district_id', 'id');
    }
}
