<?


/******************** View Delivery Driver's Assigned Orders **************/


function displayDeliveryDR($data){
	
	
	echo '<table class="minimalistBlack">';
	
	//Table header
	echo '<thead><th>Tracking Number</th><th>Dimensions(X,Y,Z)</th><th>Price</th><th>Expected Date</th><th>Sender Information</th><th>Receiver Information</th><th>Delivery Driver Name</th><th>Current Location</th></thead>';
	
	//print orders in html table
	foreach ($data as $row){
	echo '<tr>';
		echo '<td>'.$row->deliveryid.'</td>'; 
		echo '<td>'.$row->dimensions.'</td>';
		echo '<td>'.$row->price.'</td>';
		echo '<td>'.$row->expecteddate.'</td>';
		echo '<td>'.$row->sndr_fullname.'<br>'
		.$row->sndr_phoneno.'<br>'
		.$row->sndr_street.'<br>'
		.$row->sndr_zip.'<br>'
		.$row->sndr_city.'<br>'
		.$row->sndr_country.'<br></td>';
		echo '<td>'.$row->rcvr_fullname.'<br>'
		.$row->rcvr_phoneno.'<br>'
		.$row->rcvr_street.'<br>'
		.$row->rcvr_zip.'<br>'
		.$row->rcvr_city.'<br>'
		.$row->rcvr_country.'<br></td>';
		echo '<td>'.$row->driver_name.'</td>';
		echo '<td>'.$row->currentloc.'</td>';
	
		echo '</tr>';
	}
	echo '</table>';

}
add_action( 'wp_ajax_run_viewdrivorders', 'run_viewdrivorders_callback' );
add_action( 'wp_ajax_nopriv_run_viewdrivorders', 'run_viewdrivorders_callback' );

function queryDeliveryDR(){
	global $wpdb;
	$query="SELECT 	del.deliveryid,del.dimensions,del.price,del.status,del.expecteddate,del.currentloc,
		sender.fullname AS sndr_fullname, sender.phoneno AS sndr_phoneno,
		receiver.fullname AS rcvr_fullname, receiver.phoneno AS rcvr_phoneno,
		SENDERaddr.street AS sndr_street, SENDERaddr.zipcode AS sndr_zip, SENDERaddr.city AS sndr_city, SENDERaddr.country AS sndr_country,
		RECaddr.street AS rcvr_street, RECaddr.zipcode AS rcvr_zip, RECaddr.city AS rcvr_city, RECaddr.country AS rcvr_country,
		DelDriver.fullname AS driver_name

FROM 	delivery AS del 
			INNER JOIN peersinfo as sender 
				ON del.senderid = sender.peerid 
			INNER JOIN address as SENDERaddr
				ON sender.address = SENDERaddr.addressid
			INNER JOIN peersinfo as receiver 
				ON del.receiverid = receiver.peerid
			INNER JOIN address as RECaddr
				ON receiver.address = RECaddr.addressid 
			INNER JOIN deliverydrivers as DelDriver
				ON del.driverid = DelDriver.driverid
			

WHERE DelDriver.driverid=".get_current_user_id();
				
	return $wpdb->get_results($query, OBJECT );
	
}

function run_viewdrivorders_callback(){
	$data = queryDeliveryDR();
	displayDeliveryDR($data);
	wp_die();
	
}


?>