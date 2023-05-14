<div id="createProduct">
    <div class="row" style="border-bottom: 1px solid #c4c4c4;">
        <div class="left_side col-md-7">
            <div class="form-group">
                <label for="used">{{ __('Used') }}</label>
                <div class="input_holder">
                    <input id="used" style="width:20px;margin-left:auto" type="checkbox" wire:model.lazy="data.used"
                        class="form-control @error('dataDetails.used') is-invalid @enderror">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="">{{ __('Name') }}</label>
                <div class="input_holder">
                    <input id="name" type="text" wire:model.lazy="data.name"
                        class="form-control input-default @error('data.name') is-invalid @enderror" name="name"
                        value="{{ old('data.name') }}" autofocus placeholder="Example: Galaxy Note 20">
                    @error('data.name')
                        <span style="color:red">{{ str_replace('data.', '', $message) }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="">{{ __('Title') }}</label>
                <div class="input_holder" style="height:fit-content">
                    <textarea id="title" type="text" wire:model.lazy="data.title" style="height:fit-content"
                        class="form-control input-default @error('data.title') is-invalid @enderror" name="title"
                        value="{{ old('data.title') }}" cols="30" rows="1"
                        placeholder="Example: Samsung Galaxy Note 20 Mobile Phone, Dual SIM, 6.7 Inch, 256 GB, 8 GB RAM, 4G LTE, 4300mAh - Mystic Green"></textarea>
                    @error('data.title')
                        <span style="color:red">{{ str_replace('data.', '', $message) }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="brand">{{ __('Brand') }}</label>
                <div class="input_holder">
                    <select id="brand" wire:model.lazy="data.brand_id" name="brand_id"
                        class="form-control @error('data.brand_id') is-invalid @enderror">
                        <option disabled selected value=""> -- Select A Brand -- </option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ old('data.brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('data.brand_id')
                        <span style="color:red">{{ str_replace('data.', '', $message) }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="category_id">{{ __('Category') }}</label>
                <div class="input_holder">
                    <select id="category_id" wire:model.lazy="data.category_id" name="category_id"
                        class="form-control @error('data.category_id') is-invalid @enderror">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('data.category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('data.category_id')
                        <span style="color:red">{{ str_replace('data.', '', $message) }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="price">{{ __('Price') }}</label>
                <div class="input_holder">
                    <input id="price" wire:model.lazy.lazy="data.price" type="number" min="0.00" max="10000.00"
                        step="0.01" class="form-control @error('data.price') is-invalid @enderror" name="price"
                        value="{{ old('data.price') ? old('data.price') : 1 }}">
                    @error('data.price')
                        <span style="color:red">{{ str_replace('data.', '', $message) }}</span>
                    @enderror
                </div>
                <span class="identifier"> $ </span>
            </div>


            <div class="form-group">
                <label for="discount">{{ __('Discount') }}</label>
                <div class="input_holder">
                    <input id="discount" wire:model.lazy="data.discount" type="number" min="0.00" max="10000.00"
                        step="0.01" class="form-control @error('data.discount') is-invalid @enderror" name="discount"
                        value="{{ old('data.discount') ? old('data.discount') : 0 }}">
                    @error('data.discount')
                        <span style="color:red">{{ str_replace('data.', '', $message) }}</span>
                    @enderror
                </div>
                <span class="identifier"> $ </span>
            </div>

            <hr>
            <div class="form-group">
                <label for="discount">{{ __('Final Price') }}</label>
                <p class="h5" style="margin: 0 auto;">{{ $final_price }}</p>
                <input type="number" wire:model.lazy="final_price" style="display:none;">
                <span class="identifier"> $ </span>
            </div>
            <hr>

            <hr>
            <div class="form-group">
                <label for="discount">{{ __('Discount Percentage') }}</label>
                <p class="h5" style="margin: 0 auto">{{ $discount_percent }}</p>
                <input type="number" wire:model.lazy="discount_percent" style="display:none;">
                <span class="identifier"> % </span>
            </div>
            <hr>

            <div class="form-group">
                <label for="color">{{ __('Color') }}</label>
                <div class="input_holder">
                    <select id="color" wire:model.lazy="data.color_id" name="color"
                        class="form-control @error('data.color_id') is-invalid @enderror">
                        <option disabled selected value=null> -- Select A Color --
                        </option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}"
                                {{ old('data.color_id') == $color->id ? 'selected' : '' }}>
                                {{ $color->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('data.color_id')
                        <span style="color:red">{{ str_replace('data.', '', $message) }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="quantity">{{ __('Quantity') }}</label>
                <div class="input_holder">
                    <input id="quantity" wire:model.lazy="data.quantity"type="number" min="1"
                        class="form-control @error('data.quantity') is-invalid @enderror" name="quantity"
                        value="{{ old('data.quantity') ? old('data.quantity') : 1 }}">
                    @error('data.quantity')
                        <span style="color:red">{{ str_replace('data.', '', $message) }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="right_side col-md-5">
            @if ($category_id == $product::$mobileCategory)
                <div class="form-group">
                    <label for="smart">{{ __('Smart') }}</label>
                    <div class="input_holder">
                        <input id="smart" style="width:20px;margin-left:auto" type="checkbox"
                            wire:model.lazy="dataDetails.smart"
                            class="form-control @error('dataDetails.smart') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group">
                    <label for="dual_sim_card">{{ __('Dual Sim Card') }}</label>
                    <div class="input_holder">
                        <input id="dual_sim_card" style="width:20px;margin-left:auto" type="checkbox"
                            wire:model.lazy="dataDetails.dual_sim_card"
                            class="form-control @error('dataDetails.dual_sim_card') is-invalid @enderror">

                        @error('dataDetails.dual_sim_card')
                            <span style="color:red">{{ str_replace('data details.', '', $message) }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="network">{{ __('Network') }}</label>
                    <div class="input_holder">
                        <select id="network" wire:model.lazy="dataDetails.network_id" name="network"
                            class="form-control @error('dataDetails.network_id') is-invalid @enderror">
                            <option disabled selected value=null> -- Select Network --
                            </option>
                            @foreach ($networks as $network)
                                <option value="{{ $network->id }}"
                                    {{ old('dataDetails.network_id') == $network->id ? 'selected' : '' }}>
                                    {{ $network->name }}</option>
                            @endforeach
                        </select>
                        @error('dataDetails.network_id')
                            <span style="color:red">{{ str_replace(['data details.', 'id'], '', $message) }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="screen_size">{{ __('Screen Size') }}</label>
                    <div class="input_holder">
                        <input id="screen_size" wire:model.lazy="dataDetails.screen_size" type="number"
                            class="form-control @error('dataDetails.screen_size') is-invalid @enderror"
                            name="screen_size" value="{{ old('dataDetails.screen_size') }}">
                        @error('dataDetails.screen_size')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                    <span class="identifier"> (Inch) </span>
                </div>

                <div class="form-group">
                    <label for="battery">{{ __('Battery') }}</label>
                    <div class="input_holder">
                        <input id="battery" wire:model.lazy="dataDetails.battery" type="number" max="10000"
                            min="300" class="form-control @error('dataDetails.battery') is-invalid @enderror"
                            name="battery" value="{{ old('dataDetails.battery') }}">
                        @error('dataDetails.battery')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                    <span class="identifier"> (mAh) </span>
                </div>

                @if ($dataDetails['smart'])
                    <div class="form-group">
                        <label for="operating_system">{{ __('Operating System') }}</label>
                        <div class="input_holder">
                            <select id="operating_system" wire:model.lazy="dataDetails.operating_system_id"
                                name="operating_system"
                                class="form-control @error('dataDetails.operating_system_id') is-invalid @enderror">
                                <option disabled selected value=null> -- Select Operating System --
                                </option>
                                @foreach ($operatingSystems as $operatingSystem)
                                    <option value="{{ $operatingSystem->id }}"
                                        {{ old('dataDetails.operating_system_id') == $operatingSystem->id ? 'selected' : '' }}>
                                        {{ $operatingSystem->name }}</option>
                                @endforeach
                            </select>
                            @error('dataDetails.operating_system_id')
                                <span
                                    style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="processor">{{ __('Processor') }}</label>
                        <div class="input_holder">
                            <select id="processor" wire:model.lazy="dataDetails.processor_id" name="processor_id"
                                class="form-control @error('dataDetails.processor_id') is-invalid @enderror">
                                <option disabled selected value=null> -- Select Processor -- </option>
                                @foreach ($processors as $processor)
                                    <option value="{{ $processor->id }}"
                                        {{ old('dataDetails.processor_id') == $processor->id ? 'selected' : '' }}>
                                        {{ $processor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dataDetails.processor_id')
                                <span
                                    style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="storage">{{ __('Storage') }}</label>
                        <div class="input_holder">
                            <input id="ram" wire:model.lazy="dataDetails.storage" type="number"
                                class="form-control  @error('dataDetails.storage') is-invalid @enderror"
                                value="{{ old('dataDetails.storage') }}">
                            @error('dataDetails.storage')
                                <span
                                    style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ram">{{ __('Ram') }}</label>
                        <div class="input_holder">
                            <input id="ram" wire:model.lazy="dataDetails.ram" type="number" max="50"
                                min="1" class="form-control  @error('dataDetails.ram') is-invalid @enderror"
                                name="ram" value="{{ old('dataDetails.ram') }}">
                            @error('dataDetails.ram')
                                <span
                                    style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                            @enderror
                        </div>
                        <span class="identifier"> GB </span>
                    </div>

                    <div class="form-group">
                        <label for="main_camera">{{ __('Main Camera') }}</label>
                        <div class="input_holder">
                            <input id="main_camera" wire:model.lazy="dataDetails.main_camera" type="number"
                                class="form-control @error('dataDetails.main_camera') is-invalid @enderror"
                                name="main_camera" value="{{ old('dataDetails.main_camera') }}">
                            @error('dataDetails.main_camera')
                                <span
                                    style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                            @enderror
                        </div>

                        <span class="identifier"> MP </span>
                    </div>

                    <div class="form-group">
                        <label for="front_camera">{{ __('Front Camera') }}</label>
                        <div class="input_holder">
                            <input id="front_camera" wire:model.lazy="dataDetails.front_camera" type="number"
                                class="form-control @error('dataDetails.front_camera') is-invalid @enderror"
                                name="front_camera" value="{{ old('dataDetails.front_camera') }}">
                            @error('dataDetails.front_camera')
                                <span
                                    style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                            @enderror
                        </div>
                        <span class="identifier"> MP </span>
                    </div>

                    <div class="form-group">
                        <label for="fast_charge">{{ __('Fast Charge') }}</label>
                        <div class="input_holder">
                            <input id="fast_charge" style="width:20px;margin-left:auto" type="checkbox"
                                wire:model.lazy="dataDetails.fast_charge"
                                class="form-control @error('dataDetails.fast_charge') is-invalid @enderror">
                        </div>
                    </div>
                @endif
            @endif
            @if ($category_id == $product::$tvCategory)
                <div class="form-group">
                    <label for="smart">{{ __('Smart') }}</label>
                    <div class="input_holder">
                        <input id="smart" style="width:20px;margin-left:auto" type="checkbox"
                            wire:model.lazy="dataDetails.smart"
                            class="form-control @error('dataDetails.smart') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group">
                    <label for="referesh_rate">{{ __('Refresh Rate') }}</label>
                    <div class="input_holder">
                        <select id="referesh_rate" wire:model.lazy="dataDetails.refresh_rate_id" name="resolution_id"
                            class="form-control @error('dataDetails.refresh_rate_id') is-invalid @enderror">
                            <option disabled selected value=null> -- Select refresh Rate -- </option>
                            @foreach ($refresh_rates as $refresh_rate)
                                <option value="{{ $refresh_rate->id }}"
                                    {{ old('dataDetails.refresh_rate_id') == $refresh_rate->id ? 'selected' : '' }}>
                                    {{ $refresh_rate->name }}Hz
                                </option>
                            @endforeach
                        </select>
                        @error('dataDetails.refresh_rate_id')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="built_in_receiver">{{ __('built_in_receiver') }}</label>
                    <div class="input_holder">
                        <input id="built_in_receiver" style="width:20px;margin-left:auto" type="checkbox"
                            wire:model.lazy="dataDetails.built_in_receiver"
                            class="form-control @error('dataDetails.built_in_receiver') is-invalid @enderror">
                    </div>
                </div>

                <div class="form-group">
                    <label for="screen_size">{{ __('Screen Size') }}</label>
                    <div class="input_holder">
                        <input id="screen_size" wire:model.lazy="dataDetails.screen_size" type="number"
                            class="form-control @error('dataDetails.screen_size') is-invalid @enderror"
                            name="screen_size" value="{{ old('dataDetails.screen_size') }}">
                        @error('dataDetails.screen_size')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                    <span class="identifier"> (Inch) </span>
                </div>
                <div class="form-group">
                    <label for="curved">{{ __('Curved') }}</label>
                    <div class="input_holder">
                        <input id="curved" style="width:20px;margin-left:auto" type="checkbox"
                            wire:model.lazy="dataDetails.curved"
                            class="form-control @error('dataDetails.curved') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group">
                    <label for="resolutions">{{ __('Resolution') }}</label>
                    <div class="input_holder">
                        <select id="resolutions" wire:model.lazy="dataDetails.resolution_id" name="resolution_id"
                            class="form-control @error('dataDetails.resolution_id') is-invalid @enderror">
                            <option disabled selected value=null> -- Select Resolution -- </option>
                            @foreach ($resolutions as $resolution)
                                <option value="{{ $resolution->id }}"
                                    {{ old('dataDetails.resolution_id') == $resolution->id ? 'selected' : '' }}>
                                    {{ $resolution->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('dataDetails.resolution_id')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="screen_types">{{ __('Screen Type') }}</label>
                    <div class="input_holder">
                        <select id="screen_types" wire:model.lazy="dataDetails.screen_type_id" name="screen_type_id"
                            class="form-control @error('dataDetails.screen_type_id') is-invalid @enderror">
                            <option disabled selected value=null> -- Select Screen Type -- </option>
                            @foreach ($screen_types as $screen_type)
                                <option value="{{ $screen_type->id }}"
                                    {{ old('dataDetails.screen_type_id') == $screen_type->id ? 'selected' : '' }}>
                                    {{ $screen_type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('dataDetails.screen_type_id')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                </div>

                @if ($dataDetails['smart'])
                    <div class="form-group">
                        <label for="operating_system">{{ __('Operating System') }}</label>
                        <div class="input_holder">
                            <select id="operating_system" wire:model.lazy="dataDetails.operating_system_id"
                                name="operating_system"
                                class="form-control @error('dataDetails.operating_system_id') is-invalid @enderror">
                                <option disabled selected value=null> -- Select Operating System --
                                </option>
                                @foreach ($operatingSystems as $operatingSystem)
                                    <option value="{{ $operatingSystem->id }}"
                                        {{ old('dataDetails.operating_system_id') == $operatingSystem->id ? 'selected' : '' }}>
                                        {{ $operatingSystem->name }}</option>
                                @endforeach
                            </select>
                            @error('dataDetails.operating_system_id')
                                <span
                                    style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                            @enderror
                        </div>
                    </div>

                @endif
            @endif
            @if ($category_id == $product::$laptopCategory)
                <div class="form-group">
                    <label for="screen_size">{{ __('Screen Size') }}</label>
                    <div class="input_holder">
                        <input id="screen_size" wire:model.lazy="dataDetails.screen_size" type="number"
                            class="form-control @error('dataDetails.screen_size') is-invalid @enderror"
                            name="screen_size" value="{{ old('dataDetails.screen_size') }}">
                        @error('dataDetails.screen_size')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                    <span class="identifier"> (Inch) </span>
                </div>

                <div class="form-group">
                    <label for="operating_system">{{ __('Operating System') }}</label>
                    <div class="input_holder">
                        <select id="operating_system" wire:model.lazy="dataDetails.operating_system_id"
                            name="operating_system"
                            class="form-control @error('dataDetails.operating_system_id') is-invalid @enderror">
                            <option disabled selected value=null> -- Select Operating System --
                            </option>
                            @foreach ($operatingSystems as $operatingSystem)
                                <option value="{{ $operatingSystem->id }}"
                                    {{ old('dataDetails.operating_system_id') == $operatingSystem->id ? 'selected' : '' }}>
                                    {{ $operatingSystem->name }}</option>
                            @endforeach
                        </select>
                        @error('dataDetails.operating_system_id')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="processor">{{ __('Processor') }}</label>
                    <div class="input_holder">
                        <select id="processor" wire:model.lazy="dataDetails.processor_id" name="processor_id"
                            class="form-control @error('dataDetails.processor_id') is-invalid @enderror">
                            <option disabled selected value=null> -- Select Processor -- </option>
                            @foreach ($processors as $processor)
                                <option value="{{ $processor->id }}"
                                    {{ old('dataDetails.processor_id') == $processor->id ? 'selected' : '' }}>
                                    {{ $processor->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('dataDetails.processor_id')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="storage">{{ __('Storage') }}</label>
                    <div class="input_holder">
                        <input id="ram" wire:model.lazy="dataDetails.storage" type="number"
                            class="form-control  @error('dataDetails.storage') is-invalid @enderror"
                            value="{{ old('dataDetails.storage') }}">
                        @error('dataDetails.storage')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                    <span class="identifier"> GB </span>

                </div>

                <div class="form-group">
                    <label for="ram">{{ __('Ram') }}</label>
                    <div class="input_holder">
                        <input id="ram" wire:model.lazy="dataDetails.ram" type="number" max="50"
                            min="1" class="form-control  @error('dataDetails.ram') is-invalid @enderror"
                            name="ram" value="{{ old('dataDetails.ram') }}">
                        @error('dataDetails.ram')
                            <span
                                style="color:red">{{ str_replace(['data details.', 'when smart is true.'], '', $message) }}</span>
                        @enderror
                    </div>
                    <span class="identifier"> GB </span>
                </div>
            @endif
        </div>
    </div>

    <div class="w-100 description">
        <label class="w-100" for="description">{{ __('Description') }}</label>

        <div class="w-100">
            <textarea id="description" wire:model.lazy="dataDetails.description"
                class="form-control w-100  @error('dataDetails.description') is-invalid @enderror" rows="3"
                name="description"
                placeholder="Example: This device has the world's most powerful S Pen The 120Hz Infinity-O Display is fast, making pen strokes from the S Pen even more precise, so you can write naturally. Not only that, S Pen features Bluetooth that turns it into a useful wireless controller for your phone.">
            </textarea>
            @error('dataDetails.description')
                <span class="error" style="color:red">{{ str_replace(['details.'], '', $message) }}</span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="imagesContainer" class="container show-images-container" style="align-items: end">
                @if (count($data['images']) == 0)
                    <div class="image" style="left:65px; position:absolute; top:10px;">
                        <span wire:if='isUploading' role="button" wire:loading.attr="disabled"
                            onclick="clickUpload(this)" class="btn btn-dark">{{ __('Add images') }}</span>
                        <input id="imagesInput" wire:loading.attr="disabled" class="image-input" type="file"
                            accept="image/*" min="1" max="4" multiple wire:model.lazy="data.images">
                    </div>
                @endif

                @if (count($data['images']) > 0)
                    <span wire:loading.attr="disabled" style="left:65px; position:absolute; top:10px;" role="button"
                        class="btn btn-danger" wire:click="resetImages">Reset</span>
                @endif

                @if (count($data['images']) !== 0)
                    @foreach ($data['images'] as $image)
                        <div class="sub-image-holder w-25 mt-1 mb-1 pl-1 pr-1" style="justify-self: end">
                            <img style="width:100%;height:100%;padding-top: 10px;"
                                src="{{ $image->temporaryUrl() }}" alt="">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @error('data.images')
            <span class="error"
                style="color:red">{{ str_replace(['data.', 'when old images is false'], '', $message) }}</span>
        @enderror
        @error('data.images.*')
            <span class="error"
                style="color:red">{{ str_replace(['data.', '0', '1', '2', '3', '.'], '', $message) }}</span>
        @enderror
    </div>

    <div class="row">
        <div style="margin:0 auto;">
            <button wire:loading.attr="disabled" wire:click="saveProduct" type="submit" class="btn btn-primary">
                {{ __('Add new product') }}
            </button>
        </div>
    </div>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
</div>
@push('scripts')
    <script>
        function clickUpload(label) {
            label.nextElementSibling.click();
        }
    </script>
@endpush
