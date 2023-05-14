<div class="color-content">
    <span class="contact-title">Color:</span>
    <span class="name">{{ $product->color->name }}</span>
</div>
<div class="sim_card-content">
    <span class="contact-title">Smart:</span>
    <span class="sim_card">{{ $product->details->smart ? 'true' : 'false' }}</span>
</div>
<div class="screen_size-content">
    <span class="contact-title">Screen Size:</span>
    <span class="screen_size">{{ $product->details->screen_size }} inch
    </span>
</div>

<div class="sim_card-content">
    <span class="contact-title">Curved:</span>
    <span class="sim_card">{{ $product->details->curved ? 'true' : 'false' }}</span>
</div>

<div class="built_in_receiver-content">
    <span class="contact-title">built_in_receiver:</span>
    <span class="built_in_receiver">{{ $product->details->built_in_receiver == 0 ? 'true' : 'false' }}</span>
</div>
<div class="resolution-content">
    <span class="contact-title">Resolution:</span>
    <span class="resolution">{{ $product->details->resolution->name }}
    </span>
</div>
<div class="resolution-content">
    <span class="contact-title">Screen Type:</span>
    <span class="resolution">{{ $product->details->screenType->name }}
    </span>
</div>
@if ($product->details->smart)
    <div class="main_camera-content">
        <span class="contact-title"> Operating System:</span>
        <span class="operating_system">{{ $product->details->operatingSystem->name }}</span>
    </div>
@endif
