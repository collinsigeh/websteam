<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->longText('body');
            $table->string('featured_image')->nullable();
            $table->string('tags')->nullable();
            $table->enum('visibility', ['public', 'paid_subscribers', 'private'])->default('public');
            $table->tinyInteger('is_scheduled')->default(0);
            $table->timestamp('publish_at')->nullable()->default(null);
            $table->tinyInteger('is_published')->default(0);
            $table->timestamp('published_at')->nullable()->default(null);
            $table->bigInteger('views')->default(0);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
