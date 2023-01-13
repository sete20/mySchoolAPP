<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function subUnits()
    {
        return $this->hasMany(SubUnit::class)->withDefault();
    }
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }
}
