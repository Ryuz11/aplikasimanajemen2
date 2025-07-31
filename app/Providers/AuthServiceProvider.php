<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\PurchaseRequest;
use App\Policies\PurchaseRequestPolicy;
use App\Models\Barang;
use App\Policies\BarangPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        PurchaseRequest::class => PurchaseRequestPolicy::class,
        Barang::class => BarangPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
        // Gate tambahan jika perlu
    }
}
