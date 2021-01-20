<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{mix('css/app.css')}}">

        <style>
            .active-menu {
                font-weight: bold;
                text-decoration: underline;
            }
            /*.router-link-active {*/
            /*    font-weight: bold;*/
            /*}*/
        </style>
    </head>
    <body>
    <div id="app">
        <app></app>
    </div>

    </body>
    <script src="{{mix('js/app.js')}}"></script>
</html>
