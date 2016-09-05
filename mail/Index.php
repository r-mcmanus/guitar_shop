<?php
require_once('../util/main.php');

require_once('model/customer_db.php');
require_once('model/address_db.php');
require_once('model/order_db.php');
require_once('model/product_db.php');

function sendEmail($order_id) {

    // replace XXXXX with appropriate information
    require_once('class.PHPMailer.php');

    set_time_limit(0);
    
    $destination = $_SESSION['user']['emailAddress'];
    $customer_name = $_SESSION['user']['firstName'] . ' ' .
                     $_SESSION['user']['lastName'];

    ob_start();                      // start capturing output
    include('message.php');   // execute the file
    $messageHTML = ob_get_contents();    // get the contents from the buffer
    ob_end_clean();  
    

    $message =  ' This is information that will not be HTML friendly for Emails that do not support HTML';


    $email = new PHPMailer();

    $email->IsSMTP();

    // The XXXXXXXX in the following will need to be adjusted as with Host if not using gmail
    // $email->IsSendmail();
    $email->Host       = "smtp.gmail.com";   //Will need to be modified
    $email->SMTPAuth   = true;  
    // $email->Port       = 465;                // The PORTS will vary
    $email->Port       = 587;
    $email->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)  
    $email->SMTPSecure = 'tls';            // ssl is most recent but may need tls 
    // $email->SMTPSecure = 'ssl';    
    $email->Username   = "guitarshop2016@gmail.com"; // SMTP account username Will need to be modified
    $email->Password   = "0yhegzinYZdA";        // SMTP account password Will need to be modified
    $email->SetFrom('guitarshop2016@gmail.com', 'Guitar Shop');  //Will need to be modified – identifies email of sender
    // $email->MsgHTML($message);
    $email->SingleTo  = true;	// true allows that only one person will receive an email per array group
    $email->From      = 'guitarshop2016@gmail.com'; //Will need to be modified – identifies email of sender
    $email->FromName  = 'Guitar Shop'; //Will need to be modified – identifies email of sender
    $email->Subject   = 'Order Confirmation #' . $order_id; // appears in subject of email
    $email->Body      = $messageHTML ;  // the body will interpret HTML - $messageHTML identified above
    $email->AltBody = $message;            // the AltBody will not interpret HTML - $message identified above
    $destination_email_address = $destination; // Destination address
    $destination_user_name = $customer_name; // Destination name

    // $email->AddAddress( 'xxxx@xxxx.xxx' );

    //$file_to_attach = 'images.pdf';  // Used if you want attachments to email - This is the name of your attachment file.
                                     // File has to be located in same folder as index.php
    //$email->AddAttachment( $file_to_attach ); // Used if you want attachments to email

    //$email->AddAddress($this->$destination_email_address, $destination_user_name); 
    $email->AddAddress($destination_email_address, $destination_user_name);
    // AddAddress method identifies destination and sends email	
    if(!$email->Send()) {
        echo "Mailer Error: " . $email->ErrorInfo;
    }
  
	
}

?>
