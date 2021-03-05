@extends('layouts.app')
@section('title')
<title>{{ $info->name }} {{ $info->surname }}</title>
@endsection
@section('content')
<div class="show-guest container p-5 ">
    @if (session('message-succesed'))
        <div class="alert alert-success">
            <h3>Messaggio inviato al Dott. {{ session('message-succesed') }}</h3>
        </div>
    @endif
    {{-- Pagina Infos Photo Profile --}}
    <div class="d-flex flex-wrap justify-content-center mb-3">
        {{-- Infos Photo --}}
        <div class="foto">
            {{-- Check photo --}}


            @if(!empty($info->photo))
                {{-- @if($info->photo == 'avatar/a.png' || $info->photo == 'avatar/b.png' || $info->photo == 'avatar/c.png') --}}
                @if(in_array($info->photo, $fakeImg))
                <img width="300px" src="{{ asset('./' . $info->photo) }}" alt="{{ $info->name }}">
                @else
                <img width="300" src="{{ asset('storage/' . $info->photo) }}" alt="{{ $info->name }}">
                @endif
            @else
                <img width="300" src="{{ asset('img/no-image.png') }}" alt="{{ $info->name }}">
            @endif
        </div>
         {{-- Infos Profile --}}
         <div class="doc_profile p-4">
            <div class="name_vote d-flex">
                <h2 class="font-weight-bold"> Dott.{{ $info->name }} {{ $info->surname }}</h2>
                <div class="vote ml-4 font-weight-bold text-center">Voto Medio: {{ $info->average }}</div> 
            </div>
            {{-- Dott.{{ $info->name }} {{ $info->surname }} <span>Media Voti: {{ $info->average }}</span> --}}
            <div class="specializzazione mt-3">
                <section class="specialization">
                    <h5 class="font-weight-bold">Specializzato in:</h5>
                    @foreach ($info->specializations as $specialization)
                        <div class="badge badge-primary p-2 my-1">{{ $specialization->type }}</div>
                    @endforeach
                </section>
            </div>
            <div class="indirizzo mt-3">        
                <span class="font-weight-bold">Indirizzo: </span>{{ $info->address}}
            </div>           
            <div class="tel">
                <span class="font-weight-bold">Telefono: </span>{{ $info->phone }}
            </div>
            <div class="prezzo">
                <span class="font-weight-bold">Prezzo: </span>{{ $info->price }} €
            </div>
            <div class="CV mt-3">
                <!-- Button modal -->
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
                            <div class="modal-body" style="white-space: pre-line;">
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{--  Send Private Message to Doctor --}}
    <div class="doc-img d-flex">
        <div class="send_message d-flex flex-column flex-wrap mt-5 ">
            <div class="titolo">
                <h3 class="font-weight-bold mb-3">Scrivi un messaggio al Dottore</h3>
            </div>
            <form class="border p-4" action="{{ route('messages.store') }}" method="POST">
                @csrf
                @method ('POST')
                <div class="form-group font-weight-bold">
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
                <div class="form-group font-weight-bold">
                    <label for="mail">Inserisci la tua email:</label>
                    <input type="email" class="form-control" id="mail" name="mail" value="{{ old('mail') }}">
                </div>
                <div class="form-group font-weight-bold">
                    <label for="body">Scrivi il messaggio:</label>
                    <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
                </div>
                <input hidden type="number" name="info_id" value="{{ $info->id }}">
                <input type="submit" class="btn btn-primary" value="Invia">
            </form>
        </div>
        <div class="icona">
            <img src="{{ asset('img/icona.svg') }}" alt="">
        </div>
    </div>
    {{-- REVIEWS --}}
    <div class="list_reviews mt-5">
        <h3 class="font-weight-bold mb-3">Recensioni</h3>
        <div class="list border">
            @forelse ($reviews as $review)
            <div class="msg p-3">
                <span><i class="fas fa-user"></i> L'utente <span class="font-weight-bold">{{ $review->author }}</span> ha scritto:</span>
                <p class="font-italic px-2">"{{ $review->body }}"</p>
                <small>{{ $review->created_at->diffForHumans() }}</small>
            </div>
            @empty
                <h4>Nessuna recensione</h4>
            @endforelse
        </div>
    </div>
    {{--  Post Review --}}
    <div class="recens d-flex justify-content-between">
        <div class="image-rec">
            <img src="{{ asset('img/ico-doc.jpg') }}" alt="">
        </div>
        <div class="reviews mt-5 ">
            <h3 class="font-weight-bold mb-3"><i class="fas fa-comment-medical mr-2"></i>Lascia una recensione</h3>
            <form class="border p-4" action="{{ route('reviews.store') }}" method="POST">
                @csrf
                @method ('POST')
                <div class="form-group font-weight-bold">
                    <label for="author">Inserisci il tuo nome:</label>
                    @auth
                    <input type="text" class="form-control" id="author" name="author" value="{{ Auth::user()->info['name'] }} {{ Auth::user()->info['surname'] }}">
                    @endauth
                    @guest
                    <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">
                    @endguest
                </div>
                <div class="form-group font-weight-bold">
                    <label for="body">Inserisci un commento:</label>
                    <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
                </div>
                {{-- inserimento voto --}}
                <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                    <label class="mr-sm-2 sr-only" for="vote">Inserisci il voto</label>
                    <select name="vote" class="custom-select mr-sm-2 font-weight-bold" id="vote">
                        <option disabled selected value>Voto</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    </div>
                </div>
                <input hidden type="number" name="info_id" value="{{ $info->id }}">
                <input type="submit" class="btn btn-primary mt-4" value="Invia">
            </form>
        </div>
    </div>
</div> 
@endsection