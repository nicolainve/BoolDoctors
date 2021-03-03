

@extends('layouts.app')

@section('title')

<title>BoolDoctors · Statistiche</title>

@endsection

@section('content')

<input type="hidden" value="{{ $info->id }}" id="id">
<div class="container stats">
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

<script src="{{ asset('./js/stats.js') }}"></script>

@endsection