<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penyakit', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penyakit', 20)->unique();
            $table->string('nama_penyakit', 255);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('gejala', function (Blueprint $table) {
            $table->id();
            $table->string('kode_gejala', 20)->unique();
            $table->string('nama_gejala', 255);
            $table->double('bobot')->default(0);
            $table->timestamps();
        });

        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat', 20)->unique();
            $table->string('nama_obat', 255);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('penyakit_obat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyakit_id')->constrained('penyakit')->onDelete('cascade');
            $table->foreignId('obat_id')->constrained('obat')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('basis_pengetahuan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rule', 20)->unique();
            $table->foreignId('penyakit_id')->constrained('penyakit')->onDelete('cascade');
            $table->foreignId('gejala_id')->constrained('gejala')->onDelete('cascade');
            $table->double('bobot_gejala')->default(0);
            $table->timestamps();
        });

        Schema::create('diagnosa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('penyakit_id')->nullable()->constrained('penyakit')->nullOnDelete();
            $table->string('nama_user', 255);
            $table->double('nilai_hasil')->default(0);
            $table->enum('keterangan', [
                'Tidak Teridentifikasi',
                'Kemungkinan Kecil',
                'Kemungkinan',
                'Kemungkinan Besar',
                'Hampir Pasti'
            ])->default('Tidak Teridentifikasi');
            $table->timestamps();
        });

Schema::create('diagnosa_gejala', function (Blueprint $table) {
    $table->id();
    $table->foreignId('diagnosa_id')
        ->constrained('diagnosa')
        ->onDelete('cascade');

    $table->foreignId('gejala_id')
        ->constrained('gejala')
        ->onDelete('cascade');

    $table->decimal('nilai_user', 4, 2)->default(0);
});
    }
    public function down(): void {
        Schema::dropIfExists('diagnosa_gejala');
        Schema::dropIfExists('diagnosa');
        Schema::dropIfExists('basis_pengetahuan');
        Schema::dropIfExists('penyakit_obat');
        Schema::dropIfExists('obat');
        Schema::dropIfExists('gejala');
        Schema::dropIfExists('penyakit');
    }
};