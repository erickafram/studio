<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Appointment;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Use Tailwind CSS for pagination
        Paginator::useTailwind();
        
        // Fix for MySQL key length issue
        Schema::defaultStringLength(191);

        View::composer('layouts.admin', function ($view) {
            $pendingAlerts = Appointment::where('status', 'pendente')->count();
            $confirmAlerts = Appointment::where('status', 'confirmado')->count();

            $view->with([
                'alertPendingCount' => $pendingAlerts,
                'alertConfirmedCount' => $confirmAlerts,
            ]);
        });
    }
}


