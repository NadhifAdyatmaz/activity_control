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
        Schema::table('jurnals', function (Blueprint $table) {
            $table->string('materi')->nullable()->change();
            $table->integer('sakit')->nullable()->change();
            $table->integer('izin')->nullable()->change();
            $table->integer('alpha')->nullable()->change();
            $table->string('foto')->nullable()->change();
            $table->string('catatan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jurnals', function (Blueprint $table) {
            //
        });
    }
};
