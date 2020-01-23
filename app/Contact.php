<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['phone', 'email', 'city', 'employee_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
