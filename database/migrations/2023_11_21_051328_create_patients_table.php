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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_number_id')->nullable();
            $table->string('name');
            $table->string('address');
            $table->integer('old');
            $table->string('gender');
            $table->string('late_queue_number')->nullable();
            $table->string('status_pemeriksaan')->default('Belum Diperiksa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
