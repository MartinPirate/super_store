<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Supermarket
 *
 * @property int $id
 * @property string $name
 * @property string $location
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Supermarket newModelQuery()
 * @method static Builder|Supermarket newQuery()
 * @method static Builder|Supermarket query()
 * @method static Builder|Supermarket whereCreatedAt($value)
 * @method static Builder|Supermarket whereDeletedAt($value)
 * @method static Builder|Supermarket whereId($value)
 * @method static Builder|Supermarket whereLocation($value)
 * @method static Builder|Supermarket whereName($value)
 * @method static Builder|Supermarket whereUpdatedAt($value)
 * @property int $location_id
 * @method static Builder|Supermarket whereLocationId($value)
 * @property-read Collection<int, Supplier> $suppliers
 * @property-read int|null $suppliers_count
 * @property-read Collection<int, User> $employees
 * @property-read int|null $employees_count
 * @property-read User|null $manager
 * @mixin \Eloquent
 */
class Supermarket extends Model
{
    use HasFactory;


    /**
     * Location Supermarket definition
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->BelongsTo(Location::class);
    }

    /**
     * manager one to one relationship
     * @return HasOne
     */
    public function manager(): HasOne
    {
        return $this->hasOne(User::class)->whereHas('roles', function ($query){
            $query->where('name', 'manager');
        });
    }

    /**
     * Employees one to many Relationship
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(User::class)->whereHas('roles', function ($query){
            $query->where('name', 'cashier') ||    $query->where('name', 'backoffice') ;
        });
    }

    /**
     * Suppliers One to Many Relationship
     * @return HasMany
     */
    public function suppliers(): HasMany
    {
        return $this->hasMany(Supplier::class);

    }


}
