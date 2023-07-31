<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
       $input = $request->all();

       User::create([
        'first_name' => $input['first_name'],
        'last_name' => $input['last_name'],
        'address' => $input['address'],
        'email' => $input['email'],
        'password' => Hash::make($input['password'])
      ]);

      return response()->json(['status' => true, 'message' => "Registration Success"]);
    }

    public function resetPassword(Request $request)
    {
      $request->validate([
        'email' => 'required|email',
        'newPassword' => 'required|min:1',
        'confirmPassword' => 'required|same:newPassword',
      ]);

      $user = User::where('email', $request->email)->first();

      if ($user) {
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
          'status' => true,
          'message' => 'Password reset successful'
        ]);
      } else {
        return response()->json([
          'status' => false,
          'message' => 'No user found with that email address'
        ]);
      }
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }
    
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->address = $input['address'];
        $user->email = $input['email'];
        $user->save();
    
        return response()->json([
            'status' => true,
            'message' => 'Account details updated'
        ]);
    }
    public function updatePassword(Request $request, $id)
{
    $input = $request->all();
    
    $user = User::find($id);
    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'User not found'
        ]);
    }
    
    $user->password = Hash::make($input['password']);
    $user->save();
    
    return response()->json([
        'status' => true,
        'message' => 'Password updated successfully'
    ]);
}
}
