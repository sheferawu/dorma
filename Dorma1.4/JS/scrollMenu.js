/**
 * 
 */



function selectDorm(dorm){
	var dormNames = new Array ('NewDorm', 'MensDorm', 'WomensDorm', 'VetMedDorm', 'ACCIDorm');
	
	document.getElementById('dorm').value=dorm;
	
	for (i = 0; i < dormNames.length; i++){
		document.getElementById(dormNames[i]).style.opacity="";
		document.getElementById(dormNames[i]).style.border="0px rgb(43, 182, 211) solid";
	}
	
	document.getElementById(dorm).style.opacity="0.7";
	document.getElementById(dorm).style.border="2px rgb(43, 182, 211) solid";
	
}