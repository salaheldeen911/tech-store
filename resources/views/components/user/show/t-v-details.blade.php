<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
        <h4 style="overflow-wrap: anywhere;">Details</h4>
    </div>

    <div style="width: 50%">
        <ul style="overflow-wrap: anywhere;">
            <li>Screen Size</li>
            <li>Resolution</li>
            <li>Display Technology</li>
            @if ($product->details->operatingSystem)
                <li>Operating System</li>
            @endif
            <li>Refersh Rate</li>

        </ul>
    </div>
    <div style="width: 50%">
        <ul style="overflow-wrap: anywhere;">
            <li style="color: #1c1e1e;">{{ $product->details->screen_size }} Inches</li>
            <li style="color: #1c1e1e;">{{ $product->details->resolution->name }}</li>
            <li style="color: #1c1e1e;">{{ $product->details->screenType->name }}</li>
            @if ($product->details->operatingSystem)
                <li style="color: #1c1e1e;">
                    {{ $product->details->operatingSystem->name }} Operating System
                </li>
            @endif
            <li style="color: #1c1e1e;">{{ $product->details->refreshRate->name }}</li>

        </ul>
    </div>
</div>
