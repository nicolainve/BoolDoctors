@extends('layouts.app')

@section('title')

<title>BoolDoctors · Sponsor</title>

@endsection

@section('content')

<div class="premium" style="background-color: #00abff57;">
    <div class="container p-4">
        <div class="top d-flex flex-wrap justify-content-center p-5">
            <div class="content">
                <img src="{{ asset('img/pay.svg') }}" alt="icon-payment" style="max-width: 400px;">
            </div>
            <div class="titles text-center py-4">
                <h1>Ottieni una sponsorizzazione</h1>
                <h4>Scegli la sponsorizzazione che fa per te!</h4>
                <h3 class="mt-4">prova <span class="font-italic font-weight-bold">gratuita</span> per i primi <span class="font-italic font-weight-bold">7 giorni</span> </h3>
            </div>
            
        </div>
        
        <form id="payment-form" action="{{ route('pay') }}" method="POST">
            @csrf
            @method('POST')
            <div class="scegli d-flex flex-wrap justify-content-center text-center mt-5 mb-5">
                <div class="box_premium p-4 mx-2 d-flex flex-wrap  mt-4 mb-5 rounded bg-warning" style="flex-basis:300px;  box-shadow: 0 0 5px black; background: linear-gradient(225deg, hsla(30, 61%, 50%, 1) 30%, hsla(17, 60%, 52%, 1) 54%);">
                    {{-- height: 350px;  --}}
                    <div>
                        <h1>Bronzo</h1>
                        <h2 class="prezzo mt-2"> 2.99 €</h2>
                        <h5>per 24H</h5>
                        <div class="lista border-top mt-5 pt-1"> 
                            <ul class="mt-4 font-weight-bold" style="list-style-type: square;">
                                <li>Il tuo profilo apparirà in Homepage</li>
                                <li>Il tuo profilo sarà posizionato prima</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="mt-5">
                            <input type="radio" id="tier1" name="amount" value="2.99" required>
                            <label for="tier1" ><h5>Ottieni la sponsorizzazione</h5></label><br>
                        </div>
                    </div>
                </div>
               <div class="box_premium p-4 mx-2 mb-5 rounded" style="flex-basis:300px;height: 390px; box-shadow: 0 0 5px black; background: linear-gradient(225deg, hsla(0, 73%, 97%, 1) 10%, hsla(0, 73%, 97%, 1) 13%, hsla(0, 0%, 75%, 0.9) 46%);">
                    {{-- height: 380px; --}}
                    <div>
                        <h1>Argento</h1>
                        <h2 class="prezzo mt-2"> 5.99 €</h2>
                        <h5>per 72H</h5>
                        <div class="lista border-top mt-5 pt-1">
                            <ul class="mt-2 font-weight-bold" style="list-style-type: square;">
                                <li>Il tuo profilo apparirà in Homepage</li>
                                <li>Il tuo profilo sarà posizionato prima</li>
                                <li>Assistenza tecnica giorni lavorativi</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-5">
                        <input type="radio" id="tier2" name="amount" value="5.99">
                        <label for="tier2"><h5>Ottieni la sponsorizzazione</h5></label><br>
                    </div>
                </div>
                <div class="box_premium p-4 mx-2 mt-4 mb-5 bg-info  rounded" style="flex-basis:300px; box-shadow: 0 0 5px black; background: linear-gradient(225deg, hsla(347, 40%, 70%, 1) 15%, hsla(217, 100%, 50%, 0.9) 71%);">
                    {{-- height: 350px;  --}}
                    <div>
                        <h1>Platino</h1>
                        <h2 class="prezzo mt-2">  9.99 €</h2>
                        <h5>per 144H</h5>
                        <div class="lista border-top mt-5 pt-1">
                            <ul class="mt-2 font-weight-bold" style="list-style-type: square;">
                                <li>Il tuo profilo apparirà in Homepage</li>
                                <li>Il tuo profilo sarà posizionato prima</li>
                                <li>Assistenza tecnica "24H-7"</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-5">
                        <input type="radio" id="tier3" name="amount" value="9.99">
                        <label for="tier3"><h5>Ottieni la sponsorizzazione</h5></label><br>
                    </div>
                </div>
            </div>
            <div class="pay-form text-center">
                <div class="text-left" style="width: 700px; margin: 0 auto;" id="dropin-container"></div>
                <input class="btn btn-primary btn-md mb-2" style="padding: 5px 30px; font-size: 18px;" type="submit" value="Paga"/>
                <input type="hidden" id="nonce" name="payment_method_nonce"/>
                <input hidden type="number" name="info_id" value="{{Auth::user()->info['id'] }}">
            </div>
            
        </form>
    
    </div>
</div>


{{-- Braintree JS --}}
<script src="https://js.braintreegateway.com/web/dropin/1.26.0/js/dropin.min.js"></script>

<script>
    const form = document.getElementById('payment-form');
    const clientToken = '{{$clientToken}}';

    braintree.dropin.create({
    authorization: clientToken,
    container: '#dropin-container',
    locale: 'it_IT'
    }, (error, dropinInstance) => {
    if (error) console.error(error);

    form.addEventListener('submit', event => {
        event.preventDefault();

        dropinInstance.requestPaymentMethod((error, payload) => {
        if (error) console.error(error);

        document.getElementById('nonce').value = payload.nonce;
        form.submit();
        });
    });
    });
</script>

@endsection