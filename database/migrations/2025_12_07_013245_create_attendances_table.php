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
        Schema::create('attendance', function (Blueprint $table) {
            $table->integer('attendance_id')->autoIncrement();
            $table->integer('employee_id')->nullable();
            $table->date('date')->nullable();
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();

            $table->foreign('employee_id')
                  ->references('employee_id')
                  ->on('employees')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
