@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <h1 class="text-center">HOME PAGE PRIVATA</h1>

                </div>
            </div>
        </div>
    </div>
    {{--  Request Sponsor --}}
     <h4>Clicka qui per una sponsorizzazione del profilo</h4>
    <a href="{{route('admin.sponsor')}}">clicka qui</a>
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
