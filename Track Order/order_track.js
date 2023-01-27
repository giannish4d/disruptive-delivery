/************************    HTML            *******************


<input type="text" id="txt_track"> 
<p>&nbsp;</p>
<input type="submit" name="btn_track" value="Click" class="button-54"> 



<div id="my-div"></div>


**************************************************************/




function reqOrderHistory(tracknum) {
	
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: {action: 'run_trackorder' ,track_num: tracknum},
		success: function(response) {
			var shortcode = document.getElementById("my-div");
			shortcode.innerHTML = response;
		}
	});
}


jQuery("input[name='btn_track']").click(function(event){
    var tracknum = document.getElementById("txt_track").value;
	if (!tracknum)
		alert("Please enter a tracking number")
	event.preventDefault();
    reqOrderHistory(tracknum);
	
    
});




