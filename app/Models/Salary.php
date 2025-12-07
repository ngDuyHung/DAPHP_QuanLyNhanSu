<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //salary_id	employee_id	month	year	work_day	basic_salary	allowance	bonus	deduction	total_salary	

    protected $table = 'salary';
    protected $primaryKey = 'salary_id';
    public $timestamps = false;
    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'work_day',
        'basic_salary',
        'allowance',
        'bonus',
        'deduction',
        'total_salary',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'employee_id');
    }
}
