<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Kaun;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'middle_initial',
        'last_name',
        'street_address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone',
        'email',
        'professional_profile',
        'website',
        'page',
        'password',
        'created_at',
        'updated_at',
        'is_info',
        'is_work',
        'is_education',
        'subscription_frequency',
        'subscription_downgrade',
        'deleted','start_date','end_date','subscription_id','renewal_date','subscription_payment_status'
 
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }
    
    public function subscription_history()
    {

        return $this->hasOne(SubscriptionHistory::class,'user_id','id')->orderBy('id','desc');
    }
    
    public function usercard()
    {
        return $this->hasOne(UserCard::class,'user_id','id');
    }
    
    public function kaun()
    {
        return $this->hasMany(Kaun::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skills::class, 'user_skills', 'user_id', 'skill_id')->withPivot('is_active');
    }

    public function endorsements()
    {
        return $this->hasMany(Endorsement::class, 'user_id', 'id');
    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country');
    }
     public function state()
    {
        return $this->belongsTo(State::class, 'state');
    }
}