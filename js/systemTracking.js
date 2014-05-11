currentSolarSystem = "";
previousSolarSystem = "";

function checkSystem(){
	$.getJSON( "ajax/getLocation.php", function( data ) {
	  	var items = [];
	  	$.each( data, function( key, val ) {	    	
	    	currentSolarSystem = val;	    	
	  	});
	  	
	  	if (previousSolarSystem == ""){
	  		previousSolarSystem = currentSolarSystem;
	  		if (window.console) console.log(previousSolarSystem);
	  	}else{
	  		if(previousSolarSystem != currentSolarSystem){
	  			
	  			$("#"+previousSolarSystem).hide()
	  			
	  			$( "#location" ).text(currentSolarSystem);
	  			
	  			//alert("removed:"+previousSolarSystem);
	  			
	  			previousSolarSystem = currentSolarSystem;
	  		}
	  	}	  	
	  	
	});
}

window.setInterval(function(){
	checkSystem();
}, 5000);