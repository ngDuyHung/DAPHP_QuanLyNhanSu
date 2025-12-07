<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    //contract_id	employee_id	contract_type	start_date	end_date	basic_salary	note	
    protected $table = 'contracts';
    protected $primaryKey = 'contract_id';
    public $timestamps = false;
    protected $fillable = [
        'employee_id',
        'contract_type',
        'start_date',
        'end_date',
        'basic_salary',
        'note',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'employee_id');
    }
}
