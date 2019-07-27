<nav class="navbar navbar-expand-md navbar-light navbar-laravel mat-box-shadow bg-light">

    <div class="container-fluid">

        <a class="navbar-brand" href="{{ url('/') }}">

            <img height="40px" src="{{ asset('/images/logo.png') }}" />

        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"

            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">

            <span class="navbar-toggler-icon"></span>

        </button>



        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">

                    <a class="nav-link" href="{{ url('/') }}">Home</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ url('/about-us') }}">About Us</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ url('/quickbooks-software') }}">QuickBooks Software</a>

                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Services</a>

                    <div class="dropdown-menu">

                        <div class="container-fluid">

                            <div class="row">

                                <div class="col-md-6">

                                    <a class="dropdown-item" href="{{ url('/quickbooks-services') }}">QuickBooks

                                        Services</a>

                                    <a class="dropdown-item" href="{{ url('/quickbooks-support') }}">QuickBooks

                                        Support</a>

                                    <a class="dropdown-item" href="{{ url('/quickbooks-payroll-support') }}">QuickBooks

                                        Payroll Support</a>

                                    <a class="dropdown-item"

                                        href="{{ url('/quickbooks-proadvisor-support') }}">QuickBooks ProAdvisor

                                        Support</a>

                                    <a class="dropdown-item"

                                        href="{{ url('/quickbooks-enterprise-support') }}">QuickBooks Enterprise

                                        Support</a>

                                    <a class="dropdown-item" href="{{ url('/quickbooks-desktop-support') }}">QuickBooks

                                        Desktop Support</a>

                                </div>

                                <div class="col-md-6">

                                    <a class="dropdown-item" href="{{ url('/quickbooks-premier-support') }}">QuickBooks

                                        Premier Support</a>

                                    <a class="dropdown-item" href="{{ url('/quickbooks-pro-support') }}">QuickBooks Pro

                                        Support</a>

                                    <a class="dropdown-item" href="{{ url('/quickbooks-pos-support') }}">QuickBooks POS

                                        Support</a>

                                    <a class="dropdown-item"

                                        href="{{ url('/quickbooks-cloud-hosting-support') }}">QuickBooks Cloud

                                        Hosting</a>

                                    <a class="dropdown-item" href="{{ url('/quickbooks-window-support') }}">QuickBooks

                                        Window Support</a>

                                    <a class="dropdown-item" href="{{ url('/quickbooks-error-support') }}">QuickBooks

                                        Error Support</a>

                                </div>

                            </div>

                        </div>

                    </div>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ url('/blog') }}">Blog</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ url('/contact-us') }}">Contact Us</a>

                </li>

            </ul>



            <!-- Right Side Of Navbar -->

            {{--

            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->

                @guest

                <li class="nav-item">

                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

            </li>

            @if (Route::has('register'))

            <li class="nav-item">

                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

            </li>

            @endif @else

            <li class="nav-item dropdown">

                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"

                    aria-haspopup="true" aria-expanded="false" v-pre>

                    {{ Auth::user()->name }} <span class="caret"></span>

                </a>



                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();

                                                document.getElementById('logout-form').submit();">

                        {{ __('Logout') }}

                    </a>



                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                        @csrf

                    </form>

                </div>

            </li>

            @endguest

            </ul> --}}

        </div>

    </div>

</nav>