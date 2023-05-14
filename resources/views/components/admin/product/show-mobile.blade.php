<div class="color-content">
    <span class="contact-title">Color:</span>
    <span class="name">{{ $product->color->name }}</span>
</div>
<div class="sim_card-content">
    <span class="contact-title">Smart:</span>
    <span class="sim_card">{{ $product->details->smart == 1 ? 'true' : 'false' }}</span>
</div>

<div class="sim_card-content">
    <span class="contact-title">Dual Sim_Card:</span>
    <span class="sim_card">{{ $product->details->dual_sim_card == 0 ? 'true' : 'false' }}</span>
</div>

@if ($product->details->smart)
    <div class="birthday-content">
        <span class="contact-title">Storage:</span>
        <span>{{ $product->details->storage }} GB</span>
    </div>

    <div class="battery-content">
        <span class="contact-title">Battery:</span>
        <span>{{ $product->details->battery }} Mah</span>
    </div>
    <div class="screen_size-content">
        <span class="contact-title">Screen Size:</span>
        <span class="screen_size">{{ $product->details->screen_size }} inch
        </span>
    </div>
    <div class="processor-content">
        <span class="contact-title">Processor:</span>
        <span class="processor">{{ $product->details->processor->name }}
        </span>
    </div>
    <div class="front_camera-content">
        <span class="contact-title">Front Camera:</span>
        <span class="front_camera">{{ $product->details->front_camera }} MP
        </span>
    </div>
    <div class="main_camera-content">
        <span class="contact-title">Main Camera:</span>
        <span class="main_camera">{{ $product->details->main_camera }}
            MP</span>
    </div>
    <div class="main_camera-content">
        <span class="contact-title"> Operating System:</span>
        <span class="operating_system">{{ $product->details->operatingSystem->name }}</span>
    </div>
@endif
