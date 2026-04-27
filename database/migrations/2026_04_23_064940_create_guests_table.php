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
        if (!Schema::hasTable('guests')) {
            Schema::create('guests', function (Blueprint $table) {
                $table->id();
                $table->string('nama', 128);
                $table->enum('status_hadir', ['HADIR', 'TIDAK', 'PENDING'])->default('PENDING');
                $table->string('ucapan', 255)->nullable();
                $table->integer('plusone');
                $table->string('link_undangan', 255)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
