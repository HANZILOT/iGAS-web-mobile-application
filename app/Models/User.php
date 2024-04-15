<?php

namespace App\Models;

use App\Models\Role;
use App\Traits\BelongsToGasolineStation;
use App\Traits\BelongsToMunicipality;
use App\Traits\HasManySearch;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use 
    BelongsToMunicipality, 
    BelongsToGasolineStation,
    HasFactory,
    HasManySearch,
    InteractsWithMedia,
    Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'birth_date',
        'address',
        'municipality_id',
        'contact',
        'email',
        'password',
        'verification_token',
        'is_activated',
        'email_verified_at',
        'role_id',
        'gasoline_station_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   
    // ==============================Relationship==================================================

    public function avatar():HasOne
    {
        return $this->hasOne(Media::class, 'model_id', 'id');
    }

    // public function gasoline_station()
    // {
    //     return $this->belongsTo(GasolineStation::class, 'gasoline_station_id', 'id');
    // }

    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // ============================== Accessor & Mutator ==========================================

    public function getAvatarProfileAttribute()
    {
        return $this->getFirstMedia('avatar_image')?->getUrl('avatar');
    }
    
    public function getAvatarThumbnailAttribute()
    {
        return $this->getFirstMedia('avatar_image')?->getUrl('thumbnail');
    }

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // ========================== Custom Methods ======================================================

    // media convertion
    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(300)
            ->nonQueued();

        $this->addMediaConversion('avatar')
            ->width(600)
            ->nonQueued();
    }

    public function hasRole($role)
    {
       return $this->role()->where('name', $role)->first() ? true : false;
    }


    // ========================== Scope ======================================================

    public function scopeByRole($query, $role)
    {
        return is_array($role) ? $query->whereIn('role_id', $role) : $query->whereRelation('role', 'name', $role);
    }

    public function scopeActive($query)
    {
        return $query->where('is_activated', true);
    }
    
    public function scopeInactive($query)
    {
        return $query->where('is_activated', false);
    }

    public function scopeNotAdmin($query)
    {
        return $query->where('role_id', '!=', Role::ADMIN);
    }
}