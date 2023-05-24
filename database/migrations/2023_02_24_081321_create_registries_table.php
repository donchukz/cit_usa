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
        Schema::create('registries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('emp_id');
            $table->foreign('user_id')->constraint()
                  ->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('emp_id')->constraint()
                  ->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->string('typeofemployment')->nullable();
            $table->string('registrytype')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('registries');
    }
};