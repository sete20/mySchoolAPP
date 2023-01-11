<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Lesson extends Model  implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $guarded = [];
    protected $appends = ['video'];
    public function subUnit()
    {
        return $this->belongsTo(SubUnit::class)->withDefault();
    }
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($model) {
            $model->clearMediaCollection('attachments');
            $model->clearMediaCollection('video');
        });
    }
    public function getVideoAttribute()
    {
        if ($this->getMedia('video')->count() != 0)
            return $this->getMedia('video')->last()->getUrl();
        else return null;
    }
}
