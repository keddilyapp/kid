<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Language; // Your Language model

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('frontend.partials.navbar', function ($view) { // Adjust 'frontend.partials.header' to your actual header partial path
            $view->with('all_languages', Language::where('status', 1)->get());
        });
    }
}