<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $location
 * @property int $supermarket_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Supplier newModelQuery()
 * @method static Builder|Supplier newQuery()
 * @method static Builder|Supplier query()
 * @method static Builder|Supplier whereCreatedAt($value)
 * @method static Builder|Supplier whereDeletedAt($value)
 * @method static Builder|Supplier whereId($value)
 * @method static Builder|Supplier whereLocation($value)
 * @method static Builder|Supplier whereName($value)
 * @method static Builder|Supplier wherePhone($value)
 * @method static Builder|Supplier whereSupermarketId($value)
 * @method static Builder|Supplier whereUpdatedAt($value)
 * @property int $location_id
 * @method static Builder|Supplier whereLocationId($value)
 * @property-read Supermarket|null $supermarket
 * @mixin \Eloquent
 */
class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'location_id',
        'supermarket_id'
    ];

    /**
     * Reverse supplier-supermarket relationship definition
     * @return BelongsTo
     */
    public function supermarket(): BelongsTo
    {
        return $this->belongsTo(Supermarket::class);
    }

    /**
     * supplier Location relationship
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->BelongsTo(Location::class);
    }
}
