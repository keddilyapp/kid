<?php

namespace App\Http\Controllers\Landlord\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Needed for Session facade
use App\Models\Language; // <--- ADD THIS LINE to query the Language model

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        // First, validate the $locale against your actual database languages
        $supportedLanguage = Language::where('slug', $locale)->where('status', 1)->first();

        if ($supportedLanguage) {
            // Store ONLY the slug in the 'lang' session key
            Session::put('lang', $supportedLanguage->slug);

            // Set the application locale for the current request
            app()->setLocale($supportedLanguage->slug);

            // Set Carbon locale (for dates) for the current request
            \Carbon\Carbon::setLocale($supportedLanguage->slug);

            \Log::info("Frontend language successfully changed to: " . $supportedLanguage->slug);
        } else {
            \Log::warning("Attempted to set unsupported or inactive locale: " . $locale);
            // Optionally, redirect to a default language or show an error
        }

        return redirect()->back();
    }
}