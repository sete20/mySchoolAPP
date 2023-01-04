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
            $table->string('email')->unique();
            $table->string('phone')->nullable(true)->unique();
            $table->unsignedBigInteger('subscription_id')->nullable(true);
            $table->enum('user_type', ['teacher', 'assistant', 'student'])->default('student');
            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('subscription_end_date')->nullable();
            $table->timestamp('subscription_starting_date')->nullable();
            $table->string('password')->nullable();
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
