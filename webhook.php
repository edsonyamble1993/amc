 <?php
 require_once('Stripe/init.php');
	require_once('Stripe/lib/Stripe.php');
	\Stripe\Stripe::setApiKey("sk_test_XfXCNhjeE9GbRFxQsEhytHDJ");

// Retrieve the request's body and parse it as JSON
$input = @file_get_contents("php://input");
$event_json = json_decode($input);

// Do something with $event_json
http_response_code(200);

$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters

// send email
$event_id = $event_json->id;

$event = \Stripe\Event::retrieve($event_id);

// This will send receipts on succesful invoices

if($event->type == 'customer.subscription.deleted'){

	mail("varun7king@gmail.com","My subject",$event->type." this is event");
	
}


?>