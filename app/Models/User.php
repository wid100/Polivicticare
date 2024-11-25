<?php

namespace App\Models;

use App\District;
use App\Division;
use App\Thana;
use App\Union;
use App\Models\Admin\Pourashava;
use App\Models\Admin\Upazilla;
use App\Models\Admin\Ward;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail

{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'city',
        'country',
        'phone',
        'address',
        'country_code',
        'gender',
        'password',
        'division_id',
        'district_id',
        'thana_id',
        'union_id',
        'pourashava_id',
        'ward_id',
        'house',


        'uid',

        'role_id',
        // 'nid',
        'reference_name',
        'problem_description',
        'party_designation',
        'location',
        'category_id',
        'organization_id',
        'bank_info',
        'status',
        'reference_name'

    ];


    public function subscriptions()
    {
        return $this->hasMany('App\Models\Subscriptions');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }



    public function fundRequests()
    {
        return $this->hasMany(FoundRequest::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }



    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }



    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id', 'id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }

    public function pourashava()
    {
        return $this->belongsTo(Pourashava::class, 'pourashava_id', 'id');
    }

    public function upozilla()
    {
        return $this->belongsTo(Upazilla::class, 'upazilla_id', 'id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }
}
