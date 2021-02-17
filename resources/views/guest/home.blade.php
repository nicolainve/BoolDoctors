@extends('layouts.app')

@section('content')

<h1 class="text-center">HOME PAGE PUBBLICA</h1>

<div>
    <h1>Scegli la tipologia della visita:</h1>

    {{-- opzione ricerca per specializzazione --}}
    {{-- <input type="text" v-model="modelSpec" v-on:keyup.enter="inputSearch()"> --}}

    <ul class="boxes">
        <li v-for= "spec in specs" >
           <div class="btn btn-primary" v-on:click="search( spec.type )" >
                @{{spec.type}}
           </div>
        </li>
    </ul>
</div>
<div>
    {{-- Risultati Ricerca by Specializzazione --}}
    <ul>
        <li v-for="result in results">
            <p>@{{ result.name }} @{{  result.surname}}</p>
            <ul>
                <li v-for="type in result.specializations">
                    @{{ type.type }}
                </li>
                {{-- votes --}}
                <li v-for="vote in result.votes">
                    @{{ vote.vote }}
                </li>
            </ul>
        </li>
    </ul>
</div>


@endsection