<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Network;
use App\Models\OperatingSystem;
use App\Models\Processor;
use App\Models\RefreshRate;
use App\Models\Resolution;
use App\Models\ScreenType;
use App\Models\Slider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => 'App\Policies\ProductPolicy',
        AdvertisingSection::class => 'App\Policies\AdvertisingSectionPolicy',
        Slider::class => 'App\Policies\SliderPolicy',
        Network::class => 'App\Policies\NetworkPolicy',
        Brand::class => 'App\Policies\BrandPolicy',
        OperatingSystem::class => 'App\Policies\OperatingSystemPolicy',
        Processor::class => 'App\Policies\ProcessorPolicy',
        RefreshRate::class => 'App\Policies\RefreshRatePolicy',
        Resolution::class => 'App\Policies\ResolutionPolicy',
        ScreenType::class => 'App\Policies\ScreenTypePolicy',
        Color::class => 'App\Policies\ColorPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });
        $this->registerPolicies();
    }
}
