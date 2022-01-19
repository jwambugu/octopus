<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property-read City $city
 * @property-read Admin $owner
 * @property int $has_sent_approval_notifications
 * @property string|null $approved_at
 * @property string|null $suspended_at
 * @method static Builder|Property whereApprovedAt($value)
 * @method static Builder|Property whereHasSentApprovalNotifications($value)
 * @method static Builder|Property whereSuspendedAt($value)
 * @property int|null $cancellation_policy_id
 * @property-read CancellationPolicy|null $cancellationPolicy
 * @method static Builder|Property whereCancellationPolicyId($value)
 * @property string|null $reason_for_suspension
 * @method static Builder|Property whereReasonForSuspension($value)
 * @property string|null $google_place_id
 * @method static Builder|Property whereGooglePlaceId($value)
 * @property string $checkin_time
 * @property string $checkout_time
 * @method static Builder|Property whereCheckinTime($value)
 * @method static Builder|Property whereCheckoutTime($value)
 * @property-read Collection|Booking[] $activeBookingsDates
 * @property-read int|null $active_bookings_dates_count
 * @property-read Collection|Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property string $type
 * @property int $price
 * @method static Builder|Property wherePrice($value)
 * @method static Builder|Property whereType($value)
 * @method static Builder|Property byType(string $type)
 * @method static Builder|Property ofType(string $type)
 */
class Property extends Model
{
    use SoftDeletes;

    public const TYPE_VACATION = 'vacation';
    public const TYPE_LEASE = 'lease';
    public const TYPE_SALE = 'sale';

    public const SORTING_OPTIONS = [
        '_price_asc' => 'cost_per_night:asc',
        '_price_desc' => 'cost_per_night:desc',
        '_time_added_asc' => 'created_at:desc',
        '_time_added_desc' => 'created_at:desc',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'location' => 'object',
        'is_available' => 'boolean',
        'has_sent_approval_notifications' => 'boolean',
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
        return $this->hasOne(PropertyImage::class)->select([
            'id', 'public_url', 'property_id'
        ]);
    }

    /** Returns the owner of the property.
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    /**
     * Returns the city the property is in.
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id')->select([
            'id', 'name', 'slug'
        ]);
    }

    /**
     * Returns the property cancellation policy
     * @return BelongsTo
     */
    public function cancellationPolicy(): BelongsTo
    {
        return $this->belongsTo(CancellationPolicy::class, 'cancellation_policy_id');
    }

    /**
     * Returns all the bookings for the property
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'property_id');
    }

    /**
     * Returns all the dates for the active bookings
     * @return HasMany
     */
    public function activeBookingsDates(): HasMany
    {
        return $this->bookings()->whereDate('checkout_date', '>=', today())
            ->where([
                'is_paid' => true,
                'is_cancelled_by_host' => false,
                'has_conflicts' => false,
            ])
            ->select([
                'property_id', 'checkin_date', 'checkout_date'
            ]);
    }

    /**
     * Scope a query to only include properties of a given type.
     * @param Builder $query
     * @param string $type
     * @return Builder
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->select('id', 'name', 'type', 'slug', 'address', 'cost_per_night', 'property_type_id')
            ->whereHas('owner', function ($query) {
                return $query->where('status', 'active')->select('id');
            })->with('defaultImage')
            ->where([
                'is_available' => true,
                'status' => 'approved',
                'type' => $type,
            ]);
    }
}
