<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');   
Auth::routes();
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('employees', App\Http\Controllers\admin\EmployeesController::class);
    Route::resource('departments', App\Http\Controllers\admin\DepartmentsController::class);
    Route::resource('attendance', App\Http\Controllers\admin\AttendanceController::class);
    Route::resource('salary', App\Http\Controllers\admin\SalaryController::class);
    Route::resource('leaves', App\Http\Controllers\admin\LeavesController::class);
    Route::resource('contracts', App\Http\Controllers\admin\ContractsController::class);
    Route::resource('rewards', App\Http\Controllers\admin\RewardsDisciplineController::class);
    Route::resource('reports', App\Http\Controllers\admin\ReportsController::class);
    Route::resource('accounts', App\Http\Controllers\admin\AccountsController::class);
});

//client 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('client.home');
Route::get('/salary/{employee_id}', [App\Http\Controllers\client\SalaryController::class, 'show'])->name('client.salary.show');   
Route::get('/leaves/{employee_id}', [App\Http\Controllers\client\LeavesController::class, 'index'])->name('client.leaves.index');

// Attendance routes for client
Route::get('/attendance/{employee_id}', [App\Http\Controllers\client\AttendanceController::class, 'index'])->name('client.attendance.index');
Route::post('/attendance/check-in', [App\Http\Controllers\client\AttendanceController::class, 'checkIn'])->name('client.attendance.checkin');
Route::post('/attendance/check-out', [App\Http\Controllers\client\AttendanceController::class, 'checkOut'])->name('client.attendance.checkout');