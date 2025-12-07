<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rewards_discipline extends Model
{
    //record_id	employee_id	type	title	description	amount	date_recorded
    protected $table = 'rewards_discipline';
    protected $primaryKey = 'record_id';
    public $timestamps = false;
    protected $fillable = [
        'employee_id',
        'type',
        'title',
        'description',
        'amount',
        'date_recorded',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'employee_id');
    }
}
