<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Appartments extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $fillable =
    [
        'country',
        'city',
        'name',
        'pricepernight',
        'stars',
        'owner'
    ];
    function MediaManually()
    {
        return $this->hasMany(Media::class, 'model_id', 'id')->where('model_type', 'App\Models\Appartments');
    }
}
