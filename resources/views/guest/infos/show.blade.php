@extends('layouts.app')

@section('title')
<title>{{ $info->name }} {{ $info->surname }}</title>
@endsection

@section('content')
<div class="container p-5 ">
    @if (session('message-succesed'))
        <div class="alert alert-success">
            <h3>Messaggio inviato al Dott. {{ session('message-succesed') }}</h3>
        </div>
    @endif
        
    {{-- Pagina Infos Photo Profile --}}
    <div class="d-flex">
        {{-- Infos Photo --}}
        <div class="foto">
            {{-- Check photo --}}
            @if(!empty($info->photo))
                <img width="300px" src="{{ asset('storage/' . $info->photo) }}" alt="{{ $info->name }}">
            @else
                <img width="300px" src="{{ asset('img/no-image.png') }}" alt="{{ $info->name }}">
            @endif
        </div>
        {{-- Infos Profile --}}
        <div class="doc_profile p-4">
            <div class="name_vote d-flex">
                <h2> Dott.{{ $info->name }} {{ $info->surname }}</h2>
                <div class="ml-4">Media Voti: {{ $info->average }}</div> 
            </div>
            
            {{-- Dott.{{ $info->name }} {{ $info->surname }} <span>Media Voti: {{ $info->average }}</span> --}}
            <div class="specializzazione mt-3">
                <section class="specialization">
                    <h4>Le sue specializzazioni:</h4>
                    @foreach ($info->specializations as $specialization)
                        <span class="badge badge-primary p-2">{{ $specialization->type }}</span>
                    @endforeach
                </section>
            </div>
            <div class="indirizzo mt-3">        
                <span class="font-weight-bold">Indirizzo: </span>{{ $info->address}}
            </div>           
            <div class="tel">
                <span class="font-weight-bold">Telefono: </span>{{ $info->phone }}
                {{-- <h5>Telefono:</h5> --}}
                {{-- <p></p> --}}
            </div>
            <div class="prezzo">
                <span class="font-weight-bold">Prezzo: </span>{{ $info->price }} €
                {{-- <h5>Prezzo</h5> --}}
                {{-- <p></p> --}}
            </div>
            <div class="CV mt-3">
                {{-- <h5>CV</h5>
                <p class="border border-secondary p-3">{{ $info->CV }}</p> --}}

                <!-- Button modal -->
                {{-- MODIFICARE data-target="#cv" --}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                    Curriculum Vitae
                </button>
                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cvTitle">Curriculum Vitae del Dott. {{ $info->name }} {{ $info->surname }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ $info->CV }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    {{--  Send Private Message to Doctor --}}
    <div class="send_message mt-5 ">
        <h3>Scrivi un messaggio al Dottore</h3>
        <form class="border p-4" action="{{ route('messages.store') }}" method="POST">
            @csrf
            @method ('POST')
            <div class="form-group">
            <label for="author">Inserisci il tuo nome:</label>
            {{-- If Authenticated --}}
                @auth
            <input type="text" class="form-control" id="author" name="author" value="{{ Auth::user()->info['name'] }} {{ Auth::user()->info['surname'] }}">
            @endauth
            {{-- If Guest --}}
            @guest
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">
            @endguest
            
            </div>
            <div class="form-group">
                <label for="mail">Inserisci la tua email:</label>
                <input type="email" class="form-control" id="mail" name="mail" value="{{ old('mail') }}">
                
            </div>
            <div class="form-group">
                <label for="body">Scrivi il messaggio:</label>
                <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
            </div>
            <input hidden type="number" name="info_id" value="{{ $info->id }}">
            <input type="submit" class="btn btn-primary" value="Invia">
        </form>
    </div>

    {{-- REVIEWS --}}
    <div class="list_reviews mt-5">
        <h3>Recensioni</h3>
        <div class="list border">
            @forelse ($reviews as $review)
            <div class="msg p-3">
                {{-- <h3>Utente {{ $review->author }} ha scritto:</h3> --}}
                <span>L'utente <span class="font-weight-bold">{{ $review->author }}</span> ha scritto:</span>
                <p class="font-italic px-2">"{{ $review->body }}"</p>
                <small>{{ $review->created_at->diffForHumans() }}</small>
            </div>
            @empty
                <h4>Nessuna recensione</h4>
            @endforelse
        </div>
    </div>

    {{--  Post Review --}}
    <div class="reviews mt-5 ">
        <h3>Lascia una recensione</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="border p-4" action="{{ route('reviews.store') }}" method="POST">
            @csrf
            @method ('POST')
            <div class="form-group">
                <label for="author">Inserisci il tuo nome:</label>
                @auth
                <input type="text" class="form-control" id="author" name="author" value="{{ Auth::user()->info['name'] }} {{ Auth::user()->info['surname'] }}">
                @endauth
                @guest
                <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">
                @endguest
            </div>
            <div class="form-group">
                <label for="body">Inserisci un commento:</label>
                <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
            </div>
            {{-- inserimento voto --}}
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                <label class="mr-sm-2 sr-only" for="vote">Inserisci il voto</label>
                <select name="vote" class="custom-select mr-sm-2" id="vote">
                    <option disabled selected value>Scegli</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                </div>
            </div>

            <input hidden type="number" name="info_id" value="{{ $info->id }}">
            <input type="submit" class="btn btn-primary" value="Invia">
        </form>
    </div>

    
</div> 
@endsection