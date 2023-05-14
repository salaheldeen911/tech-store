<?php

namespace App\Http\Requests;

class AddMobileRequest extends AddProductRequest
{
    private $rules;

    public function __construct()
    {
        $this->rules = array_merge($this->mainRules, [
            "dataDetails.dual_sim_card" => "boolean|nullable",
            "dataDetails.smart" => "boolean|nullable",
            "dataDetails.screen_size" => "required_if:dataDetails.smart,==,true|nullable|numeric|gt:0|max:20",
            "dataDetails.network_id" => "required",
            "dataDetails.battery" => "required_if:dataDetails.smart,==,true|nullable|numeric|gt:0|max:20000",
            "dataDetails.main_camera" => "required_if:dataDetails.smart,==,true|nullable|numeric|gt:0|max:200",
            "dataDetails.front_camera" => "required_if:dataDetails.smart,==,true|nullable|numeric|gt:0|max:200",
            "dataDetails.fast_charge" => "boolean|nullable",
            "dataDetails.storage" => "required_if:dataDetails.smart,==,true|nullable|numeric|gt:0|max:10000",
            "dataDetails.ram" => "required_if:dataDetails.smart,==,true|numeric|nullable|numeric|gt:0|max:50",
            "dataDetails.operating_system_id" => "required_if:dataDetails.smart,==,true|exists:operating_systems,id|nullable",
            "dataDetails.processor_id" => "required_if:dataDetails.smart,==,true|exists:processors,id|nullable",
        ]);
    }

    public function getRules()
    {
        return $this->rules;
    }
}
