<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Refund
 *
 * @property int $id
 * @property int $amount
 * @property string|null $refunded_at
 * @property int $booking_id
 * @property int $payment_channel_id
 * @property int $user_id
 * @property int $admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Refund newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund newQuery()
 * @method static \Illuminate\Database\Query\Builder|Refund onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund query()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund wherePaymentChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Refund withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Refund withoutTrashed()
 * @mixin \Eloquent
 */
class Refund extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'booking_id',
        'payment_channel_id',
        'user_id',
        'admin_id',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];
}
