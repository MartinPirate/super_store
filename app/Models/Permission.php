<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Laratrust\Models\Permission as PermissionModel;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Role> $roles
 * @property-read int|null $roles_count
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission query()
 * @method static Builder|Permission whereCreatedAt($value)
 * @method static Builder|Permission whereDescription($value)
 * @method static Builder|Permission whereDisplayName($value)
 * @method static Builder|Permission whereId($value)
 * @method static Builder|Permission whereName($value)
 * @method static Builder|Permission whereUpdatedAt($value)
 * @property string|null $deleted_at
 * @method static Builder|Permission whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Permission extends PermissionModel
{
    public $guarded = [];
}
