/**
 * 
 */



function selectDorm(dorm,dormNames2){
	var dormNames = dormNames2.split("@");

	document.getElementById('dorm').value=dorm;
	
	for (i = 0; i < dormNames.length; i++){
		document.getElementById(dormNames[i]).style.opacity="";
		document.getElementById(dormNames[i]).style.borderColor="#d9d9d9";
	}
	
	
	document.getElementById(dorm).style.borderColor = "rgb(43, 182, 211)";
	
}