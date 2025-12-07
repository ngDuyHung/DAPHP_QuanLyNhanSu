<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{
    //leave_id	employee_id	leave_type	start_date	end_date	status	
    protected $table = 'leaves';
    protected $primaryKey = 'leave_id';
    public $timestamps = false;
    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'employee_id');
    }
}
