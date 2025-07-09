
<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticOption;
use App\Models\Language;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function update_widget(Request $request)
    {
        $all_languages = Language::all();
        
        foreach ($request->all() as $key => $value) {
            if (is_array($value)) {
                // Handle multilingual fields
                foreach ($value as $lang => $lang_value) {
                    $option_name = $key . '_' . $lang;
                    StaticOption::updateOrCreate(
                        ['option_name' => $option_name],
                        ['option_value' => $lang_value]
                    );
                }
            } else {
                // Handle regular fields
                StaticOption::updateOrCreate(
                    ['option_name' => $key],
                    ['option_value' => $value]
                );
            }
        }

        return redirect()->back()->with('msg', __('Widget updated successfully'));
    }
}