<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\ReferralCode
 *
 * @property int $id
 * @property string $referral_code
 * @property int|null $user_id
 * @property int|null $admin_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode newQuery()
 * @method static Builder|ReferralCode onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereReferralCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereUserId($value)
 * @method static Builder|ReferralCode withTrashed()
 * @method static Builder|ReferralCode withoutTrashed()
 * @mixin Eloquent
 */
class ReferralCode extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referral_code',
        'user_id',
        'admin_id',
    ];
}
