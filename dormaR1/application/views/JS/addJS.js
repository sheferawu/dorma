var xmlHttp
var xmlHttp2

/**
 * Form validation for the Add Appliance form
 */

 
 
/* Remove (error) backgrounds of all date installed fields */
function resetError(applianceForm)
 {
		
		document.getElementById("radio_inst1").style.background = "";
		document.getElementById("radio_inst2").style.background = "";
		document.getElementById("radio_instS").style.background = "";
		document.getElementById("CP_inst1").style.background = "";
		document.getElementById("CP_inst2").style.background = "";
		document.getElementById("CP_instS").style.background = "";
		document.getElementById("comp_inst1").style.background = "";
		document.getElementById("comp_inst2").style.background = "";
		document.getElementById("comp_instS").style.background = "";
		document.getElementById("fan_inst1").style.background = "";
		document.getElementById("fan_inst2").style.background = "";
		document.getElementById("fan_instS").style.background = "";	
	
 }
 



function validateForm(residentForm)
{
	var proceed = true;
	
	with(residentForm)
	{
		if (lastname.value.trim() != "" && lastname.value.length <= 15)
			ln.innerHTML = "";
		else
		{
			ln.innerHTML = "Invalid last name";
			proceed = false;
		}
		
		if (firstname.value.trim() != "" && firstname.value.length <= 30)
			fn.innerHTML = "";
		else
		{
			fn.innerHTML = "Invalid first name";
			proceed = false;
		}
		
		if (middlename.value.trim() != "" && middlename.value.length <= 15)
			mn.innerHTML = "";
		else
		{
			mn.innerHTML = "Invalid middle name";
			proceed = false;
		}
		
		if (lastSchoolAttended.value.trim() != "" && lastSchoolAttended.value.length <= 50)
			lsa.innerHTML = "";
		else
		{
			lsa.innerHTML = "Invalid school name";
			proceed = false;
		}
		
		if (Religion.value.length <= 20)
			rel.innerHTML = "";
		else
		{
			rel.innerHTML = "Invalid religion";
			proceed = false;
		}
		
		if (StudNumber.value.trim() != "" && StudNumber.value.trim().length == 5 && !isNaN(StudNumber.value))
			std.innerHTML = "";
		else
		{
			std.innerHTML = "Invalid Student number";
			proceed = false;
		}
		
		if (Scholarship.value.length <= 20)
			scho.innerHTML = "";
		else
		{
			scho.innerHTML = "Invalid scholarship";
			proceed = false;
		}
		
		if (!isNaN(MonthlyStipend.value))
			stipend.innerHTML = "";
		else
		{
			stipend.innerHTML = "Invalid stipend";
			proceed = false;
		}
		
		if (Age.value.trim() != "" && !isNaN(Age.value))
			age.innerHTML = "";
		else
		{
			age.innerHTML = "Invalid age";
			proceed = false;
		}
		
		if (HomeAddress.value.trim() != "" && HomeAddress.value.length <= 50)
			ad.innerHTML = "";
		else
		{
			ad.innerHTML = "Invalid address";
			proceed = false;
		}
		
		if (TelephoneNumber.value.length != 15 && !isNaN(TelephoneNumber.value))
			tel.innerHTML = "";
		else
		{
			tel.innerHTML = "Invalid telephone number";
			proceed = false;
		}
		
		if (Email.value.trim() != "")
		{
			var atpos = Email.value.indexOf("@");
			var dotpos = Email.value.lastIndexOf(".");
			
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=Email.length || Email.value.length > 30){
				mail.innerHTML = "Not a valid e-mail address";
				proceed = false;
			}
			else
				mail.innerHTML = "";
		}
		else
			mail.innerHTML = "";

		if (HomeAddress.value.trim() != "" && HomeAddress.value.length <= 50)
			ad.innerHTML = "";
		else
		{
			ad.innerHTML = "Invalid address";
			proceed = false;
		}
		
		if (NumBrothers.value.trim() != "" && !isNaN(NumBrothers.value))
			bro.innerHTML = "";
		else
		{
			bro.innerHTML = "Invalid number";
			proceed = false;
		}
		
		if (NumSisters.value.trim() != "" && !isNaN(NumSisters.value))
			sis.innerHTML = "";
		else
		{
			sis.innerHTML = "Invalid number";
			proceed = false;
		}
		
		if (BirthOrder.value.trim() != "" && BirthOrder.value.length <= 15)
			bor.innerHTML = "";
		else
		{
			bor.innerHTML = "Invalid order";
			proceed = false;
		}
		
		if (Hobbies.value.length <= 30)
			hobby.innerHTML = "";
		else
		{
			hobby.innerHTML = "Invalid hobby(s)";
			proceed = false;
		}
		
		if (Honors.value.length <= 30)
			honor.innerHTML = "";
		else
		{
			honor.innerHTML = "Invalid honor(s)";
			proceed = false;
		}
		
		if (Ailments.value.length <= 30)
			ail.innerHTML = "";
		else
		{
			ail.innerHTML = "Invalid ailment(s)";
			proceed = false;
		}
		
		if (Medications.value.length <= 30)
			med.innerHTML = "";
		else
		{
			med.innerHTML = "Invalid ailment(s)";
			proceed = false;
		}
		
		if (cg1name.value.length <= 50)
			cg1.innerHTML = "";
		else
		{
			cg1.innerHTML = "Invalid name";
			proceed = false;
		}
		
		if (cg2name.value.length <= 50)
			cg2.innerHTML = "";
		else
		{
			cg2.innerHTML = "Invalid name";
			proceed = false;
		}
		
		if (cg1telno.value.length <= 11 && !isNaN(cg1telno.value))
			cg1telno.innerHTML = "";
		else
		{
			cg1tn.innerHTML = "Invalid number";
			proceed = false;
		}
		
		if (cg1add.value.length <= 50)
			cg1add.innerHTML = "";
		else
		{
			cg1a.innerHTML = "Invalid address";
			proceed = false;
		}
		
		if (cg2telno.value.length <= 11 && !isNaN(cg2telno.value))
			cg2telno.innerHTML = "";
		else
		{
			cg2tn.innerHTML = "Invalid number";
			proceed = false;
		}
		
		if (cg2add.value.length <= 50)
			cg2add.innerHTML = "";
		else
		{
			cg2a.innerHTML = "Invalid address";
			proceed = false;
		}
		
		if (cfname.value.length <= 50)
			cfn.innerHTML = "";
		else
		{
			cfn.innerHTML = "Invalid name";
			proceed = false;
		}
		
		if (cftelno.value.length <= 11 && !isNaN(cftelno.value))
			cftn.innerHTML = "";
		else
		{
			cftn.innerHTML = "Invalid number";
			proceed = false;
		}
		
		if ( cfadd.value.length <= 50)
			cfa.innerHTML = "";
		else
		{
			cfa.innerHTML = "Invalid address";
			proceed = false;
		}
		
		if ( cfemp.value.length <= 50)
			cfe.innerHTML = "";
		else
		{
			cfe.innerHTML = "Invalid input";
			proceed = false;
		}
		
		if ( cfincome.value.length <= 10)
			cfi.innerHTML = "";
		else
		{
			cfi.innerHTML = "Invalid input";
			proceed = false;
		}
		
		if (cmname.value.length <= 50)
			cmn.innerHTML = "";
		else
		{
			cmn.innerHTML = "Invalid name";
			proceed = false;
		}
		
		if (cmtelno.value.length <= 11 && !isNaN(cmtelno.value))
			cmtn.innerHTML = "";
		else
		{
			cmtn.innerHTML = "Invalid number";
			proceed = false;
		}
		
		if (cmadd.value.length <= 50)
			cma.innerHTML = "";
		else
		{
			cma.innerHTML = "Invalid address";
			proceed = false;
		}
		
		if (cmemp.value.length <= 50)
			cme.innerHTML = "";
		else
		{
			cme.innerHTML = "Invalid input";
			proceed = false;
		}
		
		if ( cmincome.value.length <= 10)
			cmi.innerHTML = "";
		else
		{
			cmi.innerHTML = "Invalid input";
			proceed = false;
		}
	if(document.getElementById("radio_ctr1")){
		if (radio_ctr1.value != "")
		{
			if (radio_inst1.value != "")
			{
				document.getElementById("radio_inst1").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("radio_inst1").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("radio_inst1").style.background = "";
		}
		
		if (radio_ctr2.value != "")
		{
			if (radio_inst2.value != "")
			{
				document.getElementById("radio_inst2").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("radio_inst2").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("radio_inst2").style.background = "";
		}
		
		if (radio_ctrS.value != "")
		{
			if (radio_instS.value != "")
			{
				document.getElementById("radio_instS").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("radio_instS").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("radio_instS").style.background = "";
		}
		
		/* --------------------------- Computer & Printer ----------------------------- */
		
		if (CP_ctr1.value != "")
		{
			if (CP_inst1.value != "")
			{
				document.getElementById("CP_inst1").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("CP_inst1").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("CP_inst1").style.background = "";
		}
		
		if (CP_ctr2.value != "")
		{
			if (CP_inst2.value != "")
			{
				document.getElementById("CP_inst2").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("CP_inst2").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("CP_inst2").style.background = "";
		}
		
		if (CP_ctrS.value != "")
		{
			if (CP_instS.value != "")
			{
				document.getElementById("CP_instS").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("CP_instS").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("CP_instS").style.background = "";
		}

		/* --------------------------- Computer ----------------------------- */
		
		if (comp_ctr1.value != "")
		{
			if (comp_inst1.value != "")
			{
				document.getElementById("comp_inst1").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("comp_inst1").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("comp_inst1").style.background = "";
		}
		
		if (comp_ctr2.value != "")
		{
			if (comp_inst2.value != "")
			{
				document.getElementById("comp_inst2").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("comp_inst2").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("comp_inst2").style.background = "";
		}
		
		if (comp_ctrS.value != "")
		{
			if (comp_instS.value != "")
			{
				document.getElementById("comp_instS").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("comp_instS").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("comp_instS").style.background = "";
		}
		
		
		/* ------------------- FAN ---------------------- */
		
		if (fan_ctr1.value != "")
		{
			if (fan_inst1.value != "")
			{
				document.getElementById("fan_inst1").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("fan_inst1").style.background = "lightsalmon";
				
			}
		}
		else
		{
			document.getElementById("fan_inst1").style.background = "";
		}
		
		if (fan_ctr2.value != "")
		{
			if (fan_inst2.value != "")
			{
				document.getElementById("CP_inst2").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("fan_inst2").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("fan_inst2").style.background = "";
		}
		
		if (fan_ctrS.value != "")
		{
			if (fan_instS.value != "")
			{
				document.getElementById("fan_instS").style.background = "";
			}
			else
			{
				proceed = false;
				document.getElementById("fan_instS").style.background = "lightsalmon";
			}
		}
		else
		{
			document.getElementById("fan_instS").style.background = "";
		}

	}
}
	
	return proceed;
}



function getCourse(value){
	if(value=="CA"){
		document.getElementById('courses').innerHTML =
			'CA Course'+
			'<select name="course">'+
			'<option value="BSA" >BSA</option>'+
			'<option value="BSFT" >BSFT</option>'+
			'<option value="BSAGCHEM">BSAGCHEM</option></select>';
	}else if(value=="CAS"){
		document.getElementById('courses').innerHTML = 
			'CAS Course'+
			'<select name="course">'+
			'<option value="BACOMARTS" >BACOMARTS</option>'+
			'<option value="BASOCIO" >BASOCIO</option>'+
			'<option value="BAPHILO" >BAPHILO</option>'+
			'<option value="BSAMAT" >BSAMAT</option>'+
			'<option value="BSAPHY" >BSAPHY</option>'+
			'<option value="BSBIO" >BSBIO</option>'+
			'<option value="BSCHEM" >BSCHEM</option>'+
			'<option value="BSCOMSCI">BSCOMSCI</option>'+
			'<option value="BSMAT" >BSMAT</option>'+
			'<option value="BSMST" >BSMST</option>'+
			'<option value="BSSTAT" >BSSTAT</option>'+
			'</select>';
	}else if(value=="CDC"){
		document.getElementById('courses').innerHTML = 
			'CDC Course'+
			'<select name="course">'+
			'<option value="BSDC">BSDC</option>'+
			'</select>';
	}else if(value=="CEM"){
		document.getElementById('courses').innerHTML = 
			'CEM Course'+
			'<select name="course">'+
			'<option value="BSAGMGMT">BSAGMGMT</option>'+
			'<option value="BSAGECON">BSAGECON</option>'+
			'<option value="BSECON">BSECON</option>'+
			'</select>';
	}else if(value=="CEAT"){
		document.getElementById('courses').innerHTML = 
			'CEAT Course'+
			'<select name="course">'+
			'<option value="BSAGENG">BSAGENG</option>'+
			'<option value="BSCHEMENG">BSCHEMENG</option>'+
			'<option value="BSCE">BSCE</option>'+
			'<option value="BSEE">BSEE</option>'+
			'<option value="BSIE">BSIE</option>'+
			'</select>';
	}else if(value=="CFNR"){
		document.getElementById('courses').innerHTML = 
			'CFNR Course'+
			'<select name="course">'+
			'<option value="BSFORESTRY">BSFORESTRY</option>'+
			'</select>';
	}else if(value=="CHE"){
		document.getElementById('courses').innerHTML = 
			'CHE Course'+
			'<select name="course">'+
			'<option value="BSHE">BSHE</option>'+
			'<option value="BSN">BSN</option>'+
			'</select>';
	}else if(value=="CVM"){
		document.getElementById('courses').innerHTML = 
			'CVM Course'+
			'<select name="course">'+
			'<option value="VM">VM</option>'+
			'</select>';
	}
}


function setBatch(batch){
	
	if (batch.length==0)
	  { 
		document.getElementById("stfap").innerHTML="";
		  
	  return;	  
	 }
	
	if(batch>2006){
		
		document.getElementById('stfap').innerHTML = 
			'<select name="STFAPBracket">'+
			'<option value="A">A</option>'+
			'<option value="B">B</option>'+
			'<option value="C">C</option>'+
			'<option value="D">D</option>'+
			'<option value="E1">E1</option>'+
			'<option value="E2">E2</option>' +
			'</select>';
		
	}else{
		
		document.getElementById('stfap').innerHTML = 
			'<select name="STFAPBracket">'+
			'<option value="1">1</option>'+
			'<option value="2">2</option>'+
			'<option value="3">3</option>'+
			'<option value="4">4</option>'+
			'<option value="5a">5a</option>'+
			'<option value="5b">5b</option>' +
			'</select>';
	}

	
}
function getMonth(month)
{
var str="";	
var bool =0;
	if (month.length==0)
  	{ 
	document.getElementById("Day").innerHTML="";
  document.getElementById("Year").innerHTML="";
  
  	return;
  	}
	if(month=="Jan"||month=="Mar"||month=="May"||month=="Jul"||month=="Aug"||month=="Oct"||month=="Dec")
	{
	str= returnOpt(1,31);
	}else{
		
		if(month=="Apr"||month=="Jun"||month=="Sep"||month=="Nov"){
			
			str =  returnOpt(1,30);//30 days
		}else{
		if(month=="Feb"){
			
			str = returnOpt(1,28);//28 days
		}else{
			bool = 1;
			str = '<option value ="">Day</option>'
		}
		}
	}

document.getElementById("Day").innerHTML='<select name="Day" >'+str+'</select>';
if(bool==0){
document.getElementById("Year").innerHTML='<select name="Year" >'+returnOpt(1950,2011)+'</select>';
}else{
	
document.getElementById("Year").innerHTML='<select name="Year" ><option value="">Year</select>';
	
}
	  

}

function returnOpt(s,e){
	
	var i = s;
	var str ="";
	for(i=s;i<=e;i++){
		
		str+='<option value= "'+i+'">'+i+'</option>';
	}
	return str;
	
}
function stateChanged() 
{ 
if (xmlHttp.readyState==4)
{ 
document.getElementById("Day").innerHTML=xmlHttp.responseText;
}
}


function stateChanged2() 
{ 
if (xmlHttp2.readyState==4)
{ 
document.getElementById("Year").innerHTML=xmlHttp2.responseText;
}
}



function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}

