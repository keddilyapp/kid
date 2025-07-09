<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Helpers\LanguageHelper;

class LanguageServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

public function boot()
    {
        // Share language data with all views
        View::composer('*', function ($view) {
            $languageHelper = new LanguageHelper();
            $view->with([
                'current_language' => $languageHelper->user_lang(),
                'all_languages' => $languageHelper->all_languages(1), // 1 for active languages
                'language_direction' => $languageHelper->user_lang_dir(),
                'current_lang_slug' => $languageHelper->user_lang_slug()
            ]);
        });

        // Register custom translation helper
        if (!function_exists('__t')) {
            function __t($key, $default = null) {
                return LanguageHelper::translate($key, null, $default);
            }
        }
    }
}