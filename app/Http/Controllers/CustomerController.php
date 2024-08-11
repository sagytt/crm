<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::orderBy('id','DESC')->paginate(10);
        return inertia('Customer/Manage',
                [
                    'customers' => $customers,
                ]);
    }

    public function create(){
        return inertia('Customer/Add');
    }

    public function edit($id){

        $customers = Customer::findOrFail($id);
        return inertia('Customer/Edit',
        [
            'customers' => $customers,
        ]);

    }

    public function store(Request $request){

        $rules = [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]*$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone_number' => ['required', 'string', 'max:15', 'regex:/^\+?[0-9]{10,15}$/'],
            'address' => ['required', 'string'],
        ];
        $messages = [
            'name.required' => 'The name field is required.',
            'name.regex' => 'The name can only contain letters and spaces.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'This email address is already registered.',
            'phone_number.required' => 'The phone number field is required.',
            'phone_number.regex' => 'The phone number must be between 10 to 15 digits and can include a leading +.',
            'address.required' => 'The address field is required.',
        ];
        
        $request->validate($rules, $messages);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);
         
        return redirect()->route('managecustomer')
            ->with('success', 'Customer created successfully!');
    }

    public function update(Request $request,$id){

    // Find the customer by ID and update the data
    $customer = Customer::findOrFail($id);

    $customer->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
    ]);

    // Optionally, you can return a response or redirect
    return redirect()->route('managecustomer')
            ->with('success', 'Customer updated successfully!');
    }

    public function delete($id){
        // Find the customer by ID
        $customer = Customer::findOrFail($id);
        // Delete the customer
        $customer->delete();

        return redirect()->route('managecustomer')
            ->with('success', 'Customer deleted successfully!');
    }
}
