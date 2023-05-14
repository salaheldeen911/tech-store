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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Livewire\Component;

class UpdateProduct extends Component
{
    use WithFileUploads, AuthorizesRequests;

    protected $listeners = ['AdditionAdded' => '$refresh'];

    private $categoriesRules;

    public $final_price = 1;
    public $discount_percent = 0;

    public $product;

    public $oldImages = true;

    public $data = [
        "name" => "",
        "title" => "",
        "category_id" => 1,
        "used" => false,
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
        "built_in_receiver" => false,
        "dual_sim_card" => false,
        "operating_system_id" => null,
        "resolution_id" => null,
        "processor_id" => null,
        "screen_type_id" => null,
        "refresh_rate_id" => null,
        "storage" => null,
        "ram" => null,
        "screen_size" => null,
        "network" => null,
        "battery" => null,
        "main_camera" => null,
        "front_camera" => null,
        "fast_charge" => false,
        "description" => ""
    ];

    public function mount($product)
    {
        $this->product = $product;
        $this->data['name'] = $product->name;
        $this->data['title'] = $product->title;
        $this->data['used'] = $product->used;
        $this->data["category_id"] = $product->category_id;
        $this->data["discount"] = $product->discount;
        $this->data["price"] = $product->price;
        $this->data["brand_id"] = $product->brand_id;
        $this->data["quantity"] = $product->quantity;
        $this->data["color_id"] = $product->color_id;
        $this->data["images"][] = $product->main_image;
        foreach ($product->subImages as $img) {
            $this->data["images"][] = $img->sub_image;
        }

        $this->dataDetails['smart'] = $product->details->smart;
        $this->dataDetails['built_in_receiver'] = $product->details->built_in_receiver;
        $this->dataDetails["curved"] = $product->details->curved;
        $this->dataDetails["dual_sim_card"] = $product->details->dual_sim_card;
        $this->dataDetails["operating_system_id"] = $product->details->operating_system_id;
        $this->dataDetails["resolution_id"] = $product->details->resolution_id;
        $this->dataDetails["processor_id"] = $product->details->processor_id;
        $this->dataDetails["screen_type_id"] = $product->details->screen_type_id;
        $this->dataDetails['storage'] = $product->details->storage;
        $this->dataDetails["ram"] = $product->details->ram;
        $this->dataDetails["screen_size"] = $product->details->screen_size;
        $this->dataDetails["network_id"] = $product->details->network_id;
        $this->dataDetails["refresh_rate_id"] = $product->details->refresh_rate_id;
        $this->dataDetails["battery"] = $product->details->battery;
        $this->dataDetails["main_camera"] = $product->details->main_camera;
        $this->dataDetails["front_camera"] = $product->details->front_camera;
        $this->dataDetails["fast_charge"] = $product->details->fast_charge;
        $this->dataDetails["description"] = $product->details->description;

        $this->manageAmounts();
    }

    public function updated($propertyName, $val): void
    {
        $this->authorize('update', $this->product);

        $this->fillRules();
        $this->sanitizeData($propertyName, $val);
        $this->resetDetails($propertyName);
        $this->validateOnly($propertyName, $this->categoriesRules[$this->data['category_id']]);
    }

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
        if ($this->oldImages) {
            $this->oldImages = false;
        }
        $this->data['images'] = [];
    }

    public function updateProduct(ProductService $service)
    {
        $dataValid = $this->dataValidate();
        try {
            DB::transaction(function () use ($dataValid, $service) {
                if (!$this->oldImages) {
                    $service->updateImages($this->product, $dataValid["data"]["images"]);
                }
                $this->product->update($this->mergedData($dataValid));

                ProductDetail::where('product_id', $this->product->id)->update($dataValid["dataDetails"]);
            });
            $this->reset();

            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            Log::error("error while deleting todos", ['error_msg' => $e->getMessage(), "trace" => $e->getTraceAsString()]);
            return false;
        }
    }

    private function fillRules(): void
    {
        $this->categoriesRules = [
            Product::$mobileCategory => (new AddMobileRequest())->getRules(),
            Product::$tvCategory => (new AddTVRequest())->getRules(),
            Product::$laptopCategory => (new AddLaptopRequest())->getRules(),
        ];
    }

    private function sanitizeData($propertyName, $val)
    {
        if ($val == '') {
            if ($propertyName == "data.price" || $propertyName == "data.discount") {
                data_set($this, $propertyName, 0);
            } else {
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
            "final_price" => $this->final_price,
            "discount_percent" => $this->discount_percent,
        ];

        return array_merge($data["data"], $additionalData);
    }

    private function dataValidate(): array
    {
        $this->fillRules();
        $dataValid = $this->validate($this->categoriesRules[$this->data['category_id']]);

        return $dataValid;
    }

    public function render()
    {
        $product = new Product();
        return view('livewire.admin.product.update-product')->with([
            'product' => $product,
            "category_id" => $this->data['category_id'],
            "categories" => Category::select("name", "id")->get(),
            "colors" => Color::select("name", "id")->get(),
            "brands" => Brand::select("name", "id")->get(),
            "operatingSystems" => OperatingSystem::select("name", "id")->get(),
            "processors" => Processor::select("name", "id")->get(),
            "resolutions" => Resolution::select("name", "id")->get(),
            "screen_types" => ScreenType::select("name", "id")->get(),
            "final_price" => $this->final_price,
            "networks" => Network::select("name", "id")->get(),
            "refresh_rates" => RefreshRate::select("name", "id")->get(),
            "discount_percent" => $this->discount_percent,
        ]);
    }
}
