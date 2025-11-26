<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->string('age')->nullable();
        $table->string('breed')->nullable();
        $table->string('province')->nullable();
        $table->string('city')->nullable();
        $table->string('interest')->nullable();
        $table->string('audience')->nullable();
        $table->text('message')->nullable();
        $table->string('photo')->nullable();
    });
}

public function down()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn([
            'age',
            'breed',
            'province',
            'city',
            'interest',
            'audience',
            'message',
            'photo'
        ]);
    });
}

};
