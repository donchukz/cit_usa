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
        Schema::create('pay_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->string('date');
            $table->string('pay_period');
            $table->string('total_miles');
            $table->string('total_amount');
            $table->string('no_patients');
            $table->string('no_visits');
            $table->string('invoice');
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('pay_reports');
    }
};