<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
/**
 * Run the migrations.
 *
 * @return void
 */
public function up()
{
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        $table->string('title');
        $table->longText('body');
        $table->string('image');
        $table->foreignId('user_id')->constrained();
        $table->enum('is_deleted', ['Y', 'N'])->default('N');
        $table->unsignedBigInteger('category_id');
    });
}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::dropIfExists('articles');
}
}