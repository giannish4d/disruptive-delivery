<?php

/******************** Create Delivery in Database *********************/
add_action( 'wp_ajax_run_createdelivery', 'run_createdelivery_callback' );
add_action( 'wp_ajax_nopriv_run_createdelivery', 'run_createdelivery_callback' );



function insertOrderDB($data){
	global $wpdb;
	
	//Insert sender address info
	$wpdb->insert('address', array(
		'street' => $data->sender_info->streetnumber,
		'zipcode' => $data->sender_info->zipcode,
		'city'   => $data->sender_info->city,
		'country' => $data->sender_info->country
	));
	//Get inserted address' id
	$addrid_sender = $wpdb->get_results("SELECT * FROM address ORDER BY addressid DESC LIMIT 1", OBJECT );
	
	// " receiver " "
	$wpdb->insert('address', array(
	'street' => $data->receiver_info->streetnumber,
	'zipcode' => $data->receiver_info->zipcode,
	'city'   => $data->receiver_info->city,
	'country' => $data->receiver_info->country
	));
	// "    "     receiver' id
	$addrid_rec = $wpdb->get_results("SELECT addressid FROM address ORDER BY addressid DESC LIMIT 1", OBJECT );
	
	
	//Insert sender info
	$wpdb->insert('peersinfo', array(
    'fullname' => $data->sender_info->fullname,
    'address' => $addrid_sender[0]->addressid,
	));
	//Get inserted sender id
	$peerid_sender=$wpdb->get_results("SELECT peerid FROM peersinfo ORDER BY peerid DESC LIMIT 1", OBJECT);
	
	
	//Insert receiver info
	$wpdb->insert('peersinfo', array(
    'fullname' => $data->receiver_info->fullname,
    'address' => $addrid_rec[0]->addressid,
	));
	//Get inserted receiver id
	$peerid_rec=$wpdb->get_results("SELECT peerid FROM peersinfo ORDER BY peerid DESC LIMIT 1", OBJECT);
	
	
	//Pick a random delivery person with a status 1 (=Available)
	$randomdriver =$wpdb->get_results("SELECT driverid FROM deliverydrivers WHERE status=1 ORDER BY RAND() LIMIT 1", OBJECT);
	
	
	//Create delivery 
	$date=date("Y-m-d H:i:s");
	
	
	$wpdb->insert('delivery', array(
	'senderid' => $peerid_sender[0]->peerid,
	'receiverid' => $peerid_rec[0]->peerid,
	'dimensions' => $data->x.' , '.$data->y.' , '.$data->z,
	'price' => 15,
	'status' => "EXP",
	'driverid' =>$randomdriver[0]->driverid,
	'expecteddate' => date("Y-m-d",strtotime($txt. ' + 2 days'))
	));	
	
}


function run_createdelivery_callback(){
	$jsondata= $_REQUEST['data']; 
	$data = json_decode(stripslashes($jsondata));
	insertOrderDB($data);
	wp_die();
}

?>
