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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->tinyInteger('is_primary_user')->default(0);
            $table->tinyInteger('is_admin')->default(0);
            $table->tinyInteger('is_editor')->default(0);
            $table->tinyInteger('is_author')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->dateTime('paid_subscription_end_at')->nullable()->default(null);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
