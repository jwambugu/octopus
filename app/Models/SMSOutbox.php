<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\SMSOutbox
 *
 * @property int $id
 * @property string $phone_number
 * @property string $message
 * @property string|null $status
 * @property array|null $response_data
 * @property bool $is_sent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|SMSOutbox newModelQuery()
 * @method static Builder|SMSOutbox newQuery()
 * @method static \Illuminate\Database\Query\Builder|SMSOutbox onlyTrashed()
 * @method static Builder|SMSOutbox query()
 * @method static Builder|SMSOutbox whereCreatedAt($value)
 * @method static Builder|SMSOutbox whereDeletedAt($value)
 * @method static Builder|SMSOutbox whereId($value)
 * @method static Builder|SMSOutbox whereIsSent($value)
 * @method static Builder|SMSOutbox whereMessage($value)
 * @method static Builder|SMSOutbox wherePhoneNumber($value)
 * @method static Builder|SMSOutbox whereResponseData($value)
 * @method static Builder|SMSOutbox whereStatus($value)
 * @method static Builder|SMSOutbox whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SMSOutbox withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SMSOutbox withoutTrashed()
 * @mixin Eloquent
 * @property string|null $sent_at
 * @method static Builder|SMSOutbox whereSentAt($value)
 * @property string $uuid
 * @property string|null $message_id
 * @property string|null $delivery_status
 * @method static Builder|SMSOutbox whereDeliveryStatus($value)
 * @method static Builder|SMSOutbox whereMessageId($value)
 * @method static Builder|SMSOutbox whereUuid($value)
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
        'uuid',
        'message_id',
        'phone_number',
        'message',
        'status',
        'delivery_status',
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
