
<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widgets;
use App\Models\Language;
use Illuminate\Http\Request;

class WidgetManageController extends Controller
{
    public function index()
    {
        $all_languages = Language::where('status', 1)->get();
        $current_lang = request()->get('lang', get_default_language());
        $all_widgets = Widgets::all();
        
        return view('tenant.admin.widgets.widget-index', compact('all_widgets', 'all_languages', 'current_lang'));
    }
    
    public function update_widget(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if (is_array($value)) {
                // Handle multilingual fields
                foreach ($value as $lang => $lang_value) {
                    update_static_option($key . '_' . $lang, $lang_value);
                }
            } elseif (!in_array($key, ['_token', '_method'])) {
                // Handle regular fields
                update_static_option($key, $value);
            }
        }

        return redirect()->back()->with(['msg' => __('Widget updated successfully'), 'type' => 'success']);
    }
}