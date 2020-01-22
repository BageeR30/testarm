<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use App\Contact;
use App\Position;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Resources\Json\Resource;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|integer',
            'name' => 'required',
            'position_id' => 'required|integer',
            'department_id' => 'integer|nullable',
            'head_id' => 'integer|nullable',
        ]);
        
        $employee = Employee::create([
            'name' => $request->name,
            'position_id' => $request->position_id,
            'department_id' => $request->department_id,
            'head_id' => $request->head_id,
        ]);

        $contact = new Contact([
            'employee_id' => $employee->id,
            'phone' => $request->phone,
            'city' => $request->city,
            'email' => $request->email,
        ]);
   
        $contact->save();
        return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->except(['id', 'contact_id']));
        $employee->contact()->update($request->except('id'));
        
        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(null, 204);
    }
}
