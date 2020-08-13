<?php

namespace App\Providers;

use Exception;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $defaultSettings = $this->app->config->get('settings');

            $settingInDisk = $this->app->settings->all();

            $newSettings = array_merge($defaultSettings,$settingInDisk);
            $this->app->config->set('settings',$newSettings);
        }catch (Exception $e) {
            //TODO collect logs.
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('settings',function () {
            return new SettingsService(new Setting());
        });

        $this->app->alias('settings', SettingsService::class);
    }
}