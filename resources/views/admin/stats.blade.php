<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset ('css/app.css')}}">
        <title>Laravel</title>

    </head>
    <body>
        
        <input type="hidden" value="{{ $info->id }}" id="id">
        <div class="canvas-chart">
            <canvas id="myChart" width="200" height="200"></canvas>
        </div>

       <script src="{{ asset('./js/stats.js') }}"></script>
    </body>
</html>