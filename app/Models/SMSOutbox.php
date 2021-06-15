<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SMSOutbox
 *
 * @property int $id
 * @property string $phone_number
 * @property string $message
 * @property string|null $status
 * @property array|null $response_data
 * @property bool $is_sent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox newQuery()
 * @method static \Illuminate\Database\Query\Builder|SMSOutbox onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox query()
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox whereIsSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox whereResponseData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SMSOutbox whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SMSOutbox withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SMSOutbox withoutTrashed()
 * @mixin \Eloquent
 */
class SMSOutbox extends Model
{
    use SoftDeletes;

    protected $table = 'sms_outboxes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone_number',
        'message',
        'status',
        'response_data',
        'is_sent',
        'sent_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_sent' => 'boolean',
        'response_data' => 'json',
    ];
}
