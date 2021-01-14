<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" />

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/nucleo.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/argon.css') }}" rel="stylesheet" />
        <style>
            .ct-navbar {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                background-color: #5e72e4;
                box-shadow: rgba(116, 129, 141, 0.1) 0 1px 1px 0;
            }
        </style>
        @yield('style')
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-horizontal navbar-expand navbar-dark flex-row align-items-md-center ct-navbar">
                <div class="container">
                    @guest
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    @else 
                        @if (Auth::user()->user_type == "landlord")
                        <a class="navbar-brand" href="{{ url('/') }}">
                        Dashboard
                        </a>
                        @else
                        <a class="navbar-brand" href="{{ url('property') }}">
                        Home 
                        </a>
                        @endif 
                    @endif
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto"></ul>

                        <!-- Right Side Of Navbar -->
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
                            @endif @else @if (Auth::user()->user_type == "landlord")
                            <br />
                            <li class="nav-item"><a href="{{route('listhome')}}" class="nav-link">Properties</a></li>
                            <li class="nav-item"><a href="{{route('requestpropertylist')}}" class="nav-link">Request</a></li>
                            <li class="nav-item"><a href="{{route('invoicelist')}}" class="nav-link">Invoice</a></li>
                            <li class="nav-item"><a href="{{route('servicelandlordlist')}}" class="nav-link">Report</a></li>
                            @else
                            <br />
                            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">My House</a></li>
                            <!-- <li class="nav-item"><a href="{{route('property')}}" class="nav-link">My House</a> </li> -->
                            <li class="nav-item"><a href="{{route('invoicetenantlist')}}" class="nav-link">Invoice</a></li>
                            <li class="nav-item"><a href="{{route('servicelist')}}" class="nav-link">Report</a></li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                    >
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        <!-- Core -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        {{--
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        --}}
        <!-- Argon JS -->
        {{--
        <script src="{{ asset('js/js.cookie.js') }}"></script>
        --}} {{--
        <script src="{{ asset('js/argon.js') }}"></script>
        --}} {{-- @yield('script') --}}
    </body>
</html>
