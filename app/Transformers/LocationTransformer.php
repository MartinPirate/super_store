<?php

namespace App\Transformers;

use App\Models\Location;
use League\Fractal\TransformerAbstract;

class LocationTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param Location $location
     * @return array
     */
    public function transform(Location $location): array
    {
        return [
            'id' => $location->id,
            'name' => $location->name,
            'created_at' => format_date($location->created_at)
        ];
    }
}
