<?php
require('../config/db.php');
if (!isset($_SESSION['shipping_details'])) {
    header('Location:' . ROOT_URL);
}
// print_r($_SESSION['shipping_details']['2']);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/all.min.css" rel="stylesheet">
    <title>Pay</title>
    <style>
        * {
            font-family: Comic Sans MS;
            font-weight: bold !important;
        }

        .table-header {
            border-radius: 10px 10px 0px 0px;
        }

        .boxing {
            justify-content: center;
        }

        .card {
            border-radius: 10px;
        }

        /* .form-control{
            fe
        } */
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid bg-light">
        <div class="row">
            <div class="col-md-12 bg-light">
                <!-- <h2 class="text-left text-primary">PAYMENT</h2> -->
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="boxing row mt-5 mb-5">
                        <div class="card shadow w-100 p-2 py-5 my-5">

                            <div class="row">
                                <div class="col-md-12 text-center text-primary m-2">
                                    <h3>TOTAL TO PAY</h3>
                                </div>
                            </div>
                            <form action="" id="paymentForm" class="m-4">
                                <div class="row">

                                    <div class="col-md-12 my-5">
                                        <h6 class="text-center text-primary"> <span class="text-dark">TOTAL TO PAY</span> ₦<?php echo $_SESSION['checkout'] ?></h6>
                                    </div>
                                </div>
                                <input type="hidden" id="email" value="<?php echo $_SESSION['shipping_details']['2'] ?>">
                                <input type="hidden" id="amount" value="<?php echo $_SESSION['checkout'] ?>">
                                <input type="hidden" id="firstname" value="<?php echo $_SESSION['shipping_details']['0']?>">
                                <input type="hidden" id="lastname" value="<?php echo $_SESSION['shipping_details']['1']?>">

                                <div class=" form-submit text-center">
                                <button type="submit" onclick="payWithPaystack()" class="btn btn-primary  w-100"> Pay: ₦ <?php echo $_SESSION['checkout'] ?> </button>
                        </div>
                        </form>


                    </div>
                </div>
                <script src="https://js.paystack.co/v1/inline.js"></script>
                <script>
                    const paymentForm = document.getElementById('paymentForm');
                    paymentForm.addEventListener("submit", payWithPaystack, false);

                    function payWithPaystack(e) {
                        e.preventDefault();
                        let handler = PaystackPop.setup({
                            key: 'pk_test_47a5d59f51c31385b495e531607c9a7a1997404a', // Replace with your public key
                            email: document.getElementById("email").value,
                            amount: document.getElementById("amount").value * 100,
                            firstname: document.getElementById("firstname").value,
                            lastname: document.getElementById("lastname").value,

                            ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                            // label: "Optional string that replaces customer email"
                            onClose: function() {
                                // alert('Window closed.');
                                window.open("<?php echo ROOT_URL?>cart");
                            },
                            callback: function(response) {
                                window.location.href = "<?php echo ROOT_URL?>payStack/success.php?reference=" + response.reference;


                                let message = 'Payment complete! Reference: ' + response.reference;
                                alert(message);
                                $.ajax({
                                    url: "<?php echo ROOT_URL?>payStack/success.php?reference=" + response.reference,
                                    method: 'get',
                                    success: function(response) {
                                        // the transaction status is in response.data.status
                                    }

                                });

                            }
                        });
                        handler.openIframe();
                    }
                </script>


            </div>
        </div>
        <div class="col-md-3"></div>

    </div>

    </div>
    </div>
</body>

</html>