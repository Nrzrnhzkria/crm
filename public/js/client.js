var form = document.getElementById('payment-form');

form.addEventListener('submit', function (event) {
  event.preventDefault();

  var fpxButton = document.getElementById('fpx-button');
  var clientSecret = fpxButton.dataset.secret;
  stripe.confirmFpxPayment(clientSecret, {
    payment_method: {
      fpx: fpxBank,
    },
    // Return URL where the customer should be redirected after the authorization
    return_url: `${window.location.href}`,
  }).then((result) => {
    if (result.error) {
      // Inform the customer that there was an error.
      var errorElement = document.getElementById('error-message');
      errorElement.textContent = result.error.message;
    }
  });
});