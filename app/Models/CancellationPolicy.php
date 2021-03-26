<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\CancellationPolicy
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $timeframe_in_hours
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Property[] $properties
 * @property-read int|null $properties_count
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy newQuery()
 * @method static Builder|CancellationPolicy onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy query()
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy whereTimeframeInHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancellationPolicy whereUpdatedAt($value)
 * @method static Builder|CancellationPolicy withTrashed()
 * @method static Builder|CancellationPolicy withoutTrashed()
 * @mixin Eloquent
 */
class CancellationPolicy extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Returns the properties using the policy.
     * @return HasMany
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
