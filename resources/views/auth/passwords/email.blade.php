@extends('layouts.default')
@section('title','忘记密码')
@section('content')
<div class="offset-md-2 col-md-8">
    <div class="card">
        <div class="card-header">
            <h1>忘记密码</h1>
        </div>
        <div class="card-body">

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <form action="{{route('password.email')}}"
             method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="email">
                    邮箱：
                    </label>
                    <input type="text" name="email" class="form-control" value="{{old('email')}}" required>
                </div>

                <button class="btn btn-primary" type="submitl">
                    重置密码
                </button>
            </form>
        </div>
    </div>
</div>
@stop
