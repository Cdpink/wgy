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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('age', 4, 2)->change();
            $table->string('breed')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('interest')->nullable();
            $table->string('audience')->nullable();
            $table->text('message')->nullable();
            $table->string('photo')->nullable();
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
