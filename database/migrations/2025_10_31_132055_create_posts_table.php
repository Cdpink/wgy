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

            // Dog information - CHANGED age to integer
            $table->integer('age')->nullable();
            $table->string('breed')->nullable();

            // Location
            $table->string('province')->nullable();
            $table->string('city')->nullable();

            // Post settings
            $table->string('interest')->nullable();
            $table->enum('audience', ['public', 'friends'])->default('public');

            // Post content
            $table->text('message')->nullable();
            $table->string('photo')->nullable();

            // Engagement
            $table->integer('likes_count')->default(0);

            $table->timestamps();

            // Add indexes for better query performance
            $table->index('user_id');
            $table->index('age');
            $table->index('breed');
            $table->index('city');
            $table->index('province');
            $table->index('audience');
            $table->index('created_at');
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