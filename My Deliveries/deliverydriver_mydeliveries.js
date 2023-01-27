/************************    HTML            *******************


<div id="my-div"></div>


**************************************************************/



function reqDeliveryOrders(tracknum) {
	
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: {action: 'run_viewdrivorders'},
		success: function(response) {
			var shortcode = document.getElementById("my-div");
			shortcode.innerHTML = response;
		}
	});
}


jQuery(document).ready(function(jQuery){
	//event.preventDefault();
	reqDeliveryOrders();
});


