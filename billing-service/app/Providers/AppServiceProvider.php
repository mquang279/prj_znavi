<?php

namespace App\Providers;


use App\Repositories\BillItemRepositoryImpl;
use App\Repositories\BillRepositoryImpl;
use App\Repositories\Interfaces\BillItemRepository;
use App\Repositories\Interfaces\BillRepository;
use App\Services\BillServiceImpl;
use App\Services\Interface\BillService;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BillItemRepository::class, BillItemRepositoryImpl::class);
        $this->app->bind(BillRepository::class, BillRepositoryImpl::class);
        $this->app->bind(BillService::class, BillServiceImpl::class);
        $this->app->bind(\App\Inventory\InventoryClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
    }

    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null
        );
    }
}
