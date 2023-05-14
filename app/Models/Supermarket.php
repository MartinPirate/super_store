<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Supermarket
 *
 * @property int $id
 * @property string $name
 * @property string $location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Supermarket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supermarket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supermarket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supermarket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supermarket whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supermarket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supermarket whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supermarket whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supermarket whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Supermarket extends Model
{
    use HasFactory;
}
