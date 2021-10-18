<!doctype html>
<html lang="fa">
<head>
    <title>@yield('title')</title>
    @include("Front::layouts.head")
</head>
<body>
@include("Front::layouts.header.header")
<article class="container article">
    @yield('content')
</article>
@include("Front::layouts.footer.footer")

@include("Front::layouts.foot")
</body>
</html>
