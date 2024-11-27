<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('evaluasi', function (Blueprint $table) {
            $table->renameColumn('id_pembeli', 'id_invoice');
        });
    }
    
    public function down()
    {
        Schema::table('evaluasi', function (Blueprint $table) {
            $table->renameColumn('id_invoice', 'id_pembeli');
        });
    }
    
};
