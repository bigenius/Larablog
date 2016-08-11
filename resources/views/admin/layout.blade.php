<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LP Admin</title>

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">


</head>
<body id="app-layout" class="admin @yield('body-class', '')">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Larablog
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/lb-admin/post') }}">Posts</a></li>
                    <li><a href="{{ url('/lb-admin/category') }}">Categories</a></li>
                    <li><a href="{{ url('/lb-admin/tag') }}">Tags</a></li>
                    <li><a href="{{ url('/lb-admin/comment') }}">Comments<span class="badge" id="nrcomments"></span></a></li>
                    <li><a href="{{ url('/lb-admin/page') }}">Pages</a></li>
                    <li><a href="{{ url('/lb-admin/menu') }}">Menus</a></li>
                    <li><a href="{{ url('/lb-admin/user') }}">Users</a></li>
                </ul>


                @include('layouts.rightmenu')
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="{{ elixir('js/all.js') }}"></script>
    <script>
        $(document).ready( function() {

            checkComments();
            setInterval(function () {
                checkComments();
            }, 5000);

        });
        var checkComments = function() {
            $.ajax({
                url : '{{route("unapprovedComments")}}',
                type: 'GET',
                dataType : "json",
            })
                    .done(function(data){
                        if (data > 0 && $.isNumeric(data)) {
                            $('#nrcomments').html(data);
                        } else {
                            $('#nrcomments').html('');
                        }
                    })
                    .fail( function(data, status){
                        if (status !== 'abort') {
                            console.log('Error:', data);
                        }

                    })
                    .always( function(){

                    });
        }
    </script>
    @stack('scripts')
</body>
</html>
