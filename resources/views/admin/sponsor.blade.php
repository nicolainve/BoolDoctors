<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="https://js.braintreegateway.com/web/dropin/1.26.0/js/dropin.min.js"></script>

    </head>
    <body>

        <form id="payment-form" action="{{ route('pay') }}" method="POST">
            @csrf
            @method('POST')
            <input type="radio" id="tier1" name="amount" value="2.99">
            <label for="tier1">24 ore sponsorizzazione: 2.99</label><br>
            <input type="radio" id="tier2" name="amount" value="5.99">
            <label for="tier2">72 ore sponsorizzazione: 5.99</label><br>
            <input type="radio" id="tier3" name="amount" value="9.99">
            <label for="tier3">144 ore sponsorizzazione: 9.99</label><br>
            <div id="dropin-container"></div>
            <input type="submit" />
            <input type="hidden" id="nonce" name="payment_method_nonce"/>
        </form>

        <script type="text/javascript">

        const form = document.getElementById('payment-form');
        const clientToken = '{{$clientToken}}';

        braintree.dropin.create({
        authorization: clientToken,
        container: '#dropin-container'
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

    </body>
</html>