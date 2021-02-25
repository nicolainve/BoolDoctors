@extends('layouts.app')

@section('title')
<title>BoolDoctors-Dashboard</title>
@endsection

@section('content')
<div class="container">

    {{--  Request Sponsor --}}
     <h4>Clicka qui per una sponsorizzazione del profilo</h4>
    <a href="{{route('admin.sponsor')}}">clicka qui</a>
    {{-- Check reviews&message stats --}}
     <h4>Clicka qui per le tue stats</h4>
    <a href="{{route('admin.stats')}}">clicka qui</a>
    {{-- MESSAGES RECEIVED --}}
    <h2>My Message</h2>
        @forelse ($messages as $message)

        <h3>{{ $message->author }}</h3>
        <a href="mailto:{{ $message->mail }}">{{ $message->mail }}</a>
        <p>{{ $message->body }}</p>
        <h4>{{ $message->created_at->diffForHumans() }}</h4>
        @empty
        <h4>Nessun messaggio</h4>
        @endforelse
    {{-- REVIEWS --}}
    <h2>My Reviews</h2>
        @forelse ($reviews as $review)

        <h3>{{ $review->author }}</h3>
        <p>{{ $review->body }}</p>
        <h4>{{ $review->created_at->diffForHumans() }}</h4>
        @empty
        <h4>Nessun messaggio</h4>
        @endforelse

    @foreach ($info->votes as $vote)
    <span class="badge badge-primary">{{ $vote->vote }}</span>
    @endforeach

</div>
@endsection
