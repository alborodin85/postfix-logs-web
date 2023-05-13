<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $lastArchiveFileName
 */
class ArchiveListItem extends Model
{
    protected $table = 'archive_list';
    protected $hidden = [];
}
