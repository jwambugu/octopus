<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Property
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $adults_count
 * @property int $kids_count
 * @property int $cost_per_night
 * @property int $is_available
 * @property string $status
 * @property mixed|null $amenities
 * @property string $address
 * @property mixed|null $location
 * @property int $city_id
 * @property int $property_type_id
 * @property int $admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property query()
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAdultsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAmenities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCostPerNight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereKidsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePropertyTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Property extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * Returns the properties amenities
     * @return HasMany
     */
    public function amenities(): HasMany
    {
        return $this->hasMany(PropertyAmenity::class)
            ->with('amenity:id,name,slug,icon')
            ->select([
                'id', 'property_id', 'amenity_id'
            ]);
    }

    /**
     * Returns the property images.
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class)->select([
            'id', 'public_url', 'property_id'
        ]);
    }

    /**
     * Returns the first property images
     * @return HasMany
     */
    public function defaultImage(): HasMany
    {
        return $this->images()->take(1);
    }
}
