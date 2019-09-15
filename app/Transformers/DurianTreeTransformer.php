<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\DurianTree;

class DurianTreeTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(DurianTree $tree)
    {
        return [
            'id' => $tree->id,
            'name' => $tree->name,
            'description' => $tree->description,
            'created_at' => $tree->created_at,
            'api_key' => $tree->api_key,
            'created_at_humanize' => optional($tree->created_at)->diffForHumans(),
            'updated_at' => $tree->updated_at,
            'updated_at_humanize' => optional($tree->updated_at)->diffForHumans()
        ];
    }
}
