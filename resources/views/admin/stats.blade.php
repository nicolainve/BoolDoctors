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
        <div class="cont">
            <div class="charts-container">
                <div class="canvas-chart">
                    <canvas id="revMonth" width="100" height="100"></canvas>
                </div>
        
                <div class="canvas-chart">
                    <canvas id="revYear" width="100" height="100"></canvas>
                </div>
        
                <div class="canvas-chart">
                    <canvas id="mesMonth" width="100" height="100"></canvas>
                </div>
        
                <div class="canvas-chart">
                    <canvas id="mesYear" width="100" height="100"></canvas>
                </div>
            </div>
        </div>

       <script src="{{ asset('./js/stats.js') }}"></script>
    </body>
</html>