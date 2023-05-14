<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $fillable =
    [
        "fast_charge",
        "description",
        "dual_sim_card",
        "smart",
        "built_in_receiver",
        "product_id",
        "operating_system_id",
        "screen_type_id",
        "refresh_rate_id",
        "processor_id",
        "resolution_id",
        "storage",
        "ram",
        "screen_size",
        "network_id",
        "battery",
        "curved",
        "main_camera",
        "front_camera",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function operatingSystem()
    {
        return $this->belongsTo(OperatingSystem::class, 'operating_system_id');
    }
    public function resolution()
    {
        return $this->belongsTo(Resolution::class, 'resolution_id');
    }

    public function processor()
    {
        return $this->belongsTo(Processor::class, 'processor_id');
    }

    public function network()
    {
        return $this->belongsTo(Network::class, 'network_id');
    }

    public function screenType()
    {
        return $this->belongsTo(ScreenType::class, 'screen_type_id');
    }

    public function refreshRate()
    {
        return $this->belongsTo(RefreshRate::class, 'refresh_rate_id');
    }
}
