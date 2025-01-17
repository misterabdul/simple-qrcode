<?php

namespace SimpleSoftwareIO\QrCode;

use Illuminate\Support\ServiceProvider;

class QrCodeServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind('qrcode', function () {
            return new Generator();
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [Generator::class];
    }
}
