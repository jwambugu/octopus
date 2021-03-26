<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProfilePicture
 *
 * @property int $id
 * @property string $path
 * @property string $public_url
 * @property int $admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Admin $admin
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePicture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePicture newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProfilePicture onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePicture query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePicture whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePicture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePicture whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePicture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePicture wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePicture wherePublicUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePicture whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProfilePicture withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProfilePicture withoutTrashed()
 * @mixin \Eloquent
 */
class ProfilePicture extends Model
{
    use SoftDeletes;

    /**
     * Returns the admin who owns the profile picture
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
