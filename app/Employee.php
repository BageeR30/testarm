<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = ['name', 'position_id', 'contact_id', 'head_id', 'department_id'];

    public function position() 
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function head()
    {
        return $this->hasMany(self::class, 'head_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function childrenHeads()
{
    return $this->hasMany(self::class, 'head_id', 'id')->with('head', 'position', 'childrenHeads');
}
    
}
