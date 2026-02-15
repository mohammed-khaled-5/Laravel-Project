<?php

namespace App\Models; // Check your namespace
namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event; // 1. Add this import
use Laravel\Cashier\Events\WebhookReceived; // 2. Add this import
use App\Listeners\StripeEventListener; // 3. Add this import

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        // 4. Register the Listener to catch the Stripe Webhook Event
        Event::listen(
            WebhookReceived::class,
            StripeEventListener::class
        );
    }
}
