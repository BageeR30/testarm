<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = ['name', 'position_id', 'contact_id', 'head_id', 'department_id'];

    public function position() 
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function head()
    {
        return $this->belongsTo(self::class, 'head_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // public function sub()
    // {
    //     return $this->hasMany(self::class);    
    // }
    
}
