<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                'status' => true,
                'user' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'address' => $user->address,
                    'email' => $user->email   // Add this line
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }
    }
    
}
