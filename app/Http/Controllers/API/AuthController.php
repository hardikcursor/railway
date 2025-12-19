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
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email'           => 'required|email',
            'password'        => 'required',
            'current_address' => 'nullable|string',
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

        $address = $request->current_address ?? $user->current_address ?? null;

        $user->update([
            'current_address' => $address,
            'login_date_time' => now(),
        ]);

        $user = $user->fresh();

        return response()->json([
            'status'  => true,
            'message' => 'Login successful',
            'user'    => [
                'id'              => $user->id,
                'name'            => $user->name,
                'email'           => $user->email,
                'current_address' => $user->current_address,
                'login_date_time' => $user->login_date_time ? $user->login_date_time->toDateTimeString() : null,
            ],
        ], 200);
    }

    // public function signup(Request $request)
    // {
    //     // VALIDATION
    //     $validator = Validator::make($request->all(), [
    //         'name'          => 'required|string|max:255',
    //         'email'         => 'required|email|unique:users,email',
    //         'phone'         => 'required|string|max:15',
    //         'designation'   => 'required|string|max:255',
    //         'incharge_name' => 'required|string|max:255',
    //         'password'      => 'required|min:6',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Validation Error',
    //             'errors'  => $validator->errors(),
    //         ], 422);
    //     }

    //     $filename = null;

    //     if ($request->hasFile('image')) {
    //         $image     = $request->file('image');
    //         $extension = $image->getClientOriginalExtension();

    //         $filename = time() . '.' . $extension;

    //         $image->move(public_path('uploads/profiles'), $filename);
    //     }
    //     $user = User::create([
    //         'name'          => $request->name,
    //         'email'         => $request->email,
    //         'phone'         => $request->phone,
    //         'designation'   => $request->designation,
    //         'incharge_name' => $request->incharge_name,
    //         'password'      => Hash::make($request->password),
    //         'image'         => $filename,
    //     ]);

    //     $user->assignRole('user');

    //     return response()->json([
    //         'status'  => true,
    //         'message' => 'User Registered Successfully!',
    //         'data'    => [
    //             'name'          => $user->name,
    //             'email'         => $user->email,
    //             'phone'         => $user->phone,
    //             'designation'   => $user->designation,
    //             'incharge_name' => $user->incharge_name,
    //             'role'          => 'user',
    //             'image'         => $filename
    //                 ? asset('uploads/profiles/' . $filename)
    //                 : null,
    //         ],
    //     ], 201);
    // }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|string|max:15',
            'designation'   => 'required|string|max:255',
            'incharge_name' => 'required|string|max:255',
            'password'      => 'required|min:6',
            'image'         => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $filename = null;

        if (! empty($request->image)) {
            $base64Image = $request->image;

            if (strpos($base64Image, 'base64,') !== false) {
                $base64Image = explode('base64,', $base64Image)[1];
            }

            $base64Image = str_replace(' ', '+', $base64Image);
            $imageData   = base64_decode($base64Image);

            if ($imageData !== false) {
                $folderPath = public_path('uploads/profiles');

                if (! file_exists($folderPath)) {
                    mkdir($folderPath, 0775, true);
                }

                $extension = 'jpg';
                if (preg_match('/^data:image\/(\w+);base64,/', $request->image, $matches)) {
                    $extension = strtolower($matches[1]);
                }

                $filename = 'profile_' . time() . '_' . uniqid() . '.' . $extension;
                file_put_contents($folderPath . '/' . $filename, $imageData);
            }
        }

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'designation'   => $request->designation,
            'incharge_name' => $request->incharge_name,
            'password'      => Hash::make($request->password),
            'image'         => $filename,
        ]);

        $user->assignRole('user');

        return response()->json([
            'status'  => true,
            'message' => 'User Registered Successfully!',
            'data'    => [
                'name'          => $user->name,
                'email'         => $user->email,
                'phone'         => $user->phone,
                'designation'   => $user->designation,
                'incharge_name' => $user->incharge_name,
                'role'          => 'user',
                'image'         => $filename ? asset('uploads/profiles/' . $filename) : null,
            ],
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        $user->last_logout_at = now();
        $user->save();

        return response()->json([
            'status'  => true,
            'message' => 'User LogOut Successfully',
            'user'    => [
                'id'             => $user->id,
                'name'           => $user->name,
                'email'          => $user->email,
                'last_logout_at' => $user->last_logout_at->toDateTimeString(),
            ],
        ]);
    }

    public function getuserprofile(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'User Profile',
            'data'    => [
                'name'          => $user->name,
                'email'         => $user->email,
                'phone'         => $user->phone,
                'designation'   => $user->designation,
                'incharge_name' => $user->incharge_name,
                'image'         => $user->image
                    ? asset('uploads/profiles/' . $user->image)
                    : null,
                'status'        => $user->status == 1 ? 'active' : 'inactive',
            ],
        ]);
    }

}
