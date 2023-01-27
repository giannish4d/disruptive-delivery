/************************    HTML            **********************************************

<div class="myform">
    <label for="x_inmm">Dimensions: </label>
    <input type="text" id="input_x" name="x_inmm" placeholder="x..">
    <input type="text" id="input_y" name="y_inmm" placeholder="y..">
    <input type="text" id="input_z" name="z_inmm" placeholder="z..">

  
  <label for="txt_sender_fn">Sender Info: </label>
  <input type="text" id="txt_sender_fn" placeholder="Full name...">
  <input type="text" id="txt_sender_phone" placeholder="Phone Number...">
  <input type="text" id="txt_sender_streetandnum" placeholder="Street and Number...">
  <input type="text" id="txt_sender_zipcode" placeholder="Zipcode...">
  <input type="text" id="txt_sender_city" placeholder="City...">
  <input type="text" id="txt_sender_country" placeholder="Country...">

  

  <label for="txt_rec_fn">Recipient Info: </label>
  <input type="text" id="txt_rec_fn" placeholder="Full name...">
  <input type="text" id="txt_rec_phone" placeholder="Phone Number...">
  <input type="text" id="txt_rec_streetandnum" placeholder="Street and Number...">
  <input type="text" id="txt_rec_zipcode" placeholder="Zipcode...">
  <input type="text" id="txt_rec_city" placeholder="City...">
  <input type="text" id="txt_rec_country" placeholder="Country...">

<input type="submit" name="btn_createorder" value="Create Order" class="button-54"> 


</div>

********************************************************************************************/


function reqCreateDelivery(deliveryJSON) {
	
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: {action: 'run_createdelivery' ,data: deliveryJSON},
		success: function(response) {
			alert(response);
		}
	});
}


jQuery("input[name='btn_createorder']").click(function(event){
    
	const delivery = {
		x: document.getElementById("input_x").value,
		y: document.getElementById("input_y").value,
		z: document.getElementById("input_z").value,
		sender_info:{
    		fullname: document.getElementById("txt_sender_fn").value,
    		streetnumber: document.getElementById("txt_sender_streetandnum").value,
    		zipcode: document.getElementById("txt_sender_zipcode").value,
    		city: document.getElementById("txt_sender_city").value,
    		country: document.getElementById("txt_sender_country").value
		},
		receiver_info:{
    		fullname: document.getElementById("txt_rec_fn").value,
    		streetnumber: document.getElementById("txt_rec_streetandnum").value,
    		zipcode: document.getElementById("txt_rec_zipcode").value,
    		city: document.getElementById("txt_rec_city").value,
    		country: document.getElementById("txt_rec_country").value
		},
	}
	const deliveryJSON = JSON.stringify(delivery);	
	reqCreateDelivery(deliveryJSON);
	
    
});

