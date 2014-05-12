currentSolarSystem = "";
previousSolarSystem = "";

function checkSystem(){
	$.getJSON( "ajax/getLocation.php", function( data ) {
	  	var items = [];
	  	$.each( data, function( key, val ) {	    	
	    	currentSolarSystem = val;	    	
	  	});
	  	
	  	$( "#location" ).text(currentSolarSystem);
	  	
	  	$( ".locationSelect[name='from']" ).val(currentSolarSystem);
	  	
	  	if (previousSolarSystem == ""){
	  		previousSolarSystem = currentSolarSystem;
	  		if (window.console) console.log(previousSolarSystem);
	  	}else{
	  		if(previousSolarSystem != currentSolarSystem){
	  			
	  			$("#"+previousSolarSystem).hide();
	  			
	  			
	  			
	  			//alert("removed:"+previousSolarSystem);
	  			
	  			previousSolarSystem = currentSolarSystem;
	  		}
	  	}	  	
	  	
	});
}

window.setInterval(function(){
	checkSystem();
}, 5000);