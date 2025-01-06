<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'city', 'phone', 'latitude', 'longitude'];


    public function scopeWithDistanceTo(Builder $query, float $latitude, float $longitude) {
        $query->selectRaw(
            'ST_Distance_Sphere(point(latitude, longitude), point(:latitude, :longitude)) as distance',
            [
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]
        );
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class);
    }
}
