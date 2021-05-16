@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <div class="max-w-xl mx-auto py-8">
            <div class="pb-8">
                <h2 class="text-xl text-center font-bold pb-4">...</h2>
                <div class="max-w-md mx-auto">
                    <form id="payment-form">
                        <div id="card-element"><!--Stripe.js injects the Card Element--></div>
                        <button id="submit">
                            <div class="spinner hidden" id="spinner"><i class="fa fa-fw fa-spinner fa-spin"></i></div>
                            <span id="button-text">Pay now</span>
                        </button>
                        <p id="card-error" role="alert"></p>
                        <p class="result-message hidden">
                            Payment succeeded, see the result in your
                            <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
                        </p>
                    </form>
                    <div class="font-bold text-green-600">
                        <i class="far fa-fw fa-lock"></i> Paiement sécurisé
                    </div>
                </div>

            </div>

            <div class="pb-8">
                <h2 class="text-xl text-center font-bold pb-4">Récapitulatif de la commande</h2>
                <div class="bg-gray-100 rounded-md">
                    <div class="grid grid-cols-4 px-4 py-2 gap-2 border-b-2 font-bold">
                        <div>Quantité</div>
                        <div>Prix</div>
                        <div>Nom</div>
                        <div>Prix total</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2 px-4 py-1">
                        @foreach($cartItems as $cartItem)
                            <div>{{ $cartItem->quantity }}</div>
                            <div>{{ $cartItem->price }}€</div>
                            <div>{{ $cartItem->name }}</div>
                            <div>{{ $cartItem->price * $cartItem->quantity }}€</div>
                        @endforeach
                    </div>
                </div>
                <h3 class="text-md text-center pt-4 pb-4">Total de la commande : <b>TODO PRIX TOTAL</b></h3>
            </div>
        </div>
    </div>
@endsection

{{-- JS Stripe --}}
@push('after-head-scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endpush

{{-- JS payWithCard --}}
@push('after-foot-scripts')
    <script>
        // A reference to Stripe.js initialized with your real test publishable API key.
        var stripe = Stripe('{{ env('STRIPE_PUBLIC_KEY') }}');

        // Disable the button until we have Stripe set up on the page
        document.querySelector("button").disabled = true;

        var elements = stripe.elements();

        var style = {
            base: {
                color: "#32325d",
                fontFamily: 'Arial, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#32325d"
                }
            },
            invalid: {
                fontFamily: 'Arial, sans-serif',
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };

        var card = elements.create("card", { style: style });
        // Stripe injects an iframe into the DOM
        card.mount("#card-element");

        card.on("change", function (event) {
            // Disable the Pay button if there are no card details in the Element
            document.querySelector("button").disabled = event.empty;
            document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
        });

        var form = document.getElementById("payment-form");
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            // Complete payment when the submit button is clicked
            payWithCard(stripe, card, "{{ $paymentIntent["client_secret"] }}");
        });

        // Calls stripe.confirmCardPayment
        // If the card requires authentication Stripe shows a pop-up modal to
        // prompt the user to enter authentication details without leaving your page.
        var payWithCard = function(stripe, card, clientSecret) {
            loading(true);
            stripe
                .confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: card
                    }
                })
                .then(function(result) {
                    if (result.error) {
                        // Show error to your customer
                        showError(result.error.message);
                    } else {
                        // The payment succeeded!
                        orderComplete(result.paymentIntent.id);
                    }
                });
        };

        /* ------- UI helpers ------- */

        // Shows a success message when the payment is complete
        var orderComplete = function(paymentIntentId) {
            loading(false);
            document
                .querySelector(".result-message a")
                .setAttribute(
                    "href",
                    "https://dashboard.stripe.com/test/payments/" + paymentIntentId
                );
            document.querySelector(".result-message").classList.remove("hidden");
            document.querySelector("button").disabled = true;
        };

        // Show the customer the error from Stripe if their card fails to charge
        var showError = function(errorMsgText) {
            loading(false);
            var errorMsg = document.querySelector("#card-error");
            errorMsg.textContent = errorMsgText;
            setTimeout(function() {
                errorMsg.textContent = "";
            }, 4000);
        };

        // Show a spinner on payment submission
        var loading = function(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("button").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("button").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        };

    </script>
@endpush

@push('after-head-scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        input {
            border-radius: 6px;
            margin-bottom: 6px;
            padding: 12px;
            border: 1px solid rgba(50, 50, 93, 0.1);
            height: 44px;
            font-size: 16px;
            width: 100%;
            background: white;
        }

        .result-message {
            line-height: 22px;
            font-size: 16px;
        }

        .result-message a {
            color: rgb(89, 111, 214);
            font-weight: 600;
            text-decoration: none;
        }

        .hidden {
            display: none;
        }

        #card-error {
            color: rgb(105, 115, 134);
            text-align: left;
            font-size: 13px;
            line-height: 17px;
            margin-top: 12px;
        }

        #card-element {
            border-radius: 4px 4px 0 0 ;
            padding: 12px;
            border: 1px solid rgba(50, 50, 93, 0.1);
            height: 44px;
            width: 100%;
            background: white;
        }

        #payment-request-button {
            margin-bottom: 32px;
        }

        /* Buttons and links */
        button {
            background: #5469d4;
            color: #ffffff;
            font-family: Arial, sans-serif;
            border-radius: 0 0 4px 4px;
            border: 0;
            padding: 12px 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: block;
            transition: all 0.2s ease;
            box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
            width: 100%;
        }
        button:hover {
            filter: contrast(115%);
        }
        button:disabled {
            opacity: 0.5;
            cursor: default;
        }

        /* spinner/processing state, errors */
        .spinner,
        .spinner:before,
        .spinner:after {
            border-radius: 50%;
        }
        .spinner {
            color: #ffffff;
            font-size: 22px;
            text-indent: -99999px;
            margin: 0px auto;
            position: relative;
            width: 20px;
            height: 20px;
            box-shadow: inset 0 0 0 2px;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }
        .spinner:before,
        .spinner:after {
            position: absolute;
            content: "";
        }
        .spinner:before {
            width: 10.4px;
            height: 20.4px;
            background: #5469d4;
            border-radius: 20.4px 0 0 20.4px;
            top: -0.2px;
            left: -0.2px;
            -webkit-transform-origin: 10.4px 10.2px;
            transform-origin: 10.4px 10.2px;
            -webkit-animation: loading 2s infinite ease 1.5s;
            animation: loading 2s infinite ease 1.5s;
        }
        .spinner:after {
            width: 10.4px;
            height: 10.2px;
            background: #5469d4;
            border-radius: 0 10.2px 10.2px 0;
            top: -0.1px;
            left: 10.2px;
            -webkit-transform-origin: 0px 10.2px;
            transform-origin: 0px 10.2px;
            -webkit-animation: loading 2s infinite ease;
            animation: loading 2s infinite ease;
        }

        @-webkit-keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @media only screen and (max-width: 600px) {
            form {
                width: 80vw;
            }
        }

    </style>
@endpush
