<?php

namespace App\Models;

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

        'uid',

        'role_id',
        'nid',
        'reference',
        'problem_description',
        'party_designation',
        'location',
        'category',
        'organization',
        'bank_info',
        'status'
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
}
