<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    //employee_id	full_name	gender	dob	email	phone	address	department_id	hire_date	position	user_id	
    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    public $timestamps = false;
    protected $fillable = [
        'full_name',
        'gender',
        'dob',
        'email',
        'phone',
        'address',
        'department_id',
        'hire_date',
        'position',
        'user_id',
    ];

    public function department()
    {
        return $this->belongsTo(Departments::class, 'department_id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }
    public function leaves()
    {
        return $this->hasMany(Leaves::class, 'employee_id');
    }

    public function rewardsDisciplines()
    {
        return $this->hasMany(Rewards_discipline::class, 'employee_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contracts::class, 'employee_id');
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class, 'employee_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
