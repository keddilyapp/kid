
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLangColumnToFormBuildersTable extends Migration
{
    public function up()
    {
        Schema::table('form_builders', function (Blueprint $table) {
            $table->string('lang')->default('en_GB')->after('status');
            $table->index('lang');
        });
    }

    public function down()
    {
        Schema::table('form_builders', function (Blueprint $table) {
            $table->dropIndex(['lang']);
            $table->dropColumn('lang');
        });
    }
}