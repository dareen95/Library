<!DOCTYPE html>
<!--<html lang="ar">-->
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_index.css') }}">

    @yield('styles')

</head>

<body>
    <x-navbar></x-navbar>

    <div class="container my-5 py-5">
        @yield('content')
    </div>


    {{--  <footer class="py-3 bg-primary @if(Route::currentRouteName() == 'auth.register' OR Route::currentRouteName() == 'auth.login' OR Route::currentRouteName() == 'message' OR Route::currentRouteName() == 'categories.show' OR Route::currentRouteName() == 'showAuthor')
        fixed-bottom
        @endif">
        <div class="container">
          <p class="footer-text m-0 text-center text-white">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This library is made by <a class="text-white" href="https:linkedin.com/in/abdallah-mohsen/" target="_blank">Abdallah Mohsen</a></p>
        </div>
    </footer>  --}}

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('script')

</body>
</html>
