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
        Schema::create('rewards_discipline', function (Blueprint $table) {
            $table->integer('record_id')->autoIncrement();
            $table->integer('employee_id')->nullable();
            $table->enum('type', ['reward', 'discipline'])->nullable();
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('date_recorded')->nullable();

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
        Schema::dropIfExists('rewards_discipline');
    }
};
