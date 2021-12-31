<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Hash;
use Carbon\Carbon;
use Mail;
use DB;
class PasswordController extends Controller
{
    public function showLinkRequestForm(){
        return view('auth.passwords.email');
    }
    public function sendResetLinkEmail(Request $request){
        $this->validate($request,[
            'email' => 'required|email|max:255'
        ]);
        $email = $request->email;
        // 验证用户是否存在
        $user = User::where('email',$email)->first();
        // 如果用户不住在
        if(is_null($user)){
            session()->flash('danger','邮箱未注册');
            return redirect()->back()->withInput();
        }
        // 生成token。
        $token = hash_hmac('sha256', Str::random(40), config('app.key'));
        // 将邮箱和token存入数据库中
        DB::table('password_resets')->updateOrInsert([
            'email' => $email,
            'token' => Hash::make($token),
            'created_at' => new Carbon
        ]);
        // 将token链接发送给用户。
        Mail::send('emails.reset_link',compact('token'),function($message) use ($email){
            $message->to($email)->subject('忘记密码');
        });
        session()->flash('success','重置邮件发送成功，请查收');
        return redirect()->back();
    }
}
