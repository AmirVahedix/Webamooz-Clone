<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title>@yield('title')</title>
    @include('Dashboard::layouts.head')
</head>
<body>
@include('Dashboard::layouts.sidebar')

<div class="content">
    @include('Dashboard::layouts.navbar')
    @include('Dashboard::layouts.breadcrumb')

    @yield('content')
</div>
</body>
@include('Dashboard::layouts.foot')
</html>
