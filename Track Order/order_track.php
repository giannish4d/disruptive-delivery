<?


/*************** View order by tracking number *******************************/
add_action( 'wp_ajax_run_trackorder', 'run_trackorder_callback' );
add_action( 'wp_ajax_nopriv_run_trackorder', 'run_trackorder_callback' );


function displayDelivery($data){
	
	
	echo '<table class="minimalistBlack">';
	echo '<thead><th>Tracking Number</th><th>Dimensions(X,Y,Z)</th><th>Price</th><th>Expected Date</th><th>Sender Information</th><th>Receiver Information</th><th>Delivery Driver Name</th><th>Current Location</th></thead>';
	
	//print orders in html table
	echo '<tr>';
	echo '<td>'.$data[0]->deliveryid.'</td>'; 
	echo '<td>'.$data[0]->dimensions.'</td>';
	echo '<td>'.$data[0]->price.'</td>';
	echo '<td>'.$data[0]->expecteddate.'</td>';
	echo '<td>'.$data[0]->sndr_fullname.'<br>'
	.$data[0]->sndr_phoneno.'<br>'
	.$data[0]->sndr_street.'<br>'
	.$data[0]->sndr_zip.'<br>'
	.$data[0]->sndr_city.'<br>'
	.$data[0]->sndr_country.'<br></td>';
	echo '<td>'.$data[0]->rcvr_fullname.'<br>'
	.$data[0]->rcvr_phoneno.'<br>'
	.$data[0]->rcvr_street.'<br>'
	.$data[0]->rcvr_zip.'<br>'
	.$data[0]->rcvr_city.'<br>'
	.$data[0]->rcvr_country.'<br></td>';
	echo '<td>'.$data[0]->driver_name.'</td>';
	echo '<td>'.$data[0]->currentloc.'</td>';
	echo '</tr>';
	echo '</table>';

}


function queryDelivery($tracknum){
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
			

WHERE deliveryid=".$tracknum;
				
	return $wpdb->get_results($query, OBJECT );
	
	
	
}


function run_trackorder_callback(){
	

	$tracknum= $_REQUEST['track_num']; 
    $data = queryDelivery($tracknum);
	displayDelivery($data);

    wp_die();
}


?>