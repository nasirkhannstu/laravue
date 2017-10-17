<!DOCTYPE html>
<html>
<head>
  @include ('partials._head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" id="app">
  <init></init>
  <header class="main-header">
    @include ('partials._navigation')
  </header>
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-9">
          @yield('content')
        </div>
        <div class="col-md-3">
          @include ('partials._rightsidebar')
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    @include ('partials._footer')
  </footer>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
<script src="/css/noty.js" type="text/javascript"></script>
</body>
</html>
