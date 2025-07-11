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
        Schema::create('data_alat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alat_id')->nullable()->constrained('alat')->nullOnDelete();
            $table->float('ph')->nullable();
            $table->float('kekeruhan')->nullable();
            $table->double('tds')->nullable();
            $table->string('status_air')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_alat');
    }
};
