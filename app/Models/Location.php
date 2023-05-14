<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Location
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Location newModelQuery()
 * @method static Builder|Location newQuery()
 * @method static Builder|Location query()
 * @method static Builder|Location whereCreatedAt($value)
 * @method static Builder|Location whereId($value)
 * @method static Builder|Location whereName($value)
 * @method static Builder|Location whereUpdatedAt($value)
 * @property string|null $deleted_at
 * @property-read Collection<int, Supermarket> $supermarket
 * @property-read int|null $supermarket_count
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|Location whereDeletedAt($value)
 * @property-read Collection<int, Supplier> $suppliers
 * @property-read int|null $suppliers_count
 * @mixin \Eloquent
 */
class Location extends Model
{
    use HasFactory;


    /**
     * location -supermarkets relationships
     * @return HasMany
     */
    public function supermarket(): HasMany
    {
        return $this->hasMany(Supermarket::class);
    }

    /**
     * location-users relationships
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }


    /**
     * location-suppliers relationships
     * @return HasMany
     */
    public function suppliers(): HasMany
    {
        return $this->hasMany(Supplier::class);
    }

}
