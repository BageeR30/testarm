<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function position() 
    {
        return $this->hasOne(Position::class);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function head()
    {
        return $this->hasOne(Employee::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }

    
}
