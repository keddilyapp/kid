
<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FrontendLanguage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'frontend.language';
    }
    
    public static function current()
    {
        $helper = app('frontend.language');
        return $helper->user_lang();
    }
    
    public static function all()
    {
        $helper = app('frontend.language');
        return $helper->all_languages(1);
    }
    
    public static function translate($key, $lang = null)
    {
        if (!$lang) {
            $current = static::current();
            $lang = $current ? $current->slug : 'en_GB';
        }
        
        return __($key, [], $lang);
    }
}