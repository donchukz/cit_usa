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
        Schema::create('daily_pays', function (Blueprint $table) {
            $table->id();
            $table->string('visit_date');
            $table->string('time');
            $table->foreignId('emp_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_rate_id')->references('id')->on('user_rates')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('miles')->nullable();
            $table->decimal('amount')->nullable();
            $table->longText('signature')->nullable();
            $table->boolean('sign')->default(0);
            $table->foreignId('pay_period_id')->references('id')->on('pay_periods')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('pay_report_id')->nullable();
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
        Schema::dropIfExists('daily_pays');
    }
};
