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
        Schema::table('houses', function (Blueprint $table) {
            // Ganti address dengan field-field terpisah
            $table->string('rt')->nullable()->after('kk_name');
            $table->string('rw')->nullable()->after('rt');
            $table->string('dusun')->nullable()->after('rw');
            $table->string('kalurahan')->nullable()->after('dusun');
            $table->string('kecamatan')->nullable()->after('kalurahan');
            $table->string('kabupaten')->nullable()->after('kecamatan');
            $table->string('provinsi')->nullable()->after('kabupaten');
            $table->dropColumn('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->text('address')->nullable();
            $table->dropColumn(['rt', 'rw', 'dusun', 'kalurahan', 'kecamatan', 'kabupaten', 'provinsi']);
        });
    }
};
