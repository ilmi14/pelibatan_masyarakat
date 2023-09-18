<?php

namespace App\Http\Controllers\admin_dashboard\auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function lupaPassword(){
        return view("auth.lupa_password");
    }

    public function resetPassword($token){
        return view("auth.reset_password", ['token' => $token]);
    }

    // public function postLupaPassword(Request $request){
    //     $request->validate(['email' => 'required|email']);
 
    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );
    
    //     return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
    // }

    // public function postResetPassword(Request $request){
    //     $request->validate([
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|min:8|confirmed',
    //         'password_confirmation' => 'required|same:password',
    //     ]);
        
    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->forceFill([
    //                 'password' => Hash::make($password)
    //             ])->setRememberToken(Str::random(60));
     
    //             $user->save();
     
    //             event(new PasswordReset($user));
    //         }
    //     );
     
    //     return $status === Password::PASSWORD_RESET ? redirect()->route('login')->with('status', __($status)) : back()->withErrors(['email' => [__($status)]]);
    // }

    public function postLupaPassword(Request $request){
        $messages = [
            'email.exists' => 'Email Tidak Ditemukan',
        ];

        $request->validate([
            'email' => 'required|email|exists:users',
        ], $messages);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Mail::send('auth.lupa-password-email', ['token' => $token], function($message) use($request){
        //     $message->to($request->email);
        //     $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
        //     $message->subject('Reset Password Notification');
        // });
        
        $details = [
            'url' => url('reset-password/'.$token.'')
        ];
        Mail::to($request->email)->send(new ResetPasswordMail($details));

        return back()->with('status', 'Kami telah mengirim email reset password, jika email tidak ditemukan cek folder spam!');
    }

    public function postResetPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
            'token' => 'required',
        ]);

        $update = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();

        if(!$update){
            return back()->withInput()->withErrors(['email' => 'Invalid Token! Silahkan lakukan permintaan reset password baru']);
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        // Delete password_resets record
        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('success', 'Password Berhasil dirubah!');
    }
}
