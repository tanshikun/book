<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="css/weui.css"/>
    <link rel="stylesheet" href="example.css"/>
</head>
<body>
    @section('sidebar')
    @yield('content')
    <div id="popout">@yield('popout')</div>
    <div id="mask">@yield('mask')</div>
    <div id="navigation">@yield('navigation')</div>
    <div id="content">@yield('content')</div>
</body>
</html>
