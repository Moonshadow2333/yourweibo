<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;
class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
            'except' => ['store','create','show ','index','confirmEmail']
        ]);
        $this->middleware('throttle:10,60',[
            'only' => ['store']
        ]);
                $this->middleware('guest',[
            'only' => ['create']
        ]);
    }
    public function create(){
        return view('users.create');
    }
    public function show(User $user){
        $statuses = $user->statuses()->orderBy('created_at','desc')->paginate(10);
        return view('users.show',compact('user','statuses'));
    }
    public function store(Request $request, User $user){
        $this->validate($request,[
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $this->sendEmailConfirmationTo($user);
        session()->flash('success','欢迎，您将在这里开启一段新的旅程！');
        return redirect()->route('home');
    }
    public function edit(User $user){
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }
    public function update(Request $request, User $user){
        $this->authorize('update',$user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'required|confirmed|min:6'
        ]);
        $user->update([
            'name' => $request->name,
            'password' => bcrypt($request->password)
        ]);
        session()->flash('success','更新资料成功');
        return redirect()->route('users.show',$user->id);
    }
    public function index(){
        $users = User::paginate(6);
        return view('users.index',compact('users'));
    }
    public function destroy(User $user){
        $this->authorize('destroy',$user);
        $user->delete();
        session()->flash('success','删除用户成功');
        return back();
    }
    public function sendEmailConfirmationTo($user){
        $view = 'emails.confirm';
        $data = compact('user');
        $to = $user->email;
        $subject = '感谢注册 Weibo 应用！请确认您的邮件。';
        Mail::send($view,$data,function($message) use ($to, $subject){
            $message->to($to)->subject($subject);
        });
    }
    public function confirmEmail($token){
        $user = User::where('activation_token',$token)->firstOrFail();
        $user->activated = true;
        $user->activation_token = null;
        $user->save();
        Auth::login($user);
        session()->flash('success','恭喜你，激活成功');
        return redirect()->route('users.show',[$user]);
    }
    public function followings(User $user){
        $users = $user->followings()->paginate(30);
        $title = $user->name.'关注的人';
        return view('users.show_follow',compact('users','title'));

    }
    public function followers(User $user){
        $users = $user->followers()->paginate(30);
        $title = $user->name.'的粉丝';
        return view('users.show_follow',compact('users','title'));
    }
}
