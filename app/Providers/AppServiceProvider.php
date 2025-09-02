<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;
    use Illuminate\Pagination\Paginator; // <-- KJO ËSHTË E DOMOSDOSHME

    class AppServiceProvider extends ServiceProvider
    {
        public function register(): void
        {
            //
        }

        public function boot(): void
        {

            Paginator::useBootstrapFive();

        }
    }
