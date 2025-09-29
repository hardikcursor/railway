<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function dologin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'please enter email',
            'password.required' => 'please enter password',

        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect based on role
            if ($user->hasRole('super-admin')) {
                return redirect()->route('superadmin.dashboard');
            } elseif ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('user')) {
                return redirect()->route('user.dashboard');
            } else {
                Auth::logout();
                return back()->with('error', 'Unauthorized role.');
            }
        } else {
            return back()->with('error', 'Incorrect Email or password. Please try again.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showForgetPasswordForm()
    {

        return view('auth.forgot-password');

    }

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function submitForgetPasswordForm(Request $request)
    {

        $request->validate([

            'email' => 'required|email|exists:users',

        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([

            'email'      => $request->email,

            'token'      => $token,

            'created_at' => Carbon::now(),

        ]);

        Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {

            $message->to($request->email);

            $message->subject('Reset Password');

        });

        return back()->with('message', 'We have e-mailed your password reset link!');

    }

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function showResetPasswordForm($token)
    {

        return view('auth.forgetPasswordLink', ['token' => $token]);

    }

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function submitResetPasswordForm(Request $request)
    {

        $request->validate([

            'email'                 => 'required|email|exists:users',

            'password'              => 'required|string|min:6|confirmed',

            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('password_reset_tokens')

            ->where([

                'email' => $request->email,

                'token' => $request->token,

            ])

            ->first();

        if (! $updatePassword) {

            return back()->withInput()->with('error', 'Invalid token!');

        }

        $user = User::where('email', $request->email)

            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('message', 'Your password has been changed!');

    }
}
