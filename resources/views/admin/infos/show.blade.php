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



</div>
@endsection