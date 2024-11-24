<?php

namespace App\Models\Admin;

use App\Thana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pourashava extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'thana_id'];

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }
}
