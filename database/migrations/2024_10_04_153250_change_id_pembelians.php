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
        Schema::table('pembelians', function (Blueprint $table) {
            // Hapus primary key dari kolom `id` jika ada
            $table->dropPrimary();

            // Ubah kolom `id` menjadi tipe tanpa auto-increment
            $table->unsignedBigInteger('id')->change();

            // Tambahkan kolom `new_id` hanya jika belum ada
            if (!Schema::hasColumn('pembelians', 'new_id')) {
                $table->string('new_id')->unique();
            }

            // Atur `new_id` sebagai primary key baru
            $table->primary('new_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelians', function (Blueprint $table) {
            // Hapus primary key dari `new_id`
            $table->dropPrimary('new_id');

            // Hapus kolom `new_id`
            $table->dropColumn('new_id');

            // Tambahkan kembali primary key pada `id`
            $table->primary('id');
        });
    }
};
