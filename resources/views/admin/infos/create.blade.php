@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Crea le tue info</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.infos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    
    
    <div class="form-group">
       <label for="name">Nome</label>
       <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" maxlength="150">
    </div>
    <div class="form-group">
        <label for="surname">Cognome</label>
        <input class="form-control" type="text" name="surname" id="surname" value="{{ old('surname') }}" required maxlength="150">   
     </div>
     <div class="form-group">
        <label for="address">Indirizzo</label>
        <input class="form-control" type="text" name="address" id="address" value="{{ old('address') }}" required maxlength="30">   
     </div>
     <div class="form-group">
        <label for="CV">Curriculum Vitae</label>
        <textarea class="form-control" name="CV" id="CV" cols="30" rows="10" required maxlength="1000">{{ old('CV') }}</textarea>
     </div>
     <div class="form-group">
        <label for="photo">Immagine: </label>
        <input class="form-control" type="file" accept="image/*" name="photo" value="{{ old('photo') }}" maxlength="1000">
      </div>
     <div class="form-group">
        <label for="phone">Numero di telefono</label>
        <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone') }}" required minlength="8" maxlength="11">   
     </div>
     <div class="form-group">
        <label for="price">Prezzo</label>
        <input class="form-control" type="number" name="price" id="price" value="{{ old('price') }}" required min="1" max="9999">   
     </div>

     <div class="form-group">
      @foreach ($specializations as $specialization)
          <div class="form-check">
              <input class="form-check-input" type="checkbox" name="specializations[]" id="specialization-{{ $specialization->id }}" value="{{ $specialization->id }}">
              <label for="specialization-{{ $specialization->id }}">
                  {{ $specialization->type }}
              </label>
          </div>
      @endforeach

      </div>

     <input class="btn btn-primary" value="Crea le tue info" type="submit">
    </form>
</div>
@endsection