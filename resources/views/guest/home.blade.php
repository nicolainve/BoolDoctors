@extends('layouts.app')
@section('title')
<title>BoolDoctors</title>
@endsection
@section('content')
{{-- <div class="jumbotron">
    <div class="titles">
        <h1>Prenota la tua visita online!</h1>
        <h3 class="mb-3">Più del 90% dei pazienti consiglia BoolDoctor</h3>
        <h5 class="mt-3">Cerca lo specialista e la prestazione di cui hai bisogno</h5>
        <h5>Seleziona la modalità a te più comoda</h5>
        <h5>Gestisci la tua prenotazione in completa autonomia</h5>
    </div>
</div> --}}
{{-- prova jumbo slide --}}
<div class="jumbotron2" style="background: #005878;">
    {{-- bg-dark --}}
    {{-- <div class="container jumbo_con" >  --}}
        {{-- style="width: 100%; height: 500px;" --}}
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                  <div>
                    <img class="d-block w-100" src="{{asset('img/jumbo2-edit.jpg')}}" alt="First slide">
                    {{-- nurse-2019420_1280.jpg --}}
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
                    {{-- <h1>Segui i nostri dottori anche sul nostro canale Podcast "DOctorsPod"!</h1> --}}
                    <h1>Gestisci la tua prenotazione in completa autonomia</h1>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon  p-4 rounded-circle" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon   p-4 rounded-circle" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    {{-- </div> --}}
</div>
<div class="container spec py-4">
    <h1>Scegli la tipologia della visita:</h1>
    {{-- <div class="flex_box d-flex flex-wrap"> --}}
        <div class="box-spec d-flex flex-wrap ">
            {{-- flex-wrap --}}
            @foreach ($specializations as $specialization)
            <div class="btn btn-spec btn-primary py-4" v-on:click="search( '{{$specialization->id}}' )" style="flex-basis: 170px" >
                <div class="icona my-2">
                    {!! $specialization->fontawesome !!}
                </div>
                <div class="tit_spec mt-3">
                    <h4>{{$specialization->type}}</h4>
                </div>
            </div>
            @endforeach
        </div>
    {{-- </div> --}}
</div>
<div class="container tools py-4 " v-if="tools">
    <div class="filter d-flex flex-wrap justify-content-center">
        <div>
            <span>Filtra la ricerca per: </span>
            <label for="avg" class="font-weight-bold">voto</label>
            <select v-on:change="filter" v-model="avg" name="avg" id="avg">
                <option value="">Scegli</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div>
            <label for="count" class="font-weight-bold ml-2">numero recensioni</label>
            <input type="number" name="count" id="count" placeholder="Scegli" v-on:input="filter" v-model="count">
        </div>
    </div>
    {{-- Risultati Ricerca by Specializzazione --}}
    <h3>Risultato della ricerca:</h3>
    <div class="result_search d-flex flex-wrap" style="height: 400px; overflow: auto">
        <div class="box-profile rounded bg-info d-flex justify-content-around flex-wrap py-2 m-2" v-for="result in results" style="width: 320px;">
            <div class="img mb-1">
                {{-- Check photo --}}
                @if(!empty($info->photo))
                    <img width="80px" src="{{ asset('storage/' . $info->photo) }}" >
                    {{-- alt="{{ $info->name }}" --}}
                @else
                    <img width="80px" src="{{ asset('img/no-image.png') }}" >
                    {{-- alt="{{ $info->name }}" --}}
                @endif
            </div>
            <div class="info">
                <h5>Dott. @{{ result.name }} @{{  result.surname}}</h5>
                <a class="text-danger" :href="routing(result.slug)">Mostra profilo</a>
                <div>Voto @{{ result.average }}</div>
                <div>Numero di recensioni: @{{ result.count }}</div>
            </div>
        </div>
    </div>
</div>
<div class="container doctors-sponsor p-4">
    <h2>I dottori Premium di BoolDoctors!</h2>
    <div class="premium d-flex  p-3" style="height: 300px; overflow-y: auto">
        @foreach ($doctors as $doctor)
            <div class="box border border-danger rounded mx-2 mb-2 px-4 pb-4" style="width: 300px; flex-shrink: 0;">
                <div class="text-right text-danger my-2">Account Premium</div>
                    <h5>Dott. {{ $doctor->name }} {{ $doctor->surname }}</h5> 
                <div>
                    @foreach ($doctor->specializations as $specialization)
                        <div class="badge badge-primary p-2 my-1">{{ $specialization->type }}</div> 
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection