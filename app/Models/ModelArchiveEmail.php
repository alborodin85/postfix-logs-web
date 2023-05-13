<?php

namespace App\Models;

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
 * @method static self create(...$params)
 * @method static Builder get()
 * @method static int count()
 */
class ModelArchiveEmail extends Model
{
    protected $table = 'archive_emails';
    protected $guarded = [];
}
