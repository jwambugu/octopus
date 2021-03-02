<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @property int $property_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static Builder|Booking onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCheckinDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCheckoutDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUuid($value)
 * @method static Builder|Booking withTrashed()
 * @method static Builder|Booking withoutTrashed()
 * @mixin Eloquent
 */
class Booking extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'checkin_date',
        'checkout_date',
        'property_id',
        'user_id',
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
        return $this->belongsTo(Property::class, 'property_id')->select([
            'id', 'name', 'slug', 'cost_per_night'
        ]);
    }

    /**
     * Returns the payments that were unsuccessful
     * @return HasMany
     */
    public function unsuccessfulPayments(): HasMany
    {
        return $this->payments()->where('is_successful', false)->select([
            'id', 'uuid', 'account_number', 'amount', 'booking_id'
        ]);
    }
}
