<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Laratrust\Models\Role as RoleModel;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereDescription($value)
 * @method static Builder|Role whereDisplayName($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @property string|null $deleted_at
 * @method static Builder|Role whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Role extends RoleModel
{
    public $guarded = [];
}
