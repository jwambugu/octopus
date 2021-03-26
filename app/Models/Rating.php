<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;


/**
 * App\Models\Rating
 *
 * @property int $id
 * @property string $uuid
 * @property array|null $guest_ratings
 * @property array|null $host_ratings
 * @property int $booking_id
 * @property int|null $user_id
 * @property int|null $admin_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newQuery()
 * @method static Builder|Rating onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereGuestRatings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereHostRatings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUuid($value)
 * @method static Builder|Rating withTrashed()
 * @method static Builder|Rating withoutTrashed()
 * @mixin Eloquent
 */
class Rating extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'guest_ratings',
        'host_ratings',
        'booking_id',
        'user_id',
        'admin_id',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'guest_ratings' => 'json',
        'host_ratings' => 'json',
    ];
}
