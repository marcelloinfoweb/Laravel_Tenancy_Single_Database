<?php

namespace App\Listeners;

class TenantInSessionListener
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
    public function handle(object $event): void
    {
        session()->put('tenant', auth()->user()->tenant_id);
    }
}
