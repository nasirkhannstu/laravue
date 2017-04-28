<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        @include('partials._head')
    </head>
    <body>
        <div id="app">
            @include('partials._nav')
            
            <router-view></router-view>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
