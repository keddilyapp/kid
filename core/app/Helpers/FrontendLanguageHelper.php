
<?php

if (!function_exists('frontend_trans')) {
    function frontend_trans($key, $replace = [], $locale = null) {
        if (!$locale) {
            $language_helper = new \App\Helpers\LanguageHelper();
            $current_lang = $language_helper->user_lang();
            $locale = $current_lang ? $current_lang->slug : 'en_GB';
        }
        
        return __($key, $replace, $locale);
    }
}

if (!function_exists('get_frontend_language')) {
    function get_frontend_language() {
        $language_helper = new \App\Helpers\LanguageHelper();
        return $language_helper->user_lang();
    }
}

if (!function_exists('get_all_frontend_languages')) {
    function get_all_frontend_languages() {
        $language_helper = new \App\Helpers\LanguageHelper();
        return $language_helper->all_languages(1);
    }
}

if (!function_exists('get_frontend_direction')) {
    function get_frontend_direction() {
        $language_helper = new \App\Helpers\LanguageHelper();
        return $language_helper->user_lang_dir();
    }
}