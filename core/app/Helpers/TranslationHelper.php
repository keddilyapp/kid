
<?php

if (!function_exists('__t')) {
    /**
     * Translate the given message with multi-language support
     *
     * @param string $key
     * @param array $replace
     * @param string|null $locale
     * @return string
     */
    function __t($key, $replace = [], $locale = null)
    {
        return \App\Helpers\LanguageHelper::translate($key, $locale, $key);
    }
}

if (!function_exists('get_current_language')) {
    /**
     * Get current language
     *
     * @return object|null
     */
    function get_current_language()
    {
        return \App\Helpers\LanguageHelper::user_lang();
    }
}

if (!function_exists('get_all_languages')) {
    /**
     * Get all active languages
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function get_all_languages()
    {
        return \App\Helpers\LanguageHelper::get_frontend_languages();
    }
}

if (!function_exists('get_language_direction')) {
    /**
     * Get language direction
     *
     * @param string|null $lang_slug
     * @return string
     */
    function get_language_direction($lang_slug = null)
    {
        return \App\Helpers\LanguageHelper::get_direction($lang_slug);
    }
}