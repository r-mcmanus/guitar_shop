<?php
require_once('../util/main.php');

require_once('model/customer_db.php');
require_once('model/address_db.php');
require_once('model/order_db.php');
require_once('model/product_db.php');

function send_email($order_id) {

    require_once('class.PHPMailer.php');

    set_time_limit(0);
    
    $destination = $_SESSION['user']['emailAddress'];
    $customer_name = $_SESSION['user']['firstName'] . ' ' .
                     $_SESSION['user']['lastName'];

    ob_start();                          // start capturing output
    include('message.php');              // execute the file
    $messageHTML = ob_get_contents();    // get the contents from the buffer
    ob_end_clean();  
    

    $message =  ' This is information that will not be HTML friendly for Emails that do not support HTML';


    $email = new PHPMailer();

    $email->IsSMTP();

    $email->Host       = "smtp.gmail.com";
    $email->SMTPAuth   = true;  
    // $email->Port       = 465;           // The PORTS will vary
    $email->Port       = 587;
    $email->SMTPDebug  = 1;                // enables SMTP debug information (for testing)  
    $email->SMTPSecure = 'tls';            // ssl is most recent but may need tls 
    // $email->SMTPSecure = 'ssl';    
    $email->Username   = "guitarshop2016@gmail.com"; 
    $email->Password   = "yz6N0bgk3mX0";             // This is not the actual password of the account
    $email->SetFrom('guitarshop2016@gmail.com', 'Guitar Shop'); 
    // $email->MsgHTML($message);
    $email->SingleTo  = true;	// true allows that only one person will receive an email per array group
    $email->From      = 'guitarshop2016@gmail.com'; 
    $email->FromName  = 'Guitar Shop'; 
    $email->Subject   = 'Order Confirmation #' . $order_id; 
    $email->Body      = $messageHTML ;     // the body will interpret HTML - $messageHTML identified above
    $email->AltBody = $message;            // the AltBody will not interpret HTML - $message identified above
    $destination_email_address = $destination; 
    $destination_user_name = $customer_name; 

    $email->AddAddress($destination_email_address, $destination_user_name);
    // AddAddress method identifies destination and sends email	
    
    if(!$email->Send()) {
        echo "Mailer Error: " . $email->ErrorInfo;
    }
  
	
}

?>
