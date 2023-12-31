<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;

use App\Events;
use App\Models\Employee;
use App\Models\Factory;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::with('factory')
                            ->orderBy('created_at', 'DESC')
                            ->paginate(10);
        
        $factories = Factory::get();

        return view('pages.employees', [
            'employees' => $employees,
            'factories' => $factories
        ]);
    }

    public function store(EmployeeRequest $request) {
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $factoryId = $request->get('factory');
        $email = $request->get('email');
        $phone = $request->get('phone');

        $employee = Employee::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'factory_id' => $factoryId,
            'email' => $email,
            'phone' => $phone
        ]);

        event(new Events\CreatingEmployee($employee));
        return Redirect::route('employee.index')->with('status', 'New employee saved!');
    }

    public function update(EmployeeRequest $request, $id) {
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $factoryId = $request->get('factory');
        $email = $request->get('email');
        $phone = $request->get('phone');

        $employee = Employee::where('id', $id)->first();
        $oldEmployee = clone $employee;
        $employee->update([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'factory_id' => $factoryId,
                    'email' => $email,
                    'phone' => $phone
                ]);

        event(new Events\UpdatingEmployee($employee, $oldEmployee));
        return Redirect::route('employee.index')->with('status', 'Employee '.$firstname.' updated!');
    }

    public function destroy($id) {
        $employee = Employee::where('id', $id)->first();

        if (!$employee) {
            return Redirect::route('employee.index')->with('error', "Selected employee doesn't exist.");
        }
        
        $employeeName = $employee->firstname;
        $employee->delete();

        event(new Events\DeletingEmployee($employee));
        return Redirect::route('employee.index')->with('status', $employeeName . ' employee deleted!');
    }
}
