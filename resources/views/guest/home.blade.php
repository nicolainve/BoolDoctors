@extends('layouts.app')

@section('title')
<title>BoolDoctors</title>
@endsection
@section('content')

<h1 class="text-center">HOME PAGE PUBBLICA</h1>

<div>
    <h1>Scegli la tipologia della visita:</h1>

</div>
    @foreach ($specializations as $specialization)

        <div class="btn btn-primary" v-on:click="search( '{{$specialization->type}}' )" >
            {{$specialization->type}}
        </div>
    @endforeach
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
        <label for="tot">Num. Recensioni</label>
        <input type="number" name="tot" id="tot" placeholder="Scegli" v-on:input="filter" v-model="tot">
    </div>

    {{-- Risultati Ricerca by Specializzazione --}}
    <ul>
        <li v-for="result in results">
            <p>@{{ result.name }} @{{  result.surname}}</p>

            <a :href="routing(result.slug)">Mostra profilo</a>

            <p>Voto medio @{{ result.average }}</p>

            <p>Numero di recensioni @{{ result.tot }}</p>

        </li>
    </ul>
</div>


@endsection