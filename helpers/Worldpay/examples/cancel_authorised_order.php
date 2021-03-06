
<?php
/**
 * PHP library version: v1.6
 */
require_once('../lib/worldpay.php');

// Initialise Worldpay class with your SERVICE KEY
$worldpay = new Worldpay("your-service-key");

// Sometimes your SSL doesnt validate locally
// DONT USE IN PRODUCTION
$worldpay->disableSSLCheck(true);

$worldpayOrderCode = $_POST['orderCode'];

include("header.php");

// Try catch
try {
    // Cancel the authorised order using the Worldpay order code
    $worldpay->cancelAuthorisedOrder($worldpayOrderCode);
    echo 'Authorised order <span id="order-code">'.$worldpayOrderCode.'</span>
        has been cancelled';
} catch (WorldpayException $e) { // PHP 5.3+
    // Worldpay has thrown an exception
    echo 'Error code: ' . $e->getCustomCode() . '<br/> 
    HTTP status code:' . $e->getHttpStatusCode() . '<br/> 
    Error description: ' . $e->getDescription()  . ' <br/>
    Error message: ' . $e->getMessage();
} catch (Exception $e) {  // PHP 5.2 
    echo 'Error message: '. $e->getMessage();
}
