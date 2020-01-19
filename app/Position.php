<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{

    protected $fillable = ['name', 'priority'];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'position_id', 'id');
    }
}
