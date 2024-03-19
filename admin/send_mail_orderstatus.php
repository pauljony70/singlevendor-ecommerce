<?php


function send_mail($emailid, $subjectmsg, $bodymsg){
   $phone =  stripslashes($phone); 
//   echo " sms to ". $phone ." msg --".$action ;
   
    if(isset($emailid) && !empty($subjectmsg)  ) {

    	    $to      = $emailid;           
            $subject = $subjectmsg;
            $message = $bodymsg;               
            $headers = 'From: support@mkkirana.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            
            	mail($to, $subject, $message, $headers);
    
        
    }
}


?>