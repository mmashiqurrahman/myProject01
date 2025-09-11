<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* A basic style for the card element */
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Stripe Payment
                    </div>
                    <div class="card-body">
                        <form id="payment-form">
                            <div id="payment-element">
                                </div>
                            <button id="submit" class="btn btn-primary mt-3">
                                <div class="spinner hidden" id="spinner"></div>
                                <span id="button-text">Pay now</span>
                            </button>
                            <div id="error-message" class="mt-3 text-danger"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Set up Stripe.js and Elements to use your publishable key
        const stripe = Stripe('{{ env("STRIPE_PUBLISHABLE_KEY") }}');
        console.log('{{ env("STRIPE_SECRET_kEY") }}');
        // The client secret is passed from the server side
        const clientSecret = '{{ $clientSecret }}';
        
        const elements = stripe.elements({ clientSecret: clientSecret });
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit');
        const errorMessage = document.getElementById('error-message');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            submitButton.disabled = true;

            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: '{{ route("payment.success") }}', // A route to a success page
                },
            });

            if (error) {
                errorMessage.textContent = error.message;
                submitButton.disabled = false;
            }
        });
    </script>
</body>
</html>