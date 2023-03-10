<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $title
 * @property string $content
 * @property float $price
 *
 * @method static Builder where(...$params)
 * @method static Builder latest(...$params)
 * @method static self find(...$params)
 */
class Bb extends Model
{
    protected $fillable = ['title', 'content', 'price'];
}
