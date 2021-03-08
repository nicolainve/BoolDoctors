@extends('layouts.app')
@section('title')
<title>BoolDoctors-Dashboard</title>
@endsection
@section('content')
<div class="main-profile py-5">
    <div class="container">
        {{-- Options for profile --}}
        <div class="container click">

            @if (!sizeof(DB::table('info_sponsor')->where('info_sponsor.info_id', Auth::user()->info['id'])->where('info_sponsor.expired_at', '>', \Carbon\Carbon::now())->get()))
            <div class="spons-prof mt-4 mb-5">
                {{--  Request Sponsor --}}
                <h2 class="font-weight-bold">Vuoi avere più visibilità su BoolDoctors?</h2>
                <img src="{{asset('img/premium.svg')}}" alt="premium">
                <div class="premium">
                    <h4>Ottieni una sponsorizzazione!</h4>
                    <p>Avrai così la possibilità che il tuo profilo sia  fra i primi ad apparire sulla nostra homepage</p>
                    <a href="{{route('admin.sponsor')}}">
                        <button type="button" class="btn btn-primary btn-md mb-2">
                            Acquista subito un abbonamento!
                        </button>
                    </a>
                </div>
            </div>
            @endif


            <div class="statistiche">
                {{-- Check reviews&message stats --}}
                <div class="stat">
                    <img src="{{asset('img/statistic.svg')}}" alt="">
                </div>
                <a href="{{route('admin.stats')}}">
                    <button type="button" class="btn btn-primary btn-md ">
                        Vai alle tue statische
                    </button>
                </a>
            </div>
        </div>
        {{-- MESSAGES RECEIVED --}}
        <div class="message-container my-5">
                <h2 class="font-weight-bold"><i class="far fa-envelope mr-4"></i>Messaggi ricevuti:</h2>
                <div class="message-img">
                    <img src="{{asset('img/email.svg')}}" alt="">
                </div>
            <div class="messages-received border p-3">
                @forelse ($messages as $message)
                    <div class="message">
                        <h4 class="m-0">Hai ricevuto un messaggio da: <span class="font-weight-bold">{{ $message->author }}</span></h4>
                        <p class="m-0 ml-2">{{ $message->created_at->diffForHumans() }}</p>
                        <p class="ml-2 mb-0 font-weight-bold">Indirizzo mail di {{ $message->author }}: <a href="mailto:{{ $message->mail }}">{{ $message->mail }}</a></p>
                            <div class="text-area d-flex flex-wrap">
                                <div class="ml-2 font-weight-bold"><i class="fas fa-envelope mr-2"></i>Messaggio:</div>
                                <div class="mess border px-3 pb-2 ml-3 mb-5 font-italic">{{ $message->body }}</div>
                            </div>
                    </div>
                @empty
                    <h4 class="font-weight-bold">Nessun messaggio</h4>
                @endforelse
            </div>
        </div>
        <div class="message-container"> 
            {{-- REVIEWS --}}
            <h2 class="mt-4 font-weight-bold">Recensioni ricevute</h2>
            <img src="{{asset('img/vote.svg')}}" alt="">
            <div class="reviews-received border p-3">
                @forelse ($reviews as $review)
                <div class="review"> 
                    <h4><span class="font-weight-bold">{{ $review->author }}</span> ha scritto:</h4>
                        <div class="mess d-flex border">
                            <div class="recensione font-italic px-3 pb-2 ml-3">{{ $review->body }}"</div>
                        </div>
                        <p class="mb-4">{{$review->created_at->diffForHumans()}}.</p>
                    </div>
                @empty
                    <h4>Nessun messaggio</h4>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection