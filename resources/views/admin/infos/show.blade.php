@extends('layouts.app')
@section('content')
<div class="container p-4">
    <a class="btn btn-primary"href="{{ route('admin.infos.edit', Auth::user()->info['id']) }}">Modifica Profilo</a>
    <form class="d-inline" action="{{ route('admin.infos.destroy', Auth::user()->info['id']) }}" method="POST">
        @csrf
        @method('DELETE')
        <input class="btn btn-danger" type="submit" value="Cancella Profilo">
    </form>
    {{--  Infos Profile --}}
    <div class="profile d-flex flex-wrap p-3 ">
        <div class="photo">
            
            {{-- Check photo --}}
            
            @if(!empty($info->photo))

                @if(in_array($info->photo, $fakeImg))
                <img width="300px" src="{{ asset('./' . $info->photo) }}" alt="{{ $info->name }}">
                @else
                <img width="300" src="{{ asset('storage/' . $info->photo) }}" alt="{{ $info->name }}">
                @endif
                
            @else
                <img width="300" src="{{ asset('img/no-image.png') }}" alt="{{ $info->name }}">
            @endif

        </div>
        <div class="info p-4 ">
            <h2>Dott.{{ $info->name }} {{ $info->surname }}</h2>
            <div class="specializzazione mt-3">
                <section class="specialization">
                    <div class="font-weight-bold">Le tue specializzazioni </div>
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
        </div>
    </div>
    <div class="Curriculum font-weight-bold mt-4 mb-3">
        <h3 class="mb-4">Il tuo Curriculum Vitae</h3>
        <p class="border border-secondary p-3" style="white-space: pre-line;">{{ $info->CV }}</p>
    </div>
</div>
@endsection