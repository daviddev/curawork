<?php

namespace App\Http\Resources\Connection;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ShowConnectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource->relationLoaded('receivedConnections') && $this->resource['receivedConnections']->isEmpty()) {
            $this->resource['connections'] = $this->resource['acceptedConnections'];
            unset($this->resource['receivedConnections']);
            unset($this->resource['acceptedConnections']);
        } elseif ($this->resource->relationLoaded('acceptedConnections') && $this->resource['acceptedConnections']->isEmpty()) {
            $this->resource['connections'] = $this->resource['receivedConnections'];
            unset($this->resource['receivedConnections']);
            unset($this->resource['acceptedConnections']);
        }

        return parent::toArray($request);
    }
}
