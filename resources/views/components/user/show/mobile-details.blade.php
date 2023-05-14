<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
        <h4 style="overflow-wrap: anywhere;">Details</h4>
    </div>

    <div style="width: 50%">
        <ul style="overflow-wrap: anywhere;">
            <li>Cellular Technology</li>
            @if ($product->details->smart)
                <li>Screen Size</li>
                <li>Battery</li>
                <li>Operating System</li>
                <li>Processor</li>
                <li>Storage</li>
                <li>Ram</li>
                <li>Main Camera</li>
                <li>Front Camera</li>
            @endif

        </ul>
    </div>
    <div style="width: 50%">
        <ul style="overflow-wrap: anywhere;">
            <li style="color: #1c1e1e;"> {{ $product->details->network->name }}
            </li>
            @if ($product->details->smart)
                <li style="color: #1c1e1e;">{{ $product->details->screen_size }} Inches
                </li>
                <li style="color: #1c1e1e;">{{ $product->details->battery }} mAh </li>
                <li style="color: #1c1e1e;">
                    {{ $product->details->operatingSystem->name }} Operating System
                </li>
                <li style="color: #1c1e1e;">{{ $product->details->processor->name }} mAh
                </li>
                <li style="color: #1c1e1e;">{{ $product->details->storage }} GB </li>
                <li style="color: #1c1e1e;">{{ $product->details->ram }} GB </li>
                <li style="color: #1c1e1e;">{{ $product->details->main_camera }} MP
                </li>
                <li style="color: #1c1e1e;">{{ $product->details->front_camera }} MP
                </li>
            @endif
        </ul>
    </div>
</div>
