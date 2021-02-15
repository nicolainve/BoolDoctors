@extends('layouts.app')
<div>ciao rega</div>

@section('content')
<div class="container">

    <a class="btn btn-primary"href="{{ route('admin.infos.edit', Auth::user()->info['id']) }}">Edit</a>
    <form class="d-inline" action="{{ route('admin.infos.destroy', Auth::user()->info['id']) }}" method="POST">
        @csrf
        @method('DELETE')

        <input class="btn btn-danger" type="submit" value="Delete">
    </form>

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

    <section class="specialization">
        <h4>Specializzazioni</h4>
        @foreach ($info->specializations as $specialization)
            <span class="badge badge-primary">{{ $specialization->type }}</span>
        @endforeach
    </section>


    @if(!empty($info->photo))
        <img width="300" src="{{ asset('storage/' . $info->photo) }}" alt="{{ $info->name }}">
    @else
        <img src="{{ asset('img/no-image.png') }}" alt="{{ $info->name }}">
    @endif

</div>
@endsection