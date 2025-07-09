<?php

namespace App\Http\Middleware;

use App\Models\Language; // Use the correct namespace for your Language model
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log; // For logging issues
use Illuminate\Support\Facades\Session; // For Session facade

class SetLang
{
    public function handle(Request $request, Closure $next)
    {
        // Define the session key for language
        $sessionLangKey = 'lang'; // This must match what LanguageController uses

        // --- Determine the default language ---
        $defaultLangModel = Cache::remember('default_app_language_key', 60 * 60, function () {
            try {
                return Language::where('default', 1)->where('status', 1)->first();
            } catch (\Exception $e) {
                Log::error("SetLang Middleware: Failed to retrieve default language from DB. Error: " . $e->getMessage());
                return null; // Return null if DB query fails
            }
        });

        // Fallback if no default language found in DB or cache
        if (empty($defaultLangModel)) {
            // Attempt to find a common default like 'en' or 'en_GB'
            $defaultLangModel = Language::where('slug', 'en')->where('status', 1)->first();
            if (empty($defaultLangModel)) {
                 $defaultLangModel = Language::where('slug', 'en_GB')->where('status', 1)->first();
            }

            if (empty($defaultLangModel)) {
                Log::critical("SetLang Middleware: No default language or 'en'/'en_GB' found in DB. Hardcoding 'en'. Please ensure your languages table has a default language with status active.");
                // Last resort: create a dummy object for 'en' if absolutely nothing is in DB
                $defaultLangModel = (object)['slug' => 'en', 'name' => 'English', 'direction' => 'ltr'];
            }
        }
        $defaultLangSlug = $defaultLangModel->slug;


        // --- Determine the active language for the current request ---
        $targetLangSlug = $defaultLangSlug; // Start with the default

        if (Session::has($sessionLangKey)) {
            $sessionStoredSlug = Session::get($sessionLangKey);

            // Verify if the session-stored slug is valid and active in the database
            $activeLanguage = Language::where('slug', $sessionStoredSlug)->where('status', 1)->first();

            if (!empty($activeLanguage)) {
                $targetLangSlug = $activeLanguage->slug;
            } else {
                // If the language in session is invalid or inactive, clear it
                Session::forget($sessionLangKey);
                Log::warning("SetLang Middleware: Invalid or inactive language slug '{$sessionStoredSlug}' in session key '{$sessionLangKey}'. Reverting to default: {$defaultLangSlug}.");
            }
        }

        // --- Apply the determined locale ---
        app()->setLocale($targetLangSlug);
        Carbon::setLocale($targetLangSlug);

        // Store the determined language slug back in the session for consistency
        // This ensures if it defaulted, the session gets updated, or it re-confirms the choice.
        Session::put($sessionLangKey, $targetLangSlug);


        return $next($request);
    }
}