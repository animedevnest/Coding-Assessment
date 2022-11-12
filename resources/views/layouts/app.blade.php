<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('layouts.css')
</head>
<body>
    <div class="wrapper">        
            @include('layouts.sidebar')
            <!-- Page Content Holder -->
            <div id="content">
    
            @include('layouts.navbar')

            @yield('content')
               
            </div>
        </div>
    <footer class="footer-one-wrap">
        <div class="footer-bottom-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-5 col-sm-12 col-12">
                        <div class="copyright-text">
                            <p>© @php $year = date('Y'); echo $year @endphp Nimayate Corporate Solutions. All Rights Reserved .</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @include('layouts.js')
</body>
</html>
