@extends('layouts.app')

@section('title')
<title>Pagina non trovata</title>
@endsection

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 col-sm-12">
            <img src="{{asset('img/notfound.svg')}}" alt="notFound">
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="error-text">
                <h2>Ooops,sembra che la pagina che tu stia cercando non esista!</h2>
                <p> <a href="{{ url('/') }}"> Torna alla pagina iniziale</a> </p>
            </div>
        </div>
    </div>
</div>
@endsection