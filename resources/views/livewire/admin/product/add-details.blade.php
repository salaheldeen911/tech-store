<div id="AdditionalDetails">
    @if ($additionalStatus)
        <div wire:click="clicked('processor')" class="button-21">
            <span class="additionalTitle">Processor</span>
            <i class="ti-plus"></i>
        </div>
        <div wire:click="clicked('refreshRate')" class="button-21">
            <span class="additionalTitle">Refresh Rate</span>
            <i class="ti-plus"></i>
        </div>
        <div wire:click="clicked('operatingSystem')" class="button-21">
            <span class="additionalTitle">Operating System</span>
            <i class="ti-plus"></i>
        </div>
        <div wire:click="clicked('screenType')" class="button-21">
            <span class="additionalTitle">Screen Type</span>
            <i class="ti-plus"></i>
        </div>
        <div wire:click="clicked('color')" class="button-21">
            <span class="additionalTitle">Color</span>
            <i class="ti-plus"></i>
        </div>
        <div wire:click="clicked('brand')" class="button-21">
            <span class="additionalTitle">Brand</span>
            <i class="ti-plus"></i>
        </div>
        <div wire:click="clicked('resolution')" class="button-21">
            <span class="additionalTitle">Resolution</span>
            <i class="ti-plus"></i>
        </div>
        <div wire:click="clicked('network')" class="button-21">
            <span class="additionalTitle">Network</span>
            <i class="ti-plus"></i>
        </div>
    @endif
    @if (!$additionalStatus)
        @if ($processor['status'])
            <div class="addition_holder">
                <input id="name" type="text" wire:model.lazy="processor.name"
                    placeholder="Please, use real data, instead of using dummy data." class="form-control input-default"
                    name="name" value="{{ old('processor.name') }}"
                    @if ('processor.status') autofocus @endif>
                <div class="addition_actions">
                    <i wire:click="cancele()" class="cancele ti-close" style="color:red"></i>
                    <i wire:click="add('processor')" wire:loading.attr="disabled" class="add ti-check"
                        style="color:green"></i>
                </div>
                @error('processor.name')
                    <span
                        style="color:red;top: -10px;
    left: 40%;
    font-weight: 600; position: absolute;">{{ str_replace('.name', '', $message) }}</span>
                @enderror
            </div>
        @endif
        @if ($operatingSystem['status'])
            <div class="addition_holder">
                <input id="name" type="text" wire:model.lazy="operatingSystem.name"
                    placeholder="Please, use real data, instead of using dummy data." class="form-control input-default"
                    name="name" value="{{ old('operatingSystem.name') }}"
                    @if ('operatingSystem.status') autofocus @endif>
                <div class="addition_actions">
                    <i wire:click="cancele()" class="cancele ti-close" style="color:red"></i>
                    <i wire:click="add('operatingSystem')" wire:loading.attr="disabled" class="add ti-check"
                        style="color:green"></i>
                </div>
                @error('operatingSystem.name')
                    <span
                        style="color:red;top: -10px;
    left: 40%;
    font-weight: 600; position: absolute;">{{ str_replace('.name', '', $message) }}</span>
                @enderror
            </div>
        @endif
        @if ($refreshRate['status'])
            <div class="addition_holder">
                <input id="name" type="text" wire:model.lazy="refreshRate.name"
                    placeholder="Please, use real data, instead of using dummy data." class="form-control input-default"
                    name="name" value="{{ old('refreshRate.name') }}"
                    @if ('refreshRate.status') autofocus @endif>
                <div class="addition_actions">
                    <i wire:click="cancele()" class="cancele ti-close" style="color:red"></i>
                    <i wire:click="add('refreshRate')" wire:loading.attr="disabled" class="add ti-check"
                        style="color:green"></i>
                </div>
                @error('refreshRate.name')
                    <span
                        style="color:red;top: -10px;left: 40%;font-weight: 600; position: absolute;">{{ str_replace('.name', '', $message) }}</span>
                @enderror
            </div>
        @endif
        @if ($screenType['status'])
            <div class="addition_holder">
                <input id="name" type="text" wire:model.lazy="screenType.name"
                    placeholder="Please, use real data, instead of using dummy data." class="form-control input-default"
                    name="name" value="{{ old('screenType.name') }}"
                    @if ('screenType.status') autofocus @endif>
                <div class="addition_actions">
                    <i wire:click="cancele()" class="cancele ti-close" style="color:red"></i>
                    <i wire:click="add('screenType')" wire:loading.attr="disabled" class="add ti-check"
                        style="color:green"></i>
                </div>
                @error('screenType.name')
                    <span
                        style="color:red;top: -10px;
    left: 40%;
    font-weight: 600; position: absolute;">{{ str_replace('.name', '', $message) }}</span>
                @enderror
            </div>
        @endif
        @if ($color['status'])
            <div class="addition_holder">
                <input id="name" type="text" wire:model.lazy="color.name"
                    placeholder="Please, use real data, instead of using dummy data."
                    class="form-control input-default" name="name" value="{{ old('color.name') }}"
                    @if ('color.status') autofocus @endif>
                <div class="addition_actions">
                    <i wire:click="cancele()" class="cancele ti-close" style="color:red"></i>
                    <i wire:click="add('color')" wire:loading.attr="disabled" class="add ti-check"
                        style="color:green"></i>
                </div>
                @error('color.name')
                    <span
                        style="color:red;top: -10px;
    left: 40%;
    font-weight: 600; position: absolute;">{{ str_replace('.name', '', $message) }}</span>
                @enderror
            </div>
        @endif
        @if ($brand['status'])
            <div class="addition_holder">
                <input id="name" type="text" wire:model.lazy="brand.name"
                    placeholder="Please, use real data, instead of using dummy data."
                    class="form-control input-default" name="name" value="{{ old('brand.name') }}"
                    @if ('brand.status') autofocus @endif>
                <div class="addition_actions">
                    <i wire:click="cancele()" class="cancele ti-close" style="color:red"></i>
                    <i wire:click="add('brand')" wire:loading.attr="disabled" class="add ti-check"
                        style="color:green"></i>
                </div>
                @error('brand.name')
                    <span
                        style="color:red;top: -10px;
    left: 40%;
    font-weight: 600; position: absolute;">{{ str_replace('.name', '', $message) }}</span>
                @enderror
            </div>
        @endif
        @if ($resolution['status'])
            <div class="addition_holder">
                <input id="name" type="text" wire:model.lazy="resolution.name"
                    placeholder="Please, use real data, instead of using dummy data."
                    class="form-control input-default" name="name" value="{{ old('resolution.name') }}"
                    @if ('resolution.status') autofocus @endif>
                <div class="addition_actions">
                    <i wire:click="cancele()" class="cancele ti-close" style="color:red"></i>
                    <i wire:click="add('resolution')" wire:loading.attr="disabled" class="add ti-check"
                        style="color:green"></i>
                </div>
                @error('resolution.name')
                    <span
                        style="color:red;top: -10px;
    left: 40%;
    font-weight: 600; position: absolute;">{{ str_replace('.name', '', $message) }}</span>
                @enderror
            </div>
        @endif
        @if ($network['status'])
            <div class="addition_holder">
                <input id="name" type="text" wire:model.lazy="network.name"
                    placeholder="Please, use real data, instead of using dummy data."
                    class="form-control input-default" name="name" value="{{ old('network.name') }}"
                    @if ('network.status') autofocus @endif>
                <div class="addition_actions">
                    <i wire:click="cancele()" class="cancele ti-close" style="color:red"></i>
                    <i wire:click="add('network')" wire:loading.attr="disabled" class="add ti-check"
                        style="color:green"></i>
                </div>
                @error('network.name')
                    <span
                        style="color:red;top: -10px; left: 40%; font-weight: 600; position: absolute;">{{ str_replace('.name', '', $message) }}</span>
                @enderror
            </div>
        @endif
    @endif
</div>
