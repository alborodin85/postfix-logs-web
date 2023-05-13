<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $dateTime
 * @property string $queueId
 * @property string $from
 * @property string $to
 * @property string $subject
 * @property string $statusText
 * @property string $statusCode
 * @property string $statusName
 * @property string $nonDeliveryNotificationId
 */
class DailyEmail extends Model
{
    protected $table = 'daily_emails';
    protected $hidden = [];
}
