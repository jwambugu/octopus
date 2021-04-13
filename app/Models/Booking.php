<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;


/**
 * App\Models\Booking
 *
 * @property int $id
 * @property string $uuid
 * @property string $checkin_date
 * @property string $checkout_date
 * @property int $number_of_nights
 * @property bool $is_paid
 * @property int $property_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read Property $property
 * @property-read Collection|Payment[] $unsuccessfulPayments
 * @property-read int|null $unsuccessful_payments_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static Builder|Booking onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCheckinDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCheckoutDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereNumberOfNights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUuid($value)
 * @method static Builder|Booking withTrashed()
 * @method static Builder|Booking withoutTrashed()
 * @mixin Eloquent
 * @property string|null $cancelled_at
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCancelledAt($value)
 */
class Booking extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'checkin_date',
        'checkout_date',
        'number_of_nights',
        'is_paid',
        'property_id',
        'user_id',
        'cancelled_at',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_paid' => 'boolean',
    ];

    /**
     * Returns the booking payments
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Returns the property being booked
     * @return BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id')
            ->with('defaultImage')
            ->select([
                'id', 'name', 'slug', 'cost_per_night', 'address', 'admin_id', 'city_id', 'cancellation_policy_id'
            ]);
    }

    /**
     * Get the user who booked the property
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->select([
            'id', 'name', 'email'
        ]);
    }

    /**
     * Returns the payments that were unsuccessful
     * @return HasMany
     */
    public function unsuccessfulPayments(): HasMany
    {
        return $this->payments()
            ->where('is_successful', false)->select([
                'id', 'uuid', 'account_number', 'amount', 'booking_id'
            ]);
    }
}
