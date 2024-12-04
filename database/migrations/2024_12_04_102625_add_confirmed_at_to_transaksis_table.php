<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->timestamp('confirmed_at')->nullable()->after('harga_total'); 
            // Kolom 'confirmed_at' bersifat nullable dan ditambahkan setelah kolom 'harga_total'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn('confirmed_at');
        });
    }
};
