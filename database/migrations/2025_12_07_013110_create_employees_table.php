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
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('employee_id')->autoIncrement();
            $table->string('full_name', 100);
            $table->text('img_link')->nullable();
            $table->enum('gender', ['M', 'F']);
            $table->date('dob');
            $table->string('email', 100)->unique();
            $table->string('phone', 20);
            $table->text('address')->nullable();
            $table->integer('department_id')->nullable();
            $table->date('hire_date');
            $table->string('position', 100);
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('department_id')
                  ->references('department_id')
                  ->on('departments')
                  ->onDelete('set null');
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });

        // Add foreign key for departments.manager_id after employees table is created
        Schema::table('departments', function (Blueprint $table) {
            $table->foreign('manager_id')
                  ->references('employee_id')
                  ->on('employees')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign(['manager_id']);
        });
        Schema::dropIfExists('employees');
    }
};
