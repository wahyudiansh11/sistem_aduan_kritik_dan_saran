<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('aduans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket', 20)->unique();
            $table->string('nama_pelapor');
            $table->string('wa')->nullable();
            $table->boolean('darurat')->default(false);
            $table->text('isi_aduan');
            $table->string('kategori');
            $table->string('lokasi')->nullable();
            $table->enum('status', ['baru','diproses','selesai','ditolak'])->default('baru');
            $table->string('lampiran_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aduans');
    }
};
