<?php

namespace Bilalbaraz\SupabaseLaravel;

use Illuminate\Support\ServiceProvider;

class SupabaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/supabase.php', 'supabase');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton(Database::class);
        $this->publishes([__DIR__ . '/../config/supabase.php' => config_path('supabase.php')], 'supabase-config');
    }
}
