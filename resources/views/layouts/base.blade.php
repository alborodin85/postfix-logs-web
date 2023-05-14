<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <a href="{{ route('index') }}" class="navbar-brand mr-auto">Главная</a>

        @guest
            <a href="{{ route('login') }}" class="nav-item nav-link">Вход</a>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="post" class="form-inline">
                @csrf
                <input type="submit" class="btn btn-danger" value="Выход">
            </form>
        @endauth
    </nav>
    <h1 class="my-3 text-center">Postfix logs</h1>
    <div>
        <div style="width: 200px; float: left">
            <ul>
                <li><a href="{{ route('getCurrentEmails') }}">Текущий лог email</a></li>
                <li><a href="{{ route('getCurrentLogRows') }}">Текущий общий лог</a></li>
                <li><a href="{{ route('getArchiveEmails') }}">Архивный лог email</a></li>
                <li><a href="{{ route('getArchiveLogRows') }}">Архивный общий лог</a></li>
            </ul>
        </div>
        <div style="overflow: hidden">
            @yield('main')
        </div>
    </div>
</div>
</body>
</html>
