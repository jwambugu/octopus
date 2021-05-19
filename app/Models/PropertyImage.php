<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\PropertyImage
 *
 * @property int $id
 * @property string $path
 * @property string $public_url
 * @property int $property_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
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
 * @mixin Eloquent
 * @method static Builder|PropertyImage onlyTrashed()
 * @method static Builder|PropertyImage withTrashed()
 * @method static Builder|PropertyImage withoutTrashed()
 * @property int $uploaded_to_cloud_storage
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImage whereUploadedToCloudStorage($value)
 */
class PropertyImage extends Model
{
    use SoftDeletes;
}
