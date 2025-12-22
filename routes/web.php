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
Route::put('/contracts/{contract}/renew', [App\Http\Controllers\admin\ContractsController::class, 'renew'])
    ->name('contracts.renew');

Route::post('/salary/calculate', [App\Http\Controllers\admin\SalaryController::class, 'calculate'])->name('salary.calculate');
//client 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('client.home');
Route::get('/client/salary/{employee_id}', [App\Http\Controllers\client\SalaryController::class, 'show'])->name('client.salary.show');   
Route::get('/client/leaves/{employee_id}', [App\Http\Controllers\client\LeavesController::class, 'index'])->name('client.leaves.index');
Route::post('/client/leaves', [App\Http\Controllers\client\LeavesController::class, 'store'])->name('client.leaves.store');
// Attendance routes for client
Route::get('/client/attendance/{employee_id}', [App\Http\Controllers\client\AttendanceController::class, 'index'])->name('client.attendance.index');
Route::post('/client/attendance/check-in', [App\Http\Controllers\client\AttendanceController::class, 'checkIn'])->name('client.attendance.checkin');
Route::post('/client/attendance/check-out', [App\Http\Controllers\client\AttendanceController::class, 'checkOut'])->name('client.attendance.checkout');