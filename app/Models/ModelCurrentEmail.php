<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
 *
 * @method static Builder truncate()
 * @method static self create(...$params)
 * @method static int count()
 */
class ModelCurrentEmail extends Model
{
    use HasFactory;

    protected $table = 'current_emails';
    protected $guarded = [];
}
