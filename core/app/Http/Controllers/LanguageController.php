
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function change_language(Request $request)
    {
        $lang_slug = $request->get('lang');
        
        if ($lang_slug) {
            $language = LanguageHelper::get_language_by_slug($lang_slug);
            
            if ($language) {
                Session::put('lang', $lang_slug);
                LanguageHelper::set_site_language($lang_slug);
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Language changed successfully',
                    'redirect' => url()->previous()
                ]);
            }
        }
        
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid language'
        ], 400);
    }

    public function get_languages()
    {
        return response()->json([
            'languages' => LanguageHelper::get_frontend_languages(),
            'current' => LanguageHelper::user_lang_slug()
        ]);
    }
}