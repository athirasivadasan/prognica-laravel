<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Prognica') }}</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(".postbutton").click(function(){
                $.ajax({
                    url: 'http://api.prognica.com/processUSGSample/1/5/R/bb',
                    type: 'GET',
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (data) { 
                        $(".result").css("display", "block");
                        $.each(data.result_data, function(key, result) {

                            console.log(result.img_location);
                            $(".img_location").append(' <img src="'+result.img_location+'" alt="Girl in a jacket" width="300" height="300"> ');
                            $(".img_original").append(' <img src="'+result.img_original+'" alt="Girl in a jacket" width="300" height="300"> ');
                            $(".img_result").append(' <img src="'+result.img_result+'" alt="Girl in a jacket" width="300" height="300"> ');
                            $(".float-right").html('<a href="'+result.report+'" download>Download Report</a>');
                            $(".writeinfo").append('<ul class="list-group list-group-flush">');
                            $(".writeinfo").append('<li class="list-group-item">Tumor Size:'+ result.size_major_axis +'*'+ result.size_minor_axis+'*' + result.size_depth+ '</li>');
                            $(".writeinfo").append('<li class="list-group-item">Tumor Shape: '+result.tumor_shape+'</li>');
                            $(".writeinfo").append('<li class="list-group-item">Tumor Orientation: '+result.tumor_orientation+'</li>');
                            $(".writeinfo").append('<li class="list-group-item">Echo Pattern:'+result.tumor_echo_pattern+'</li>');
                            $(".writeinfo").append('<li class="list-group-item">Tumor Margin:'+result.tumor_margin+'</li>');
                            $(".writeinfo").append('<li class="list-group-item">Side:'+result.breast_side+'</li>');                            
                            $(".writeinfo").append('</ul>');
                        });

                        
                        
                    }
                }); 
            });
       });    
    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Prognica') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 
                    <ul class="navbar-nav mr-auto">

                    </ul>

                
                    <ul class="navbar-nav ml-auto">
                       
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        <li class="nav-item">
                                <a class="nav-link">{{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}">{{ __('Logout') }} </a>
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
</body>
</html>