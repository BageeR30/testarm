<?php

namespace App\Http\Resources;

use App\Position;
use App\Department;
use App\Contact;
use App\Employee;
use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\PositionResource;

class EmployeeResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array =  [
            'id' => $this->id,
            'name' => $this->name,
            'contact' => $this->contact,
            'position' => Position::findOrFail($this->position_id),
            'department' => Department::find($this->department_id),
            'head' => Employee::find($this->head_id),
        ];
        // $array = array_filter($array);

        return $array;
    }
}
