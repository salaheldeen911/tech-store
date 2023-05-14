<?php

namespace App\Http\Requests;

class AddTVRequest extends AddProductRequest
{
    private $rules;

    public function __construct()
    {
        $this->rules = array_merge($this->mainRules, [
            "dataDetails.smart" => "boolean|nullable",
            "dataDetails.screen_size" => "required|numeric|gt:0|max:120",
            "dataDetails.screen_type_id" => "required|exists:screen_types,id",
            "dataDetails.resolution_id" => "required|exists:resolutions,id",
            "dataDetails.refresh_rate_id" => "required|exists:refresh_rates,id",
            "dataDetails.operating_system_id" => "exists:operating_systems,id|nullable",
            "dataDetails.curved" => "boolean|nullable",
        ]);
    }

    public function getRules()
    {
        return $this->rules;
    }
}
