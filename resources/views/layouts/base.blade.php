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
        <a href="{{ route('register') }}" class="nav-item nav-link">Регистрация</a>
        <a href="{{ route('login') }}" class="nav-item nav-link">Вход</a>
        @endguest
        @auth
        <a href="{{ route('home') }}" class="nav-item nav-link">Мои объявления</a>
        <form action="{{ route('logout') }}" method="post" class="form-inline">
            @csrf
            <input type="submit" class="btn btn-danger" value="Выход">
        </form>
        @endauth
    </nav>
    <h1 class="my-3 text-center">Postfix logs</h1>
    @yield('main')
</div>
</body>
</html>
