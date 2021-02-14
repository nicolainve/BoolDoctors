@extends('layouts.app')


@section('content')
<div class="container">

    <small>Nome e Cognome</small>
    <h2>{{ $info->name }} {{ $info->surname }}</h2>

    <small>Indirizzo</small>
    <p>{{ $info->address }}</p>

    <small>CV</small>
    <p>{{ $info->CV }}</p>

    <small>Telefono</small>
    <p>{{ $info->phone }}</p>

    <small>Prezzo</small>
    <p>{{ $info->price }}</p>


    @if(!empty($info->photo))
        <img width="300" src="{{ asset('storage/' . $info->photo) }}" alt="{{ $info->name }}">
    @else
        <img src="{{ asset('img/no-image.png') }}" alt="{{ $info->name }}">
    @endif

</div>
@endsection