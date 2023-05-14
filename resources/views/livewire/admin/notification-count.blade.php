<span wire:poll.10s="updateCount">
    @if ($count)
        <span
            style="position:absolute;top:9px;left:-2px;background:#5873fe;width:15px;height:15px;border-radius:50%;padding:5px;display:flex;justify-content:center;align-items:center;color:black;padding:9px;font-weight:900;">
            {{ $count < 10 ? $count : '9+' }}
        </span>
    @endif

</span>
