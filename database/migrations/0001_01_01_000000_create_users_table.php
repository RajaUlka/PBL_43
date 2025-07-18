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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
        
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
        
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable(); // jika pakai Jetstream / Teams
            $table->string('profile_photo_path', 2048)->nullable(); // jika pakai Jetstream
        
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        
            $table->enum('role', ['admin', 'teknisi', 'user'])->default('user');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
