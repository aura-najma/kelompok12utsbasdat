<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pembelians', function (Blueprint $table) {
            $table->timestamp('custom_created_at')->nullable();
            $table->timestamp('custom_updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('pembelians', function (Blueprint $table) {
            $table->dropColumn('custom_created_at');
            $table->dropColumn('custom_updated_at');
        });
    }
    
};
