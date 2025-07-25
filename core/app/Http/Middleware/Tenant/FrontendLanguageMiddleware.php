
<?php

namespace App\Http\Middleware\Tenant;

use App\Helpers\LanguageHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FrontendLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('lang')) {
            $lang = session('lang');
        } else {
            $lang = LanguageHelper::default_slug();
        }
        
        App::setLocale($lang);
        
        return $next($request);
    }
}