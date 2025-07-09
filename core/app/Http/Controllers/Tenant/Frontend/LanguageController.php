
<?php

namespace App\Http\Controllers\Tenant\Frontend;

use App\Http\Controllers\Controller;
use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $lang = $request->get('lang');
        $language_helper = new LanguageHelper();
        $all_languages = $language_helper->all_languages(1); // Get active languages
        
        $language_slug = collect($all_languages)->pluck('slug')->toArray();
        
        if (in_array($lang, $language_slug)) {
            session()->put('lang', $lang);
            return redirect()->back();
        }
        
        return redirect()->back();
    }
}