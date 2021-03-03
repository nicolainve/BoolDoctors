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