<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
    </head>
 
    <body>
        <!--[if lte IE 8]>
            <p class="browser-notice">
                You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
            </p>
        <![endif]-->
        
        <div class="container">
            @yield('content')
        </div>
    </body>
    <footer></footer>
</html>