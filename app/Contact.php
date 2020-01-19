<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['phone', 'email', 'city'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
