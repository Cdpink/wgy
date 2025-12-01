<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Dog information
            $table->string('age')->nullable();
            $table->string('breed')->nullable();

            // Location
            $table->string('province')->nullable();
            $table->string('city')->nullable();

            // Post settings
            $table->string('interest')->nullable();
            $table->string('audience')->nullable();

            // Post content
            $table->text('message')->nullable();
            $table->string('photo')->nullable();

            // Engagement
            $table->integer('likes_count')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};