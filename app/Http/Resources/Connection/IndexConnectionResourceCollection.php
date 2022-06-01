<?php

namespace App\Http\Resources\Connection;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexConnectionResourceCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = ShowConnectionResource::class;
}
