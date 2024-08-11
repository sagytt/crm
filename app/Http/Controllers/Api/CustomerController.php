<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return response()->json(['customers' => $customers]);
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]*$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone_number' => ['required', 'string', 'max:15', 'regex:/^\+?[0-9]{10,15}$/'],
            'address' => ['required', 'string'],
        ]);

        if($validatedData->fails()){
            return response()->json(['message' => 'All fields are required', 'error' => $validatedData->messages()], 422);
        }
        
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);
        
        return response()->json(['message' => 'Customer created successfully', 'customer' => $customer], 201);
    }

    public function update(Request $request){

        $validatedData = Validator::make($request->all(),[
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]*$/'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15', 'regex:/^\+?[0-9]{10,15}$/'],
            'address' => ['required', 'string'],
        ]);

        if($validatedData->fails()){
            return response()->json(['message' => 'All fields are required', 'error' => $validatedData->messages()], 422);
        }
       
        $customer = Customer::whereid($request->id)->get()->toArray();

       

        if(!$customer){
            return response()->json(['message' => 'Customer not found'], 200);
        }

        $data = Customer::whereid($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);
        
        return response()->json(['message' => 'Customer updated successfully'], 201);
    }

    public function delete(Request $request ){
        $validatedData = Validator::make($request->all(),[
            'id' => ['required', 'integer'],
        ]);

        if($validatedData->fails()){
            return response()->json(['message' => 'All fields are required', 'error' => $validatedData->messages()], 422);
        }

        $customer = Customer::findOrFail($request->id);
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully'], 201);

    }
}
