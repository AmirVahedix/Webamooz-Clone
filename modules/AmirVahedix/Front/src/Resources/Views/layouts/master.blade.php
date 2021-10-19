<!doctype html>
<html lang="fa">
<head>
    <title>@yield('title')</title>
    @include("Front::layouts.head")
</head>
<body>
@include("Front::layouts.header.header")
@yield('content')
@include("Front::layouts.footer.footer")

@include("Front::layouts.foot")
</body>
</html>
