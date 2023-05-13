<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $fileName
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static Collection get();
 * @method static self create(...$params)
 * @method static int count()
 * @method static Builder latest()
 * @method static Builder orderByDesc(string $columnName)
 */
class ModelArchiveListItem extends Model
{
    protected $table = 'archive_list';
    protected $guarded = [];
}
