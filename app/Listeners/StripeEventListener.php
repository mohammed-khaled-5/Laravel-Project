<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event)
    {
        // Check if the event from Stripe is a successful payment
        if ($event->payload['type'] === 'checkout.session.completed') {
            $session = $event->payload['data']['object'];

            // Find the user by their Stripe ID
            $user = \App\Models\User::where('stripe_id', $session['customer'])->first();

            if ($user) {
                $user->update(['plan' => 'premium']);
            }
        }
    }
}
