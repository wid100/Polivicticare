<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributeFand extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'nid',
        'payment_type',
        'amount',
        'nid_img',
        'recept_img',
    ];
}
