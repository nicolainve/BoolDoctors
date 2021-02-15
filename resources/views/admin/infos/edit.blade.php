@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Modifica le tue info</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.infos.update', $info->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="form-group">
       <label for="name">Nome</label>
       <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $info->name) }}">
    </div>
    <div class="form-group">
        <label for="surname">Cognome</label>
        <input class="form-control" type="text" name="surname" id="surname" value="{{ old('surname', $info->surname) }}">   
     </div>
     <div class="form-group">
        <label for="address">Indirizzo</label>
        <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $info->address) }}">   
     </div>
     {{-- <div class="form-group">
        <label for="exampleFormControlInput1">Indirizzo E-Mail</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
     </div> --}}
     <div class="form-group">
        <label for="CV">Curriculum Vitae</label>
        <textarea class="form-control" name="CV" id="CV" cols="30" rows="10">{{ old('CV', $info->CV) }}</textarea>
     </div>
     <div class="form-group">
        <label for="photo">Immagine: </label>
        @isset($info->photo)
        <div class="wrap-image">
            <img width="200" src="{{ asset('storage/' . $info->photo) }}" alt="{{ $info->name }}">
        </div>
        <h6>Cambia:</h6>
        @endisset
        <input class="form-control" type="file" accept="image/*" name="photo" value="{{ old('photo', $info->photo) }}">
      </div>
     <div class="form-group">
        <label for="phone">Numero di telefono</label>
        <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', $info->phone) }}">   
     </div>
     <div class="form-group">
        <label for="price">Prezzo</label>
        <input class="form-control" type="number" name="price" id="price" value="{{ old('price', $info->price) }}">   
     </div>

     <div class="form-group">
      @foreach ($specializations as $specialization)
          <div class="form-check">
              <input class="form-check-input" type="checkbox" name="specializations[]" id="specialization-{{ $specialization->id }}" value="{{ $specialization->id }}" @if ($info->specializations->contains($specialization->id)) checked @endif>
              <label for="specialization-{{ $specialization->id }}">
                  {{ $specialization->type }}
              </label>
          </div>
      @endforeach

      </div>

     <input class="btn btn-primary" value="Modifica le tue info" type="submit">
    </form>
</div>
@endsection