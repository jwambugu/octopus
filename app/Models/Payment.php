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
 * App\Models\Payment
 *
 * @property int $id
 * @property string $uuid
 * @property string $account_number
 * @property string|null $merchant_request_id
 * @property string|null $checkout_request_id
 * @property string $amount
 * @property string|null $paid_amount
 * @property string|null $phone_number
 * @property string|null $transaction_id
 * @property mixed|null $request_response_data
 * @property mixed|null $callback_data
 * @property bool $is_successful
 * @property bool $is_validated
 * @property bool $is_paid
 * @property int $booking_id
 * @property int $property_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Property $property
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static Builder|Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCallbackData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCheckoutRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereIsSuccessful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereIsValidated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereMerchantRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereRequestResponseData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUuid($value)
 * @method static Builder|Payment withTrashed()
 * @method static Builder|Payment withoutTrashed()
 * @mixin Eloquent
 * @property-read Booking $booking
 */
class Payment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'account_number',
        'merchant_request_id',
        'checkout_request_id',
        'amount',
        'paid_amount',
        'phone_number',
        'transaction_id',
        'request_response_data',
        'callback_data',
        'is_successful',
        'is_validated',
        'is_paid',
        'booking_id',
        'property_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_successful' => 'boolean',
        'is_validated' => 'boolean',
        'is_paid' => 'boolean',
    ];

    /**
     * Returns the property being paid for.
     * @return BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id')
            ->select([
                'id', 'name', 'slug', 'cost_per_night'
            ]);
    }

    /**
     * Returns the property being paid for.
     * @return BelongsTo
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
