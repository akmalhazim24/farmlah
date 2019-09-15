<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Monitoring;

class MonitoringTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Monitoring $monitor)
    {
        return [
            'id' => $monitor->id,
            'temperature' => $monitor->temperature,
            'humidity' => $monitor->humidity,
            'created_at_humanize' => $monitor->created_at->diffForHumans(),
            'updated_at_humanize' => $monitor->updated_at->diffForHumans()
        ];
    }
}
