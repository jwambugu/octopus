<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PropertyImage
 *
 * @property int $id
 * @property string $path
 * @property string $public_url
 * @property int $property_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage wherePublicUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PropertyImage extends Model
{
    use HasFactory, SoftDeletes;
}
