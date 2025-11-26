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
            
            // User account fields
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Pet details (based sa AuthController)
            $table->string('pet_name')->nullable();
            $table->string('pet_breed')->nullable();
            $table->integer('pet_age')->nullable();
            $table->string('pet_gender')->nullable();
            $table->text('pet_features')->nullable();

            // Certificate fields
            $table->string('certificate_path')->nullable();
            $table->boolean('certificate_verified')->default(false);

            // Other default user fields
            $table->string('avatar')->nullable();
            $table->boolean('is_online')->default(false);
            $table->timestamp('last_seen')->nullable();

            // Laravel tokens + timestamps
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
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
