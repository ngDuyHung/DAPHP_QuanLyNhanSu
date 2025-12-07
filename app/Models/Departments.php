<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    //department_id	name	manager_id	
    protected $table = 'departments';
    protected $primaryKey = 'department_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'manager_id',
    ];

    public function manager()
    {
        return $this->belongsTo(Employees::class, 'manager_id', 'employee_id');
    }

    public function employees()
    {
        return $this->hasMany(Employees::class, 'department_id', 'department_id');
    }
}
