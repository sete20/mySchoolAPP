<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    protected $appends = ['personalImage'];
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
    public function units()
    {
        return $this->belongsToMany(Unit::class, 'users_uints');
    }
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
    public function provider()
    {
        return $this->hasOne(SocialProvider::class);
    }
    public static function store($inputs, $image = null)
    {
        $user =  self::create($inputs);
    }


    public static function boot()
    {
        parent::boot();
        self::deleting(function ($model) {
            $model->units  != null ??   $model->units()->delete();
            $model->provider != null  ??  $model->provider()->delete();
            $model->clearMediaCollection('personal_image');
        });
    }
    public function getPersonalImageAttribute()
    {
        if ($this->getMedia('personal_image')->count() != 0)
            return $this->getMedia('personal_image')->last()->getUrl();
        else return null;
    }
}
