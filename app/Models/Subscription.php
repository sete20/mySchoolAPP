<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $with = ['units', 'units.subUnits', 'units.subUnits.lessons'];
    public function users()
    {
        return $this->hasMany(User::class)->withDefault();
    }
    public function units()
    {
        return $this->belongsToMany(Unit::class);
    }
}
