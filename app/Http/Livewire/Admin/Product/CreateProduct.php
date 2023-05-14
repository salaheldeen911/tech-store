<?php

namespace App\Http\Livewire\Admin\Product;

use App\Http\Requests\AddLaptopRequest;
use App\Http\Requests\AddMobileRequest;
use App\Http\Requests\AddTVRequest;
use App\Http\Services\ProductService;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Network;
use App\Models\OperatingSystem;
use App\Models\Processor;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\RefreshRate;
use App\Models\Resolution;
use App\Models\ScreenType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Livewire\Component;

class CreateProduct extends Component
{
    use WithFileUploads;

    protected $listeners = ['AdditionAdded' => '$refresh'];

    private $categoriesRules;

    public $final_price = 1;
    public $discount_percent = 0;

    public $oldImages = false;

    public $data = [
        "name" => "",
        "title" => "",
        "used" => false,
        "category_id" => 1,
        "discount" => 0,
        "price" => 1,
        "brand_id" => "",
        "quantity" => 1,
        "color_id" => null,
        "images" => []
    ];

    public $dataDetails = [
        "smart" => false,
        "curved" => false,
        "built_in_receiver",
        "dual_sim_card" => false,
        "operating_system_id" => null,
        "resolution_id" => null,
        "processor_id" => null,
        "screen_type_id" => null,
        "refresh_rate_id" => null,
        "storage" => null,
        "ram" => null,
        "screen_size" => null,
        "network_id" => null,
        "battery" => null,
        "main_camera" => null,
        "front_camera" => null,
        "fast_charge" => false,
        "description" => ""
    ];

    public function updatedDataPrice($val)
    {
        if (!$val) {
            return;
        }
        $this->validateOnly("data.discount", ["data.discount" => "lt:data.price"]);
        $this->manageAmounts();
    }

    public function updatedDataDiscount($val)
    {
        if (!$val) {
            return;
        }
        $this->validateOnly("data.price", ["data.price" => "gt:data.discount"]);
        $this->manageAmounts();
    }

    public function resetImages(): void
    {
        $this->data['images'] = [];
    }

    private function fillRules(): void
    {
        $this->categoriesRules = [
            Product::$mobileCategory => (new AddMobileRequest())->getRules(),
            Product::$tvCategory => (new AddTVRequest())->getRules(),
            Product::$laptopCategory => (new AddLaptopRequest())->getRules(),
        ];
    }

    public function updated($propertyName, $val): void
    {
        $this->fillRules();
        $this->sanitizeData($propertyName, $val);
        $this->resetDetails($propertyName);

        $this->validateOnly($propertyName, $this->categoriesRules[$this->data['category_id']]);
    }

    // public function updatingDataImages($val, $propertyName): void
    // {
    //     $this->fillRules();
    //     // dd($this->categoriesRules[$this->data['category_id']]['data.images']);
    //     dd($this->validateOnly("data." . $propertyName, $this->categoriesRules[$this->data['category_id']]));
    //     $this->validateOnly("data." . $propertyName, $this->categoriesRules[$this->data['category_id']]);
    // }

    private function sanitizeData($propertyName, $val)
    {
        if ($val == '') {
            if ($propertyName == "data.price" || $propertyName == "data.discount") {
                data_set($this, $propertyName, null);
            }
        }
    }

    private function resetDetails($propertyName): void
    {
        if ($propertyName == "data.category_id") {
            $this->reset("dataDetails");
        } elseif ($propertyName == "dataDetails.smart") {
            $updatedSmart = $this->dataDetails["smart"];
            $this->reset("dataDetails");
            $this->dataDetails["smart"] = $updatedSmart;
        }
    }

    private function manageAmounts(): void
    {
        $this->final_price = $this->data["price"] - $this->data["discount"];
        $this->discount_percent = round($this->final_price / $this->data["price"] * 100 - 100);
    }

    private function mergedData($data): array
    {
        $this->manageAmounts();
        $additionalData = [
            "seller_id" => auth()->user()->id,
            "final_price" => $this->final_price,
            "discount_percent" => $this->discount_percent,
        ];

        return array_merge($data["data"], $additionalData);
    }

    public function saveProduct(ProductService $service)
    {
        $dataValid = $this->dataValidate();
        try {
            DB::transaction(function () use ($dataValid, $service) {
                $product = Product::create($this->mergedData($dataValid));
                $service->storeImages($product, $dataValid["data"]["images"]);
                ProductDetail::create(array_merge($dataValid["dataDetails"], ["product_id" => $product->id]));
            });
            $this->reset();
            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            Log::error("error while deleting todos", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);

            return false;
        }
    }

    public function dataValidate(): array
    {
        $this->fillRules();
        $dataValid = $this->validate($this->categoriesRules[$this->data['category_id']]);

        return $dataValid;
    }

    public function render()
    {
        $product = new Product();
        return view('livewire.admin.product.create-product')->with([
            'product' => $product,
            "category_id" => $this->data['category_id'],
            "categories" => Category::select("name", "id")->get(),
            "colors" => Color::select("name", "id")->get(),
            "brands" => Brand::select("name", "id")->get(),
            "operatingSystems" => OperatingSystem::select("name", "id")->get(),
            "processors" => Processor::select("name", "id")->get(),
            "resolutions" => Resolution::select("name", "id")->get(),
            "screen_types" => ScreenType::select("name", "id")->get(),
            "networks" => Network::select("name", "id")->get(),
            "refresh_rates" => RefreshRate::select("name", "id")->get(),
            "final_price" => $this->final_price,
            "discount_percent" => $this->discount_percent,
        ]);
    }
}
