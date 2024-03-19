<?php
$hash  = 0 ;// if valid input
 $action = 'https://pay.afrahalkhaleej.com/pos/crt/'; 
$amount =  "15";// $_REQUEST['amount'];
$order_no =  "order12345"; // $_REQUEST['order_no'];
$currency_code =  "KWD"; // $_REQUEST['currency_code'];
$gateway_code =  "kpayt"; //$_REQUEST['gateway_code'];
$customer_email = "kamal.bunkar07@gmail.com"; //$_REQUEST['customer_email'];


$posted = array(
    'amount' => $amount,
    'order_no' => $order_no,
    'currency_code' => $currency_code,
    'gateway_code' => $gateway_code,
    'customer_email' => $customer_email,
    'disclosure_url' => "http://postapp.knpay.net/disclose_ok/" ,
    'redirect_url' => "http://app.afrahalkhaleej.com/app/payment/success.php"
    );
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

?>
<html>
  <head>
 
 <script>
     
    
        $('#knetForm').submit(function(){
                
            alert( " load ajax ");
            
            $.ajax({
              url: $('#knetForm').attr('action'),
              type: 'POST',
              data : $('#knetForm').serialize(),
              success: function(response ){
                  alert(" form  response "+response);
                console.log('knetForm submitted.'+response);
              }
            });
            return false;
        });

 
     
 </script>
 
  </head>
  <body onload="submitknetForm()">
    <h2 style="display:none;">PayU Form</h2>
    <br/>
    <?php if($formError) { ?>
	
      <span style="color:white" style="display:none;">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="knetForm">
      <table>
        <tr style="display:none;">
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr >
          <td>Amount: </td>
          <td><input name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" /></td>
          <td>Order ID </td>
          <td><input name="order_no" id="order_no" value="<?php echo (empty($posted['order_no'])) ? '' : $posted['order_no']; ?>" /></td>
        </tr>
        <tr >
          <td>currency_code </td>
          <td><input name="currency_code" id="currency_code" value="<?php echo (empty($posted['currency_code'])) ? '' : $posted['currency_code']; ?>" /></td>
        </tr>
         <tr >
          <td>gateway_code </td>
          <td><input name="gateway_code" id="gateway_code" value="<?php echo (empty($posted['gateway_code'])) ? '' : $posted['gateway_code']; ?>" /></td>
        </tr>
        <tr >
          <td>Email: </td>
          <td><input name="customer_email" id="customer_email" value="<?php echo (empty($posted['customer_email'])) ? '' : $posted['customer_email']; ?>" /></td>
        </tr>
     
        <tr >
          <td>disclosure_url </td>
          <td colspan="3"><input name="disclosure_url" value="<?php echo (empty($posted['disclosure_url'])) ? '' : $posted['disclosure_url'] ?>" size="64" /></td>
        </tr>
        <tr >
          <td>redirect_url </td>
          <td colspan="3"><input name="redirect_url" value="<?php echo (empty($posted['redirect_url'])) ? '' : $posted['redirect_url'] ?>" size="64" /></td>
        </tr>


        <tr style="display:none;">
          <td><b>Optional Parameters</b></td>
        </tr>
        <tr style="display:none;">
          <td>Last Name: </td>
          <td><input name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" /></td>
          <td>Cancel URI: </td>
          <td><input name="curl" value="" /></td>
        </tr>
      
      
        <tr >
          <?php if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="Submit" /></td>
          <?php } ?>
        </tr>
      </table>
    </form>
    <script type="text/javascript">
	//document.knetForm.submit();
		</script>
  </body>
</html>