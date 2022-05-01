<?php
require('../config/db.php');

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body onload="paying()">
    <form action="" method="POST" id="paymentForm">
        <!-- <script>
            function paying() {
                // payWithPaystack();
                alert('hello');
            }
        </script> -->
        <button onclick="payWithPaystack()"> Processing... </button>

    </form>
    <h2>hello</h2>
    <script src="https://js.paystack.co/v1/inline.js"></script>

    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);

        function payWithPaystack(e) {
            e.preventDefault();
            let handler = PaystackPop.setup({
                key: 'pk_test_47a5d59f51c31385b495e531607c9a7a1997404a', // Replace with your public key
                email: "<?php echo $_SESSION['payment_details']['email'] ?>",
                amount: 2000 * 100,
                firstname: "<?php echo $_SESSION['payment_details']['firstname']; ?>",
                lastname: "<?php echo $_SESSION['payment_details']['lastname']; ?>",

                ref: "<?php echo $_SESSION['payment_details']['store_id']; ?>", // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                // ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                // label: "Optional string that replaces customer email"
                onClose: function() {
                    // alert('Window closed.');
                    window.open("<?php echo ROOT_URL ?>sellershub/subscription.php");
                },
                callback: function(response) {
                    window.location.href = "<?php echo ROOT_URL ?>sellershub/subscription/success.php";
                    // $_SESSION['payment_details']

                    // let message = 'Payment complete! Reference: ' + response.reference;
                    // alert(message);
                    $.ajax({
                        url: "<?php echo ROOT_URL ?>sellershub/subscription/success.php" + response.reference,
                        method: 'get',
                        success: function(response) {
                            // the transaction status is in response.data.status
                        }

                    });

                }
            });
            handler.openIframe();
        }
        // alert('hello');
    </script>
</body>

</html>