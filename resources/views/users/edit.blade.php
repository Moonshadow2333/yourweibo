@extends('layouts.default')
@section('title','更新资料')
@section('content')
<div class="offset-md-2 col-md-8">
    <div class="card">
        <div class="card-header">
            更新资料
        </div>
        <div class="card-body">
            <div class="gravatar_edit">
                <a href="https://cdn.sep.cc/avatar">
                    <img src="{{$user->gravatar()}}">
                </a>
            </div>
            @include('shared._errors')
            <form action="{{route('users.update',$user->id )}}" method="post">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="name">
                        名称：
                    </label>
                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="email">
                        邮箱：
                    </label>
                    <input type="email" name="email" class="form-control" value="{{$user->email}}" disabled>
                </div>

                <div class="form-group">
                    <label for="password">
                        密码：
                    </label>
                    <input type="password" name="password" class="form-control" value="{{old('password')}}">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        确认密码：
                    </label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}">
                </div>

                <div class="form-group">
                    <button type="submit"
                    class="btn btn-primary">更新</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
