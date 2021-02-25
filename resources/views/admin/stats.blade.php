<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="{{ asset ('css/app.css')}}">
        <title>Laravel</title>

    </head>
    <body>

         @include('partials.header')

        <main>
            <input type="hidden" value="{{ $info->id }}" id="id">
            <div class="cont">
                <h2> Recensioni ricevute</h2>
                <div class="container-chart">         
                    <div class="canvas-chart">
                        <canvas id="revMonth"></canvas>
                    </div>
            
                    <div class="canvas-chart">
                        <canvas id="revYear"></canvas>
                    </div>
                </div>
                <h2> Messaggi ricevuti</h2>
                <div class="container-chart">
                    
                    <div class="canvas-chart">
                        <canvas id="mesMonth"></canvas>
                    </div>
            
                    <div class="canvas-chart">
                        <canvas id="mesYear"></canvas>
                    </div>
                </div>
            </div>
            
        </main>

        @include('partials.footer')

       <script src="{{ asset('./js/stats.js') }}"></script>
    </body>
</html>