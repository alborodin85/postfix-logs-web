<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $dateTime
 * @property string $hostName
 * @property string $module
 * @property int $procId
 * @property string $queueId
 * @property string $errorLevel
 * @property string $rowText
 */
class ModelArchiveLogRow extends Model
{
    protected $table = 'archive_log_rows';
    protected $hidden = [];
}
