@extends('layouts.app')

@section('title')
<title>BoolDoctors-Dashboard</title>
@endsection

@section('content')
<div class="container">

    <div class="click flex jspace mt">
        <div class="spons-prof">
            {{--  Request Sponsor --}}
        <h4>Clicca qui per una sponsorizzazione del profilo</h4>
        <button type="button" class="btn btn-primary btn-lg">
            <a class="white" href="{{route('admin.sponsor')}}">Clicca qui</a>
        </button>
        </div>
        
        <div class="statistiche">
            {{-- Check reviews&message stats --}}
         <h4>Clicca qui per le tue statistiche</h4>
         <button type="button" class="btn btn-primary btn-lg">
            <a class="white" href="{{route('admin.stats')}}">Clicca qui</a>
         </button>
         
        </div>
    </div>

    {{-- MESSAGES RECEIVED --}}
    <div class="messages-received">
        <h2>I miei Messaggi:</h2>

        
        @forelse ($messages as $message)

        <h3>Autore del messaggio: {{ $message->author }}</h3>
        <div>Indirizzo mail: <a href="mailto:{{ $message->mail }}">{{ $message->mail }}</a></div>
        <div class="text-area flex">
            <div>Messaggio:</div>
            <textarea name="" id="" cols="30" rows="5">{{ $message->body }}</textarea>
        </div>
        <h5>Il messaggio è stato inviato {{ $message->created_at->diffForHumans() }}.</h5>
        @empty
        <h4>Nessun messaggio</h4>
        @endforelse
    </div>
    {{-- REVIEWS --}}
    <div class="reviews-received">
        <h2>My Reviews</h2>
        @forelse ($reviews as $review)
        <h3>Autore della recensione: {{ $review->author }}</h3>
        <div class="text-area flex">
            <div>Recensione:</div>
            <textarea name="" id="" cols="30" rows="5">{{ $review->body }}</textarea>
        </div>
        <h5>La recensione è stata inviata {{ $review->created_at->diffForHumans() }}.</h5>
        @empty
        <h4>Nessun messaggio</h4>
        @endforelse
    </div>

    @foreach ($info->votes as $vote)
    <span class="badge badge-primary">{{ $vote->vote }}</span>
    @endforeach

</div>
@endsection
