@extends('layouts.app')

@section('content')
<div class="container">

    Infos Profile
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

    {{-- Check photo --}}
    @if(!empty($info->photo))
        <img width="300" src="{{ asset('storage/' . $info->photo) }}" alt="{{ $info->name }}">
    @else
        <img src="{{ asset('img/no-image.png') }}" alt="{{ $info->name }}">
    @endif

    <hr>

    <h2>Media Voti: {{ $info->average }}</h2>

    <hr>

    <h3>Lascia recensione</h3>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        @method ('POST')
        <div class="form-group">
          <label for="author">Inserisci autore</label>
          <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">
          
        </div>
        <div class="form-group">
            <label for="body">Commento</label>
            <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
          </div>
        <input hidden type="number" name="info_id" value="{{ $info->id }}">
        <input type="submit" class="btn btn-primary" value="Modifica">
    </form>

    <hr>

    {{-- REVIEWS --}}
    <h2>Recensioni</h2>
    @forelse ($reviews as $review)

    <h3>{{ $review->author }}</h3>
    <p>{{ $review->body }}</p>
    <h4>{{ $review->created_at->diffForHumans() }}</h4>
    @empty
    <h4>Nessuna recensione</h4>
    @endforelse

</div>
@endsection