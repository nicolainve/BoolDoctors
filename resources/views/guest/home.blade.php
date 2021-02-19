@extends('layouts.app')

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
    {{-- Risultati Ricerca by Specializzazione --}}
    <ul>
        <li v-for="result in results">
            <p>@{{ result.name }} @{{  result.surname}}</p>

            <a :href="routing(result.slug)">Mostra profilo</a>

            <p>@{{ result.average }}</p>

            <p>@{{ result.tot }}</p>

        </li>
    </ul>
</div>


@endsection