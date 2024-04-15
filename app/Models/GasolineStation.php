<?php

namespace App\Models;

use App\Traits\BelongsToMunicipality;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class GasolineStation extends Model implements HasMedia
{
    use HasFactory, 
    BelongsToMunicipality, 
    InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'contact',
        'address',
        'municipality_id',
        'latitude',
        'longitude',
        'time_started_at',
        'time_ended_at',
        'is_always_open'
    ];

    // ==============================Relationship==================================================

    public function gasoline_fees():HasMany
    {
        return $this->hasMany(GasolineFee::class);
    }

    public function services():HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }
    
    public function ratings():HasMany
    {
        return $this->hasMany(Rating::class);
    }
    
    public function averageRating()
    {
        return $this->ratings->avg('rating');
    }
    
    public function numberOfReviews()
    {
        return $this->ratings->count();
    }
    // ============================== Accessor & Mutator ==========================================

    public function getFeaturedPhotoAttribute()
    {
        return $this->getFirstMedia('featured_photo')->getUrl('card');
    }

    public function getAvgRatingsAttribute()
    {
        return $this->ratings()->avg('rating');
    }

    // ========================== Custom Methods ======================================================
    

    //media convertion
    public function registerMediaCollections(): void
    {
        // $this
        // ->addMediaConversion('original')
        // ->width(512)
        // ->keepOriginalImageFormat()
        // ->nonQueued();

         $this
        ->addMediaConversion('card')
        ->width(650)
        ->nonQueued();
    }
}