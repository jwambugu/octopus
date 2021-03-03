<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Property newModelQuery()
 * @method static Builder|Property newQuery()
 * @method static Builder|Property query()
 * @method static Builder|Property whereAddress($value)
 * @method static Builder|Property whereAdminId($value)
 * @method static Builder|Property whereAdultsCount($value)
 * @method static Builder|Property whereAmenities($value)
 * @method static Builder|Property whereCityId($value)
 * @method static Builder|Property whereCostPerNight($value)
 * @method static Builder|Property whereCreatedAt($value)
 * @method static Builder|Property whereDeletedAt($value)
 * @method static Builder|Property whereDescription($value)
 * @method static Builder|Property whereId($value)
 * @method static Builder|Property whereIsAvailable($value)
 * @method static Builder|Property whereKidsCount($value)
 * @method static Builder|Property whereLocation($value)
 * @method static Builder|Property whereName($value)
 * @method static Builder|Property wherePropertyTypeId($value)
 * @method static Builder|Property whereSlug($value)
 * @method static Builder|Property whereStatus($value)
 * @method static Builder|Property whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $bedrooms
 * @property-read int|null $amenities_count
 * @property-read Collection|PropertyImage[] $defaultImage
 * @property-read int|null $default_image_count
 * @property-read Collection|PropertyImage[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Query\Builder|Property onlyTrashed()
 * @method static Builder|Property whereBedrooms($value)
 * @method static \Illuminate\Database\Query\Builder|Property withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Property withoutTrashed()
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
        'location' => 'object',
        'is_available' => 'boolean',
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
     * Returns the first property image
     * @return HasOne
     */
    public function defaultImage(): HasOne
    {
        return $this->hasOne(PropertyImage::class);
    }
}
