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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('featured_image');
            $table->string('redirect_url')->nullable();
            $table->dateTime('start_display_at');
            $table->dateTime('stop_display_at')->nullable()->default(null);
            $table->tinyInteger('is_display_above_page')->default(1);
            $table->tinyInteger('is_display_in_sidebar')->default(1);
            $table->tinyInteger('is_display_within_page')->default(1);
            $table->tinyInteger('is_display_on_homepage')->default(1);
            $table->tinyInteger('is_display_on_allsegments')->default(1);
            $table->tinyInteger('is_active')->default(1);
            $table->string('additional_information')->nullable();
            $table->bigInteger('impressions')->default(0);
            $table->bigInteger('clicks')->default(0);
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
        Schema::dropIfExists('banners');
    }
};
