@extends('layouts.app')

@section('title')
<title>BoolDoctors</title>
@endsection
@section('content')


<div class="jumbotron">
    <div class="titles">
        <h1 class="white">Prenota la tua visita online!</h1>
        <h3 class="white mb">Più del 90% dei pazienti consiglia BoolDoctor</h3>
        <h5 class="white mt">Cerca lo specialista e la prestazione di cui hai bisogno</h5>
        <h5 class="white">Seleziona la modalità a te più comoda</h5>
        <h5 class="white">Gestisci la tua prenotazione in completa autonomia</h5>
    </div>
</div>

    <div class="container spec">
        <h1>Scegli la tipologia della visita:</h1>
        <div class="box-spec">
            @foreach ($specializations as $specialization)

                <div class="btn btn-spec btn-primary" v-on:click="search( '{{$specialization->id}}' )" >
                    {{$specialization->type}}
                </div>
            @endforeach
        </div>
        
    </div>
<div>

    <div class="tools" v-if="tools">
        <p>Filtra per:</p>
        <label for="avg">Media Voto</label>
        <select v-on:change="filter" v-model="avg" name="avg" id="avg">
            <option value="">Scegli</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <label for="count">Num. Recensioni</label>
        <input type="number" name="count" id="count" placeholder="Scegli" v-on:input="filter" v-model="count">
    </div>

    {{-- Risultati Ricerca by Specializzazione --}}
    <ul>
        <li v-for="result in results">
            <p>@{{ result.name }} @{{  result.surname}}</p>

            <a :href="routing(result.slug)">Mostra profilo</a>

            <p>Voto medio @{{ result.average }}</p>

            <p>Numero di recensioni @{{ result.count }}</p>

        </li>
    </ul>
</div>


@endsection