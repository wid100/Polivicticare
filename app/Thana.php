<?php

namespace App;

use App\Models\Admin\Pourashava;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;
use App\Models\User;

class Thana extends Model
{
    use BelongsToThrough;

    public $timestamps = false;

    public function unions()
    {
        return $this->hasMany(Union::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function division()
    {
        return $this->belongsToThrough(Division::class, District::class);
    }
    //relation pourashava
    public function pourashava()
    {
        return $this->hasMany(Pourashava::class);
    }
    public function users()
    {
        return $this->hasMany(User::class, 'thana_id', 'id');
    }
}
