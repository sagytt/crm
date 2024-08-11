<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $user_data = User::all();
       
        return inertia('User/Manage',
        [
            'users' => $user_data,
        ]);
    }

    public function create(){
      
        return inertia('User/Add');
    }

    public function show($id){
        $user_data = User::findOrFail($id);
      
        return inertia('User/Edit',
        [
            'user' => $user_data,
        ]);
    }

    public function store(Request $request){
        echo $request->name;
        exit;
    }
}
