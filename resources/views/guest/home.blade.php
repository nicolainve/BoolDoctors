@extends('layouts.app')

@section('title')
<title>BoolDoctors</title>
@endsection
@section('content')


<div class="jumbotron">
    <div class="titles">
        <h1>Prenota la tua visita online!</h1>
        <h3 class="mb-3">Più del 90% dei pazienti consiglia BoolDoctor</h3>
        <h5 class="mt-3">Cerca lo specialista e la prestazione di cui hai bisogno</h5>
        <h5>Seleziona la modalità a te più comoda</h5>
        <h5>Gestisci la tua prenotazione in completa autonomia</h5>
    </div>
</div>

<div class="container spec py-4">
    <h1>Scegli la tipologia della visita:</h1>
    {{-- <div class="flex_box d-flex flex-wrap"> --}}
        <div class="box-spec d-flex flex-wrap">
            {{-- flex-wrap --}}
            @foreach ($specializations as $specialization)
    
            <div class="btn btn-spec btn-primary" v-on:click="search( '{{$specialization->id}}' )" style="flex-basis: 170px" >
                {{$specialization->type}}
                {!! $specialization->fontawesome !!}
            </div>
            @endforeach
        </div>
    {{-- </div> --}}
</div>

<div class=" container tools py-4 " v-if="tools">
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
    <h3 mt-4>Risultato della ricerca:</h3>
    <div class="result_search d-flex flex-wrap">
        <div class="box-profile rounded bg-info d-flex justify-content-around flex-wrap p-4 m-2" v-for="result in results" style="width: 350px;">
            <div class="img mb-1">
                {{-- Check photo --}}
                @if(!empty($info->photo))
                    <img width="100px" src="{{ asset('storage/' . $info->photo) }}" >
                    {{-- alt="{{ $info->name }}" --}}
                @else
                    <img width="100px" src="{{ asset('img/no-image.png') }}" >
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
<div class="container doctors-sponsor  p-5">
    <h2>I dottori Premium di BoolDoctors!</h2>
    <div class="premium d-flex flex-wrap">
                @foreach ($doctors as $doctor)
                    <div class="box border border-danger rounded mx-2 mb-4 px-4 pb-4" style="width: 300px;">
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