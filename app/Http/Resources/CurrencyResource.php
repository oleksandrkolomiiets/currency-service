<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * CurrencyResource constructor.
     * @param Currency $resource
     */
    public function __construct(Currency $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'currency_id' => $this->resource->code,
            'rate' => $this->resource->rate,
        ];
    }
}
