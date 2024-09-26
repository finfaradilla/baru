<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('status');
        });
    }
    
    public function down()
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->dropColumn('rejection_reason');
        });
    }    
};
