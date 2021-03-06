@extends('layouts.app')
@section('content')
<div class="create-form">
    <div class="container d-flex flex-column">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      <div class="form-image d-flex">
        <div class="form">
            <form action="{{ route('admin.infos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <h1 class="font-weight-bold mt-5">Crea il tuo profilo su BoolDoctors:</h1>
            <div class="form-group font-weight-bold">
               <label for="name">Nome *</label>
               <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" required maxlength="150">
            </div>
            <div class="form-group font-weight-bold">
                <label for="surname">Cognome *</label>
                <input class="form-control" type="text" name="surname" id="surname" value="{{ old('surname') }}" required maxlength="150">   
             </div>
             <div class="form-group font-weight-bold">
                <label for="address">Indirizzo *</label>
                <input class="form-control" type="text" name="address" id="address" value="{{ old('address') }}" required maxlength="30">   
             </div>
             <div class="form-group font-weight-bold">
                <label for="CV">Curriculum Vitae</label>
                <textarea class="form-control" name="CV" id="CV" cols="30" rows="10" required maxlength="1000">{{ old('CV') }}</textarea>
             </div>
             <div class="form-group font-weight-bold">
                <label for="photo">Immagine: </label>
                <input class="form-control" type="file" accept="image/*" id="image" name="photo" value="{{ old('photo') }}" maxlength="1000">
              </div>
             <div class="form-group font-weight-bold">
                <label for="phone font-weight-bold">Numero di telefono *</label>
                <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone') }}" required minlength="8" maxlength="20">   
             </div>
             <div class="form-group font-weight-bold">
                <label for="price">Prezzo *</label>
                <input class="form-control input" type="number" name="price" id="price" value="{{ old('price') }}" required min="1" max="9999" step="0.01">   
             </div>
             <div class="form-group">
                 <label class="font-weight-bold"for="specializzazioni">Specializzazioni *</label>
              @foreach ($specializations as $specialization)
                  <div class="form-check font-weight-bold">
                      <input class="form-check-input" type="checkbox" name="specializations[]" id="specialization-{{ $specialization->id }}" value="{{ $specialization->id }}">
                      <label for="specialization-{{ $specialization->id }}">
                          {{ $specialization->type }}
                      </label>
                  </div>
              @endforeach
              </div>
              <small class="ml-5 text-danger">I campi contrassegnati * sono obbligatori</small>
              <input id="crea" class="btn btn-primary mt-5 mb-5" value="Crea il profilo" type="submit">
            </form>
          </div>
          <div class="nurse-img">
            <img id="idImmagine" style="display: none;" src="./img/nurse2.jpg" alt="">
          </div>
      </div>
    </div>
</div>
<script>
    function cambia(){
    var immagine = document.getElementById("idImmagine");
    immagine.style.display = "inline";
    }
    setTimeout("cambia();", 2000);
</script>
@endsection