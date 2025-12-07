<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //attendance_id	employee_id	date	check_in	check_out	
    protected $table = 'attendance';
    protected $primaryKey = 'attendance_id';
    public $timestamps = false;
    protected $fillable = [
        'employee_id',
        'date',
        'check_in',
        'check_out',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'employee_id');
    }
}
