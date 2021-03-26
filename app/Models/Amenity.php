<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Amenity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Amenity newModelQuery()
 * @method static Builder|Amenity newQuery()
 * @method static Builder|Amenity query()
 * @method static Builder|Amenity whereCreatedAt($value)
 * @method static Builder|Amenity whereDeletedAt($value)
 * @method static Builder|Amenity whereIcon($value)
 * @method static Builder|Amenity whereId($value)
 * @method static Builder|Amenity whereName($value)
 * @method static Builder|Amenity whereSlug($value)
 * @method static Builder|Amenity whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Amenity onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Amenity withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Amenity withoutTrashed()
 */
class Amenity extends Model
{
    use SoftDeletes;
}
