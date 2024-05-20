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
        Schema::table('jadwals', function (Blueprint $table) {
            $table->unsignedBigInteger('periode_id')->after('tanggal_jadwal')->nullable();
            $table->foreign('periode_id')->references('id')->on('periodes')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('kelas_id')->after('periode_id')->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('jampel_id')->after('kelas_id')->nullable();
            $table->foreign('jampel_id')->references('id')->on('jampels')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('mapel_id')->after('jampel_id')->nullable();
            $table->foreign('mapel_id')->references('id')->on('mapels')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->after('mapel_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('jurnal_id')->after('catatan')->nullable();
            $table->foreign('jurnal_id')->references('id')->on('jurnals')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropColumn('periode_id');
            $table->dropColumn('kelas_id');
            $table->dropColumn('jampel_id');
            $table->dropColumn('mapel_id');
            $table->dropColumn('user_id');
            $table->dropColumn('jurnal_id');
            
        });
    }
};
