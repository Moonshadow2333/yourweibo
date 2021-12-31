@extends('layouts.default')
@section('title','登录')
@section('content')
<div class="offset-md-2 col-md-8">
    <div class="card">
        <div class="card-header">
            登录
        </div>
        <div class="card-body">
            @include('shared._errors')
            <form action="{{route('login')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="email">
                        email：
                    </label>
                    <input type="text" name="email" class="form-control" value="{{old('email')}}">
                </div>

                <div class="form-group">
                    <label for="password">
                        密码：
                        （<a href="{{route('password.reset')}}">
                            忘记密码：
                        </a>）
                    </label>
                    <input type="password" name="password" class="form-control" value="{{old('password')}}">
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                        <label class="form-check-label"
                        for="rememberMe">
                            记住我
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">登录</button>
                </div>
            </form>

            <hr>
            <p>
                还没账号？<a href="{{route('signup')}}">
                    现在注册!
                </a>
            </p>
        </div>
    </div>
</div>
@stop
