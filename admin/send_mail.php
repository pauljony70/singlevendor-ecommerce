<?php

//$bodymsg =" your order palce";
// send_mail( "kamal.bunkar07@gmail.com", "test email ", "Placed" , $bodymsg, "16-11-2022",  123456789, "200", "4", "4", "10", "218 " );  
    
function send_mail($emailid, $subjectmsg, $status, $bodymsg, $date, $orderid, $price, $cgst, $sgst, $ship, $total){
 
 //  $phone =  stripslashes($phone); 
  
    if(isset($emailid) && !empty($subjectmsg)  ) {

    	    $to      = $emailid;            
            $subject = $subjectmsg;
          //  $message = $bodymsg;               
            $headers = 'From: support@mkkirana.com' . "\r\n" .'Content-type: text/html; charset=iso-8859-1'."\r\n". 'X-Mailer: PHP/' . phpversion();
            $variables = array();
            
            $variables['status'] = $status;
            $variables['bodymsg'] = $bodymsg;
            $variables['date'] = $date;
            $variables['orderid'] = $orderid;
            $variables['price'] = $price;
            $variables['cgst'] = $cgst;
            $variables['sgst'] = $sgst;
            $variables['shipping'] = $ship;
            $variables['total'] = $total;
                
            $template = file_get_contents("../admin/send_mail_templet.html");
            
            foreach($variables as $key => $value)
            {
                $template = str_replace('{{ '.$key.' }}', $value, $template);
            }
            
            $message=  $template;        
            echo " *** main *** ".  $message;
            mail($to, $subject, $message, $headers);
    
        
    }
}


?>