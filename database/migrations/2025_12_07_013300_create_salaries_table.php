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
        Schema::create('salary', function (Blueprint $table) {
            $table->integer('salary_id')->autoIncrement();
            $table->integer('employee_id')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->double('work_day')->nullable();
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowance', 10, 2)->default(0.00);
            $table->decimal('bonus', 10, 2)->default(0.00);
            $table->decimal('deduction', 10, 2)->default(0.00);
            $table->decimal('total_salary', 10, 2);

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
        Schema::dropIfExists('salary');
    }
};
