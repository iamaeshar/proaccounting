<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta-info')
    <title>
        Pro Accounting Support {{-- {{ config('app.name', 'Laravel') }} --}}
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito"> {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminstyle.css') }}" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('admin.inc.navbar')
        <main class="w-100 overflow-auto">
            <section>
                <div class="card card-container">
                    <div class="card-header d-flex align-items-center">
                        <div id="nav-toggle-btn" class="text-dark mr-2 mb-2"><i
                                class="fas fa-bars"></i></div>
                        @yield('page-title')
                    </div>
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </section>
        </main>
    </div>
    <div class="loader-container d-none">
        <div class="overlay"></div>
        <div class="loader">
            <div class="spinner-border text-success" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function(){

            if($(window).width() < 576) {
                $('#side-nav').css('max-width', '60px');
                $('#side-nav').css('min-width', '0px');
            }

            $('#nav-toggle-btn').click(function() {
                if($('#side-nav').hasClass('open')) {
                    
                    $('#side-nav').css('max-width', '60px');
                    $('#side-nav').css('min-width', '0px');
                    $('#side-nav').removeClass('open');

                }else {
                    
                    $('#side-nav').css('min-width', '200px');
                    $('#side-nav').addClass('open');
                }
            });
        })
    </script>

</body>

</html>