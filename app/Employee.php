<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = ['name', 'position_id', 'contact_id', 'head_id', 'department_id'];

    public function position() 
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function head()
    {
        return $this->belongsTo(self::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }

    // public function sub()
    // {
    //     return $this->hasMany(self::class);    
    // }
    
}
