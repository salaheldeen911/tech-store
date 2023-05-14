<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
        <h4 style="overflow-wrap: anywhere;">Details</h4>
    </div>

    <div style="width: 50%">
        <ul style="overflow-wrap: anywhere;">
            <li>Operating System</li>
            <li>Hard Disk Size</li>
            <li>Ram</li>
            <li>Screen Size</li>
            <li>CPU Model</li>
        </ul>
    </div>
    <div style="width: 50%">
        <ul style="overflow-wrap: anywhere;">
            <li style="color: #1c1e1e;">
                {{ $product->details->operatingSystem->name }} Operating System
            </li>
            <li style="color: #1c1e1e;">{{ $product->details->storage }}GB</li>
            <li style="color: #1c1e1e;">{{ $product->details->ram }}GB</li>
            <li style="color: #1c1e1e;">{{ $product->details->screen_size }} Inches</li>
            <li style="color: #1c1e1e;">{{ $product->details->processor->name }}</li>
        </ul>
    </div>
</div>
