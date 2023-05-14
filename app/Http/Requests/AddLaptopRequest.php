<?php

namespace App\Http\Requests;

class AddLaptopRequest extends AddProductRequest
{
    private $rules;

    public function __construct()
    {
        $this->rules = array_merge($this->mainRules, [
            "dataDetails.storage" => "required|numeric|gt:0|max:10000",
            "dataDetails.ram" => "required|numeric|numeric|gt:0|max:100",
            "dataDetails.screen_size" => "required|numeric|gt:0|max:60",
            "dataDetails.operating_system_id" => "required|exists:operating_systems,id|nullable",
            "dataDetails.processor_id" => "required|exists:processors,id",
        ]);
    }

    public function getRules()
    {
        return $this->rules;
    }
}
