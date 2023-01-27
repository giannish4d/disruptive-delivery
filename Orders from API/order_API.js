/************************    HTML            *******************


<input type="submit" name="btn_track" value="GET" class="button-54"> 

<div id="my-div"></div>


**************************************************************/

function reqAPIOrders() {
	
	jQuery.ajax({
		type: "GET",
		url: ajaxurl,
		data: {action: 'run_getOrders'},
		success: function(response) {
			var shortcode = document.getElementById("my-div");
			shortcode.innerHTML = response;
		}
	});
}


jQuery("input[name='btn_track']").click(function(event){
	event.preventDefault();
    reqAPIOrders();
	
    
});

