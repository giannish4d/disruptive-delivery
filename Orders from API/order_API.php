<?php


/******************* API Communication *********************************/


add_action( 'wp_ajax_run_getOrders', 'run_getOrders_callback' );
add_action( 'wp_ajax_nopriv_run_getOrders', 'run_geOrders_callback' );



function api_displayOrders($response){
	
	
	$data = json_decode($response);
	
	echo '<table class="minimalistBlack">';
	echo '<thead><th>ID</th><th>Send_date</th><th>Dimensions(X,Y,Z)</th><th>Sender Info</th><th>Receiver Info</th></thead>';
	
	//print orders in html table
	foreach ( $data->orders as $order ) {
		echo '<tr>';
		echo '<td>'.$order->id.'</td>'; 
        echo '<td>'.$order->send_date.'</td>';
        echo '<td>'.$order->x_in_mm.','.$order->y_in_mm.','.$order->z_in_mm.'</td>';
		echo '<td>'.$order->sender_info->name.'<br>'.$order->sender_info->street_and_number.'<br>'.$order->sender_info->zipcode.'<br>'.$order->sender_info->city.'<br>'.$order->sender_info->country.'<br>';
		echo '<td>'.$order->receiver_info->name.'<br>'.$order->receiver_info->street_and_number.'<br>'.$order->receiver_info->zipcode.'<br>'.$order->receiver_info->city.'<br>'.$order->receiver_info->country.'<br>';
		echo '</tr>';
	}
	echo '</table>';

}


function run_getOrders_callback(){

	$apiKey = '7NJF6nLLmX5xjdADYTY2';
	$url =   'https://pasd-webshop-api.onrender.com/api/order/';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'x-api-key: ' . $apiKey,
		'Content-Type: application/json',
	));
	


	$response = curl_exec($ch);
	$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if ($statusCode == 200) {
		api_displayOrders($response);
	} else {
		// Handle error
		echo "Error: " . $response;
	}

	curl_close($ch);
	
	wp_die();

}

?>


