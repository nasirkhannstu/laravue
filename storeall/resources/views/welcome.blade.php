<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        @include('partials._headd')
    </head>
    <body>
        <div id="app">
            @include('partials._navv')
            
            <router-view></router-view>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
