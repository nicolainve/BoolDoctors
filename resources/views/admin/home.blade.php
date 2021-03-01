@extends('layouts.app')

@section('title')
<title>BoolDoctors-Dashboard</title>
@endsection

@section('content')
<div class="container">

    <div class="click d-flex justify-content-between flex-wrap  mt-3 p-4 border">
        <div class="spons-prof" style="flex-basis: 400px;">
            {{--  Request Sponsor --}}
            <h4>Per ottenere una sponsorizzazione</h4>
            <button type="button" class="btn btn-primary btn-md mb-2">
                <a href="{{route('admin.sponsor')}}">Clicca qui</a>
            </button>
        </div>
        
        <div class="statistiche" style="flex-basis: 400px;">
            {{-- Check reviews&message stats --}}
            <h4>Per vedere le tue statistiche</h4>
            <button type="button" class="btn btn-primary btn-md ">
                <a href="{{route('admin.stats')}}">Clicca qui</a>
            </button>
        </div>
    </div>

    {{-- MESSAGES RECEIVED --}}
    <h2 class="mt-4">Messaggi ricevuti</h2>
    <div class="messages-received border p-3">
        
        @forelse ($messages as $message)
            <h4 class="m-0">Hai ricevuto un messaggio da: <span class="font-weight-bold">{{ $message->author }}</span></h4>
            <p class="m-0 ml-2">{{ $message->created_at->diffForHumans() }}</p>
            <p class="ml-2 mb-0">Indirizzo mail di {{ $message->author }}: <a href="mailto:{{ $message->mail }}">{{ $message->mail }}</a></p>
                <div class="text-area d-flex flex-wrap">
                    <div class="ml-2">Messaggio:</div>
                    <div class="border px-2 pb-2 ml-3 mb-5 font-italic">{{ $message->body }}</div>
                </div>
        @empty
            <h4>Nessun messaggio</h4>
        @endforelse
    </div>
    {{-- REVIEWS --}}
    <h2 class="mt-4">My Reviews</h2>
    <div class="reviews-received border p-3">
        @forelse ($reviews as $review)
        <h4><span class="font-weight-bold">{{ $review->author }}</span> ha scritto:</h4>
            <div class="d-flex border">
                <div class="recensione font-italic">"{{ $review->body }}"</div>
            </div>
            <p class="mb-4">{{$review->created_at->diffForHumans()}}.</p>
        @empty
            <h4>Nessun messaggio</h4>
        @endforelse
    </div>

    @foreach ($info->votes as $vote)
        <span class="badge badge-primary">{{ $vote->vote }}</span>
    @endforeach

</div>
@endsection
