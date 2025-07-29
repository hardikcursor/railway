<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required',
        ]);
        if ($validator->passes()) {
            $user                = new User;
            $user->name          = $request->name;
            $user->email         = $request->email;
            $user->phone         = $request->phone;
            $user->designation   = $request->designation;
            $user->incharge_name = $request->incharge_name;
            $user->password      = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status'  => true,
                'User'    => $user,
                'message' => 'User Create SuccessFully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => false,
                'error'   => $validation->errors(),
                'message' => 'Validation error',
            ], 422);
        }

        $user = User::where('email', $request->email)->where('status', 1)->first();

        if (! $user) {
            return response()->json([
                'status'  => false,
                'message' => 'User not active',
            ], 401);
        }

    
        if (! Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid email or password',
            ], 401);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Login successful',
            'user'    => $user,
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'status'  => true,
            'message' => 'User LogOut SuccessFully',
            'errors'  => $user,
        ]);
    }

    public function getuser()
    {
        $data['users'] = User::all();

        return response()->json([
            'sucess'  => true,
            'errors'  => $data,
            'message' => 'All User Data',
        ]);
    }
}

