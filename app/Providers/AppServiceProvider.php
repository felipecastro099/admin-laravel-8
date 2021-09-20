<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSettings();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->checkSettingsTable();
    }

    /**
     * // Only use the settings if the settings table is present in the database
     *
     * @return void
     */
    public function checkSettingsTable()
    {
        if (!\App::runningInConsole() && count(Schema::getColumnListing('settings'))) {
            // Get all settings from the database
            $settings = Setting::where('active', true)->get();
            // Bind all settings to the Laravel config, so you can call them like
            foreach ($settings as $key => $setting):
                Config::set($setting->key, $setting->value);
            endforeach;
        }
    }

    /**
     * Register settings.
     *
     * @return void
     */
    private function registerSettings()
    {
        $this->app->bind('settings', function ($app) {
            return new Settings($app);
        });
    }
}
