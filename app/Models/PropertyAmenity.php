<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\PropertyAmenity
 *
 * @property int $id
 * @property int $property_id
 * @property int $amenity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Amenity $amenity
 * @property-read Property $property
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAmenity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAmenity newQuery()
 * @method static Builder|PropertyAmenity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAmenity query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAmenity whereAmenityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAmenity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAmenity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAmenity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAmenity wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAmenity whereUpdatedAt($value)
 * @method static Builder|PropertyAmenity withTrashed()
 * @method static Builder|PropertyAmenity withoutTrashed()
 * @mixin Eloquent
 */
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
