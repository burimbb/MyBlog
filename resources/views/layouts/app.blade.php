<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  @include('partials._header')
  <body>
    @include('partials._nav')
    <div class="container mt-2">
      @include('partials._messages')
      @yield('content')
    </div>
    @include('partials._footer')
    @include('partials._scripts')
  </body>
</html>