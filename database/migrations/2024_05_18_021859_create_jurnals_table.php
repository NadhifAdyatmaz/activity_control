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
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_jurnal');
            $table->string('materi');
            $table->integer('sakit');
            $table->integer('izin');
            $table->integer('alpha');
            $table->string('foto');
            $table->string('catatan');
            $table->enum('is_validation',['valid','invalid'])->default('invalid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
