@extends('layouts.app-vue')
@section('title')
<title>BoolDoctors</title>
@endsection
@section('content')

<div class="hero" style="background: #005878;">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="6000" data-pause="false">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                  <div>
                    <img class="d-block w-100" src="{{asset('img/jumbo2-edit.jpg')}}" alt="First slide">
                  </div>
                  <div class="titles carousel-caption rounded d-none d-md-block" style="background: rgba(0,0, 0, .7)">
                        <h1>Prenota la tua visita online!</h1>
                        <h3 class="mb-3">Più del 90% dei pazienti consiglia BoolDoctors</h3>
                    </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/surgery-1807541_1920-edit.jpg')}}" alt="Second slide">
                <div class="titles carousel-caption rounded-20 d-none d-md-block" style="background: rgba(0,0, 0, .7)">
                    <h1 class="mt-3">Cerca lo specialista e <br> la prestazione di cui hai bisogno</h1>
                    <h3>Seleziona la modalità a te più comoda</h3>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/analysis-2030266_1920-edit.jpg')}}"  alt="Third slide">
                <div class="titles carousel-caption rounded-20 d-none d-md-block" style="background: rgba(0,0, 0, .7)">
                    <h1>Gestisci la tua prenotazione in completa autonomia</h1>
                </div>
              </div>
            </div>
          </div>
</div>

{{-- Vue --}}
<div id="app" style="background-color: #00abff57;">
    <div class="container spec py-4 text-center py-5" >
        <h1 class="font-weight-bold mb-5">Cosa stai cercando?</h1>
            <div class="box-spec d-flex flex-wrap justify-content-center">
                @foreach ($specializations as $specialization)
                <div class="btn btn-spec btn-primary py-4 m-2" v-on:click="search( '{{$specialization->id}}' )">
                    <div class="icona my-2">
                        {!! $specialization->fontawesome !!}
                    </div>
                    <div class="tit_spec mt-2">
                        <h4>{{$specialization->type}}</h4>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
    <div class="container tools py-4 " v-if="tools">
        <div class="filter d-flex flex-wrap justify-content-center">
            <div>
                <label for="avg" class="font-weight-bold">Media Voto <i class="fas fa-star"></i></label>
                <select v-on:change="filter" v-model="avg" name="avg" id="avg">
                    <option value="">Seleziona</option>
                    <option value="4">4 - 5</option>
                    <option value="3">3 - 4</option>
                    <option value="2">2 - 3</option>
                    <option value="1">1 - 2</option>
                </select>
            </div>
            <div>
                <label for="count" class="font-weight-bold ml-2">Numero Recensioni</label>
                <input class="font-weight-bold" type="number" name="count" id="count" placeholder="Seleziona" v-on:input="filter" v-model="count">
            </div>
        </div>
        {{-- Risultati Ricerca by Specializzazione --}}
        <h3 class="my-3">Risultato della ricerca:</h3>
        <div class="result_search d-flex flex-wrap justify-content-center" style="overflow: auto; height: 400px;">
            <div class="box-profile rounded bg-info d-flex justify-content-around flex-wrap py-2 m-2" v-for="result in results" style="width: 320px; height: 135px;">
                <div class="img mb-1">
                    {{-- Check photo --}}
                        <img v-if="fakeImg.includes(result.photo) " width="80px" :src="result.photo" >
                        <img v-else-if="result.photo" width="80px" :src="`storage/` + result.photo" >
                        <img v-else width="80px" src="{{ asset('img/no-image.png') }}" >
                </div>
                <div class="info">
                    <h5>Dott. @{{ result.name }} @{{  result.surname}}</h5>
                    <a class="text-danger" :href="routing(result.slug)">Mostra profilo</a>
                    <div>Voto medio: @{{ result.average }}</div>
                    <div>Numero di recensioni: @{{ result.count }}</div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- ACCOUNT PREMIUM --}}
<div class="background" style="background-color: #00abff57;">
    <div class="container doctors-sponsor p-4 ">
    <h2 class="text-center font-weight-bold my-5">Gli specialisti consigliati da noi:</h2>
    <div class="premium d-flex p-3" style=" height: 250px; overflow-y: auto">
        @foreach ($doctors as $doctor)
            <div class="box border-danger rounded mx-2 mb-2 px-4 pb-4" style="width: 300px; height: 170px; flex-shrink: 0">
                <div class="text-right text-danger my-2">Account Premium</div>
                <div class="d-flex">
                    <div>
                        {{-- PHOTO DOCTOR PREMIUM--}}
                        @if(!empty($doctor->photo))
                            @if(in_array($doctor->photo, $fakeImg))
                            <img width="80px" src="{{ asset('./' . $doctor->photo) }}" alt="{{ $doctor->name }}">
                            @else
                            <img width="80px" src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}">
                        @endif
                        @else
                            <img width="80px" src="{{ asset('img/no-image.png') }}" alt="{{ $doctor->name }}">
                        @endif
                    </div>
                    <div>
                        <h5>Dott. {{ $doctor->name }} {{ $doctor->surname }}</h5>
                        <a class="text-danger" href="{{ route('guest.infos.show', $doctor->slug)}}" style="text-decoration: none;">Mostra profilo</a>    
                        <div>
                             {{-- Specialization --}}
                            @foreach ($doctor->specializations as $specialization)
                            <div class="badge badge-primary p-1 my-1">{{ $specialization->type }}</div> 
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection