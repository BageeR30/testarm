<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
