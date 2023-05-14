<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 *
 * @method static Builder truncate()
 * @method static self create(...$params)
 * @method static int count()
 * @method static Builder orderByDesc(string $columnName)
 */
class ModelCurrentLogRow extends Model
{
    use HasFactory;

    protected $table = 'current_log_rows';
    protected $guarded = [];
}
