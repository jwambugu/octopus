<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyAmenity extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Returns the property that owns the amenity.
     * @return BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    /**
     * Returns the amenity for the amenity.
     * @return BelongsTo
     */
    public function amenity(): BelongsTo
    {
        return $this->belongsTo(Amenity::class, 'amenity_id');
    }
}
