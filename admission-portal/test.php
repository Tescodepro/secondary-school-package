<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Example of Auto Loading Bootstrap Modal on Page Load</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
  <form action="" method="post">
    <input type="number" name="num" id="">
    <button type="submit" name="okay">pay</button>
  </form>
<?php
    if (isset($_POST['okay'])) {
      if ($_POST['num'] > 9) {
        echo '<div class="modal hide" data-backdrop="static" data-keyboard="false" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">LAST CONFIRMATION</h5>
                <button  id="close_transaction" onclick="close_transaction()" type="button" class="close"  data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body"> 
                <strong>You are about to make this payments as selected. Do note that N300 will be charged from your account for the payment gateway (PAYSTACK). There are different cards options you can choose. Go ahead and make payment to Fountain University</strong> 
                
              </div>
              <div class="modal-footer">
                <a id="close_transaction" onclick="close_transaction()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <script src="https://js.paystack.co/v1/inline.js"></script>
              <button class="btn btn-me mb-3" type="button" onclick="payWithPaystack()"> Proceed to make Payment <i class="fa fa-arrow-right"></i></button>
              </div>
          </div>
      </div>
    </div>';
      }
    }
?>


<div class="modal hide" data-backdrop="static" data-keyboard="false" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">LAST CONFIRMATION</h5>
                <button  id="close_transaction" onclick="close_transaction()" type="button" class="close"  data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body"> 
                <strong>You are about to make this payments as selected. Do note that N300 will be charged from your account for the payment gateway (PAYSTACK). There are different cards options you can choose. Go ahead and make payment to Fountain University</strong> 
                
              </div>
              <div class="modal-footer">
                <a id="close_transaction" onclick="close_transaction()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>

                <script src="https://js.paystack.co/v1/inline.js"></script>
              <button class="btn btn-me mb-3" type="button" onclick="payWithPaystack()"> Proceed to make Payment <i class="fa fa-arrow-right"></i></button>
              </div>
          </div>
      </div>
    </div>

              <button type="button" onclick="payWithPaystack()"> Proceed </button>
             
<script>
	$(document).ready(function(){
		$("#exampleMdal").modal('show');
	});

  function close_transaction() {
    alert('Transaction Terminated !');
    window.location= "fees";
  } 
</script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
        function payWithPaystack() {
            var handler = PaystackPop.setup({
                key: 'pk_test_c9ca3055dbbb92e1f0009295a4402c5caeb938b4', 
                email: 'tescodepro@gmail.com',
                amount: 1000,
                ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                metadata: {
                    custom_fields: [{
                        display_name:"Full Name",
                        variable_name: "stu_name", 
                        value: 'Tesleem',
                    }, 
                ]
                },
                callback: function(response) {
                    // alert('Trasaction terminated');
                    window.location.replace("payment.php?applicationNum=<?php echo $id; ?>&amount=<?php echo $amount; ?>&payment_type=<?php echo $payment_type; ?>&ref=" + response.reference);
                },
                onClose: function() {
                    alert('Trasaction terminated');
                }
            });
            handler.openIframe();
        }
    </script>
</body>
</html>