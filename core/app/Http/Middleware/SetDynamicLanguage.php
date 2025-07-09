
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use Illuminate\Support\Facades\App;

class SetDynamicLanguage
{
    public function handle(Request $request, Closure $next)
    {
        // Check for language parameter in URL
        if ($request->has('lang')) {
            $lang = $request->get('lang');
            LanguageHelper::set_site_language($lang);
        }
        // Check for language in session
        elseif (session()->has('lang')) {
            $lang = session('lang');
            LanguageHelper::set_site_language($lang);
        }
        // Use default language
        else {
            $default = LanguageHelper::default();
            if ($default) {
                LanguageHelper::set_site_language($default->slug);
            }
        }

        return $next($request);
    }
}