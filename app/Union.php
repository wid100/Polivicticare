<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;
use App\Models\User;

class Union extends Model
{
    use BelongsToThrough;
    protected $fillable = ['district_id', 'name'];



    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo(District::class);
    }



    public function division()
    {
        return $this->belongsToThrough(Division::class, [District::class, Thana::class]);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'union_id', 'id');
    }
}
