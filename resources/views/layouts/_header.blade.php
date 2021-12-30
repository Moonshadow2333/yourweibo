    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="{{route('home')}}" class="navbar-brand">Yourweibo App</a>
            <ul class="navbar-nav justify-content-end">
                @if(Auth::check())
                <li class="nav-item">
                    <a href="#" class="nav-link">用户列表</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">个人中心</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        编辑资料
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{route('logout')}}" method="post">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger" type="submit">删除</button>
                    </form>
                </li>
                @else
                <li class="nav-item"><a class="nav-link" href="{{route('help')}}">
                    帮助
                </a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">
                        登录
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
