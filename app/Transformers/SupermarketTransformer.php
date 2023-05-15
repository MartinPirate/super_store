<?php

namespace App\Transformers;

use App\Models\Supermarket;
use League\Fractal\TransformerAbstract;

class SupermarketTransformer extends TransformerAbstract
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
     * @param Supermarket $supermarket
     * @return array
     */
    public function transform(Supermarket $supermarket): array
    {
        return [
            'id' => $supermarket->id,
            'name' => $supermarket->name,
            'location' => $supermarket->location()->pluck('name')['0'],
            'manager' => $supermarket->manager()->pluck('name')['0'],
            'created_at' => format_date($supermarket->created_at),
            'updated_at' => format_date($supermarket->updated_at),
        ];

    }

}
