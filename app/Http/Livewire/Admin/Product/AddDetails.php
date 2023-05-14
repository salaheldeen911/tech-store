<?php

namespace App\Http\Livewire\Admin\Product;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddDetails extends Component
{
    public $additionalStatus = true;

    protected $validationRules = [
        "processor" => 'required|min:2|max:40|unique:processors,name',
        "refreshRate" => 'required|min:2|numeric|max:500|unique:refresh_rates,name',
        "operatingSystem" => 'required|min:2|max:40|unique:operating_systems,name',
        "screenType" => 'required|min:2|max:40|unique:screen_types,name',
        "color" => 'required|min:2|max:40|unique:colors,name',
        "brand" => 'required|min:2|max:40|unique:brands,name',
        "resolution" => 'required|min:2|max:40|unique:resolutions,name',
        "network" => 'required|min:2|max:40|unique:networks,name',
    ];

    public $processor = [
        "status" => false,
        "name" => "",
    ];

    public $refreshRate = [
        "status" => false,
        "name" => "",
    ];

    public $operatingSystem = [
        "status" => false,
        "name" => "",
    ];

    public $screenType = [
        "status" => false,
        "name" => "",
    ];

    public $color = [
        "status" => false,
        "name" => "",
    ];

    public $brand = [
        "status" => false,
        "name" => "",
    ];

    public $resolution = [
        "status" => false,
        "name" => "",
    ];

    public $network = [
        "status" => false,
        "name" => "",
    ];

    public function clicked($val)
    {
        $this->additionalStatus = false;
        data_set($this->$val, 'status', true);
    }

    public function cancele()
    {
        $this->reset();
    }

    public function add($name)
    {
        return $this->createNewRecord($name);
    }

    private function createNewRecord($name)
    {
        $dataValid = $this->validate(["$name.name" => $this->validationRules[$name]]);
        $model = $this->getModel($name);
        if ($this->isValidModel($model)) {
            try {
                $model::create([
                    "name" => $dataValid[$name]["name"],
                    "user_id" => auth()->id(),
                ]);
                $this->emit('AdditionAdded');
                $this->reset();

                return true;
            } catch (\Exception $e) {
                Log::error("error while adding $name", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

                return false;
            }
        }

        return true;
    }

    private function getModel($name)
    {
        return 'App\\Models\\' . ucwords($name);
    }

    private function isValidModel($decorator)
    {
        return class_exists($decorator);
    }

    public function render()
    {
        return view('livewire.admin.product.add-details');
    }
}
