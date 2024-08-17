<!DOCTYPE html>
<html lang="zh_TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel App - @yield('title')</title>
@yield('styles')

</head>
<body>
    <h1>@yield('title')</h1>
<div>
    @if(session()->has('sucess'))
    <div>{{session('sucess')}}</div>
    @endif
    @yield('content')
</div>
</body>
</html>