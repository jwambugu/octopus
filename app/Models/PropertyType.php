<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PropertyType
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|PropertyType newModelQuery()
 * @method static Builder|PropertyType newQuery()
 * @method static Builder|PropertyType query()
 * @method static Builder|PropertyType whereCreatedAt($value)
 * @method static Builder|PropertyType whereDeletedAt($value)
 * @method static Builder|PropertyType whereId($value)
 * @method static Builder|PropertyType whereIsActive($value)
 * @method static Builder|PropertyType whereName($value)
 * @method static Builder|PropertyType whereSlug($value)
 * @method static Builder|PropertyType whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PropertyType extends Model
{
    use HasFactory;
}
