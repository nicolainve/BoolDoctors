@extends('layouts.app')
@section('title')
<title>BoolDoctors · Pagamento Confermato</title>
@endsection
@section('content')
<div class="d-flex justify-content-center align-items-center text-center" style="height:300px;">
    <div class="payed-box">
        <h1>Il pagamento è andato a buon fine!</h1>
        <i class="fas fa-check"></i>
        <a href="{{ route('admin.home') }}">Torna alla tua area riservata</a>
    </div>
</div>
@endsection