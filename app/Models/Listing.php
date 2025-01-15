<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'beds',
        'baths',
        'area',
        'city',
        'street',
        'code',
        'street_nr',
        'price'
    ];

    protected $sortable = [
        'price',
        'created_at'
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(\App\Models\User::class, 'by_user_id');
    }

    public function images(): HasMany {
        return $this->hasMany(ListingImage::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder {
        return $query->when($filters['priceFrom'] ?? false, fn($query, $priceFrom) => $query->where('price', '>=', $priceFrom))
            ->when($filters['priceTo'] ?? false, fn($query, $priceTo) => $query->where('price', '<=', $priceTo))
            ->when($filters['beds'] ?? false, fn($query, $beds) => $query->where('beds', $beds))
            ->when($filters['baths'] ?? false, fn($query, $baths) => $query->where('baths', $baths))
            ->when($filters['areaFrom'] ?? false, fn($query, $areaFrom) => $query->where('area', '>=', $areaFrom))
            ->when($filters['areaTo'] ?? false, fn($query, $areaTo) => $query->where('area', '<=', $areaTo))
            ->when($filters['deleted'] ?? false, fn($query) => $query->withTrashed())
            ->when($filters['by'] ?? false, fn($query, $value) 
                => !in_array($value, $this->sortable)
                    ? $query
                    : $query->orderBy($value, $filters['order'] ?? 'desc'));
    }
}
