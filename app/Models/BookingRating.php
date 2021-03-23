<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\BookingRating
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $type
 * @property int $is_boolean
 * @property int $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating newQuery()
 * @method static Builder|BookingRating onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating whereIsBoolean($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingRating whereUpdatedAt($value)
 * @method static Builder|BookingRating withTrashed()
 * @method static Builder|BookingRating withoutTrashed()
 * @mixin Eloquent
 */
class BookingRating extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_boolean' => 'boolean',
        'is_active' => 'boolean',
    ];
}
