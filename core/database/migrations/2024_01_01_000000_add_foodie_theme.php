
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Themes;

return new class extends Migration
{
    public function up()
    {
        // Insert the foodie theme into the central themes table
        Themes::create([
            'title' => 'Foodie',
            'description' => 'A modern theme designed specifically for food products and restaurants',
            'slug' => 'foodie',
            'status' => true,
            'unique_key' => 'foodie_' . time(),
            'theme_url' => ''
        ]);
    }

    public function down()
    {
        Themes::where('slug', 'foodie')->delete();
    }
};