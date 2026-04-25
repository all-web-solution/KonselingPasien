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
        Schema::create('counselings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');

            // Data dokter & resep (text semua)
            $table->string('nama_dokter');
            $table->string('nama_obat');
            // $table->string('dosis_dan_aturan_pakai');
            // $table->integer('jumlah_obat');
            // $table->string('lama_terapi');
            $table->text('obat_dan_aturan_pakai');
            // Data diagnosa
            $table->text('diagnosa');

            // Data konseling
            $table->date('tanggal_konseling');
            $table->string('nama_apotek');
            $table->enum('metode_konseling', ['langsung', 'via telp']);
            $table->text('materi_yang_disampaikan');
            $table->text('cara_penggunaan_obat');
            $table->string('waktu_minum_obat');
            $table->text('interaksi_obat_makanan');
            $table->text('penyimpanan_obat');
            $table->text('kepatuhan_minum_obat');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counselings');
        Schema::dropIfExists('patients');
    }
};
