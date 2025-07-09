
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\StaticOption;

class AddPaytabsExchangeRateSetting extends Migration
{
    public function up()
    {
        // Check if the setting doesn't exist and add it
        $existingSetting = StaticOption::where('option_name', 'paytabs_egy_exchange_rate')->first();
        
        if (!$existingSetting) {
            StaticOption::create([
                'option_name' => 'paytabs_egy_exchange_rate',
                'option_value' => '1'
            ]);
        }
    }

    public function down()
    {
        StaticOption::where('option_name', 'paytabs_egy_exchange_rate')->delete();
    }
}