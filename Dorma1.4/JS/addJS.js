var xmlHttp;
var xmlHttp2;

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

function validateEditWorkloadForm(form){
	var proceed = true;
	var table = document.getElementById('workList'),rows;
	
	with(form){
		
		if(table && (rows = table.rows)) {
			for(var i = 0, n = rows.length - 1; i < n; i++) {
				specWork = eval("specWork".concat(i));
				manpower = eval("manpower".concat(i));
				stat = eval("status".concat(i));
				startMonth = eval("startMonth".concat(i));
				compMonth = eval("compMonth".concat(i));
				remarks = eval("remarks".concat(i));
				
				if (specWork.value.trim().toUpperCase() != "" && specWork.value.trim().length <= 20)
					document.getElementById("specWork".concat(i)).style.background="white";
				else{
					document.getElementById("specWork".concat(i)).style.background="#FCBBBB";
					proceed = false;
				}
				
				if (manpower.value.trim().toUpperCase() != "" && manpower.value.trim().length <= 100)
					document.getElementById("manpower".concat(i)).style.background="white";
				else{
					document.getElementById("manpower".concat(i)).style.background="#FCBBBB";
					proceed = false;
				}
				
				if (stat.value.trim() != "" && stat.value.length <= 128)
					document.getElementById("status".concat(i)).style.background="white";
				else
				{
					document.getElementById("status".concat(i)).style.background="#FCBBBB";
					proceed = false;
				}
				
				if (startMonth.value != "0")	{
					document.getElementById("startMonth".concat(i)).style.color="black";
				
				}else
				{
					document.getElementById("startMonth".concat(i)).style.color ="red";
					proceed = false;
				}
				
				if (remarks.value.length <= 20)
					document.getElementById("remarks".concat(i)).style.background="white";
				else
				{
					document.getElementById("remarks".concat(i)).style.background="#FCBBBB";
					proceed = false;
				}
				
			}
		}
	}
	
	return proceed;
}

function validateWorkloadForm(projectForm){
	var proceed = true;
	
	with(projectForm){
		if (specWork.value.trim() != "" && specWork.value.length <= 20)
			document.getElementById("specWork").style.background="white";
		else
		{
			document.getElementById("specWork").style.background="#FCBBBB";
			proceed = false;
		}
		
		if (manpower.value.trim() != "" && manpower.value.length <= 100)
			document.getElementById("manpower").style.background="white";
		else
		{
			document.getElementById("manpower").style.background="#FCBBBB";
			proceed = false;
		}
		
		if (status.value.trim() != "" && status.value.length <= 128)
			document.getElementById("status").style.background="white";
		else
		{
			document.getElementById("status").style.background="#FCBBBB";
			proceed = false;
		}
		
		if (startMonth.value != "0")	{
			document.getElementById("startMonth").style.color="black";
		
		}else
		{
			document.getElementById("startMonth").style.color ="salmon";
			proceed = false;
		}
		
	}
	
	return proceed;
}

 function validateTransForm(transientForm){
	var proceed = true;
		
	with(transientForm){
		if (ControlNum.value.trim() != "" && ControlNum.value.length <= 20)
			cno.innerHTML = "";
		else
		{
			cno.innerHTML = "Invalid cntrol number";
			proceed = false;
		}
		
		if (Date.value.trim() != "" && Date.value.length <= 20)
			date.innerHTML = "";
		else
		{
			date.innerHTML = "Invalid date";
			proceed = false;
		}
		
		if (lastname.value.trim() != "" && lastname.value.length <= 30)
			ln.innerHTML = "";
		else
		{
			ln.innerHTML = "Invalid last name";
			proceed = false;
		}
		
		if (firstname.value.trim() != "" && firstname.value.length <= 50)
			fn.innerHTML = "";
		else
		{
			fn.innerHTML = "Invalid first name";
			proceed = false;
		}
		
		if (middlename.value.trim() != "" && middlename.value.length <= 30)
			mn.innerHTML = "";
		else
		{
			mn.innerHTML = "Invalid middle name";
			proceed = false;
		}
		
		if (purpose.value.length <= 100)
			purpose.innerHTML = "";
		else
		{
			purpose.innerHTML = "Purpose too long";
			proceed = false;
		}
		
		if (Emergency.value.length <= 60)
			emergency.innerHTML = "";
		else
		{
			emergency.innerHTML = "Name too long";
			proceed = false;
		}
		
		if (dormName.value.trim() != "" && dormName.value.length <= 60)
			dorm.innerHTML = "";
		else
		{
			dorm.innerHTML = "Invalid dorm name";
			proceed = false;
		}
		
		if (tcheckin.value.length <= 20)
			tin.innerHTML = "";
		else
		{
			tin.innerHTML = "Invalid time";
			proceed = false;
		}
		
		if (tcheckout.value.length <= 20)
			tout.innerHTML = "";
		else
		{
			tout.innerHTML = "Invalid time";
			proceed = false;
		}
		
		if (roomassign.value.trim() != "" && roomassign.value.length <= 10)
			room.innerHTML = "";
		else
		{
			room.innerHTML = "Room number";
			proceed = false;
		}
		
		if (amount.value.trim() != "" && amount.value.length <= 30 && !isNan(amount.value.trim()))
			amnt.innerHTML = "";
		else
		{
			amnt.innerHTML = "Invalid amount";
			proceed = false;
		}
		
		if (ornum.value.trim() != "" && ornum.value.length <= 10)
			or.innerHTML = "";
		else
		{
			or.innerHTML = "OR number";
			proceed = false;
		}
		
		if (guarantor.value.length <= 120)
			grt.innerHTML = "";
		else
		{
			grt.innerHTML = "Invalid Name";
			proceed = false;
		}
		if(document.getElementById("nrf")){
			grt.innerHTML = "Invalid Name";
			proceed = false;
		
		}
		return proceed;
	}	
}

function validateForm(residentForm)
{	
	var proceed = true;
	
	var table = document.getElementById('app'),rows;
	var row = "";
	var cnum = "";
	var date = "";
	
	
	var tbl = document.getElementById('app');
	
	var lastRow = tbl.rows.length;
	var iteration = lastRow;
	var xmlHttp5=GetXmlHttpObject();
	if (xmlHttp5==null){
		  alert ("Your browser does not support AJAX!");
		  return;
		  }
		var url="index.php?c=resident&m=setNumApp";
		url=url+"&numapp="+iteration;
		xmlHttp5.open("GET",url,true);
		xmlHttp5.send(null);
	
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

		if (Month.value.trim().toUpperCase() != "0")
			bday.innerHTML = "";
		else
		{
			bday.innerHTML = "Please select a month";
			proceed = false;
		}
		
		
		if (middlename.value.trim() != "" && middlename.value.length <= 15)
			mn.innerHTML = "";
		else
		{
			mn.innerHTML = "Invalid middle name";
			proceed = false;
		}
		
		if (/*lastSchoolAttended.value.trim() != "" &&*/lastSchoolAttended.value.length <= 50)
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
		
		if (!isNaN(MonthlyStipend.value) && MonthlyStipend.value.length <= 6)
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
		
		if (HomeAddress.value.trim() != "" && HomeAddress.value.length <= 200)
			ad.innerHTML = "";
		else
		{
			ad.innerHTML = "Invalid address";
			proceed = false;
		}
		
		if (TelephoneNumber.value.length <= 15)
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
		
		if (!isNaN(NumBrothers.value))
			bro.innerHTML = "";
		else
		{
			bro.innerHTML = "Invalid number";
			proceed = false;
		}
		
		if (!isNaN(NumSisters.value))
			sis.innerHTML = "";
		else
		{
			sis.innerHTML = "Invalid number";
			proceed = false;
		}
		
		if (BirthOrder.value.length <= 15)
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
		
		if (cg1add.value.length <= 100)
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
		
		if (cg2add.value.length <= 100)
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
		
		if ( cfadd.value.length <= 100)
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
		
		if (cmadd.value.length <= 100)
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
		
		/* Validate dynamically added appliance */
		
		if(table && (rows = table.rows)) {
			for(var i = 0, n = rows.length - 1; i < n; i++) {
				
				row = eval("ApplianceName".concat(i));
				cnum = eval("controlNum".concat(i));
				month = eval("dateInstalledMonth".concat(i));
				
				if (row.value.trim().toUpperCase() != "NONE"){
					if (cnum.value != "" && cnum.value.length <= 10 && !isNaN(cnum.value))	
						document.getElementById("controlNum".concat(i)).style.background="white";
					else
					{
						document.getElementById("controlNum".concat(i)).style.background="#FCBBBB";
						proceed = false;
					}
					
					if (month.value != "0")	{
						document.getElementById("dateInstalledMonth".concat(i)).style.color="black";
					
					}else
					{
						document.getElementById("dateInstalledMonth".concat(i)).style.color ="salmon";
						
						proceed = false;
					}
					
				}
				else{
					document.getElementById("controlNum".concat(i)).style.background="white";
					document.getElementById("dateInstalledMonth".concat(i)).style.background="white";
				}
				
			}
		}
		
		/* Validate Log Info */
		
		if (MonthLI1.value.trim().toUpperCase() != "0")
			document.getElementById("MonthLI1").style.color="black";
		else
		{
			document.getElementById("MonthLI1").style.color="salmon";
			proceed = false;
		}

		/*if (MonthLI2.value.trim().toUpperCase() != "0")
			document.getElementById("MonthLI2").style.color="black";
		else
		{
			document.getElementById("MonthLI2").style.color="salmon";
			proceed = false;
		}*/
		
		if (form5.value.length <= 15)
			document.getElementById("form5").style.background="white";
		else
		{
			document.getElementById("form5").style.background="#FCBBBB";
			proceed = false;
		}
		
		if (room.value != "" && room.value.length <= 4)
			document.getElementById("room").style.background="white";
		else
		{
			document.getElementById("room").style.background="#FCBBBB";
			proceed = false;
		}
		
		/* Validate Reservation */
				
		if (OrNum.value != "" && OrNum.value.length <= 15)
			document.getElementById("OrNum").style.background="white";
		else
		{
			document.getElementById("OrNum").style.background="#FCBBBB";
			proceed = false;
		}
		
		if (MonthR.value.trim().toUpperCase() != "0")
			document.getElementById("MonthR").style.color="black";
		else
		{
			document.getElementById("MonthR").style.color="salmon";
			proceed = false;
		}
		
		if (Amount.value != "" && Amount.value.length <= 11 && !isNaN(Amount.value))
			document.getElementById("Amount").style.background="white";
		else
		{
			document.getElementById("Amount").style.background="#FCBBBB";
			proceed = false;
		}

		if (Remarks.value.length <= 30)
			document.getElementById("Remarks").style.background="white";
		else
		{
			document.getElementById("Remarks").style.background="#FCBBBB";
			proceed = false;
		}
	
		
		/* Validate Key */
				
		if (OrNumKey.value != "" && OrNumKey.value.length <= 15)
			document.getElementById("OrNumKey").style.background="white";
		else
		{
			document.getElementById("OrNumKey").style.background="#FCBBBB";
			proceed = false;
		}
		
		if (MonthRec.value.trim().toUpperCase() != "0")
			document.getElementById("MonthRec").style.color="black";
		else
		{
			document.getElementById("MonthRec").style.color="salmon";
			proceed = false;
		}
		
		/*if (MonthRet.value.trim().toUpperCase() != "0")
			document.getElementById("MonthRet").style.color="black";
		else
		{
			document.getElementById("MonthRet").style.color="salmon";
			proceed = false;
		}*/
		
		if (AmountKey.value != "" && AmountKey.value.length <= 11 && !isNaN(AmountKey.value))
			document.getElementById("AmountKey").style.background="white";
		else
		{
			document.getElementById("AmountKey").style.background="#FCBBBB";
			proceed = false;
		}

		if (RemarksKey.value.length <= 30)
			document.getElementById("RemarksKey").style.background="white";
		else
		{
			document.getElementById("RemarksKey").style.background="#FCBBBB";
			proceed = false;
		}
	return proceed;
}
	
//	return proceed;
}

function validateDormForm(dormForm)
{	
	var proceed = true;
	
		with(dormForm)
	{
		if (dormname.value.trim() != "" && dormname.value.length <= 50)
			dname.innerHTML = "";
		else
		{
			dname.innerHTML = "Invalid dormitory name";
			proceed = false;
		}
		
		if (alias.value.trim() != "" && alias.value.length <= 30)
			als.innerHTML = "";
		else
		{
			als.innerHTML = "Invalid alias";
			proceed = false;
		}
		
		if (monthlyrent.value.trim() != "" && !isNaN(monthlyrent.value))
			mrent.innerHTML = "";
		else
		{
			mrent.innerHTML = "Invalid amount";
			proceed = false;
		}
		
		if (dailyrent.value.trim() != "" && !isNaN(dailyrent.value))
			drent.innerHTML = "";
		else
		{
			drent.innerHTML = "Invalid amount";
			proceed = false;
		}
		
		if (noRooms.value.trim() != "" && !isNaN(noRooms.value))
			noRm.innerHTML = "";
		else
		{
			noRm.innerHTML = "Invalid input";
			proceed = false;
		}
		
		if (noPerRoom.value.trim() != "" && !isNaN(noPerRoom.value))
			noPerRm.innerHTML = "";
		else
		{
			noPerRm.innerHTML = "Invalid input";
			proceed = false;
		}
		
		if (occ.value.trim() != "" && !isNaN(occ.value))
			docc.innerHTML = "";
		else
		{
			docc.innerHTML = "Invalid input";
			proceed = false;
		}
		
		if (MaleOcc.value.trim() != "" && !isNaN(MaleOcc.value))
			mocc.innerHTML = "";
		else
		{
			mocc.innerHTML = "Invalid input";
			proceed = false;
		}
		
		if (FemaleOcc.value.trim() != "" && !isNaN(FemaleOcc.value))
			focc.innerHTML = "";
		else
		{
			focc.innerHTML = "Invalid input";
			proceed = false;
		}
		
		if (parseInt(MaleOcc.value.trim()) + parseInt(FemaleOcc.value.trim()) == parseInt(occ.value.trim()))
			docc.innerHTML = "";
		else
		{
			docc.innerHTML = "Values does not match";
			proceed = false;
		}
		
		if (TFUP.value.trim() != "" && !isNaN(TFUP.value))
			noTFUP.innerHTML = "";
		else
		{
			noTFUP.innerHTML = "Invalid input";
			proceed = false;
		}
		
		if (TFNUP.value.trim() != "" && !isNaN(TFNUP.value))
			noTFNUP.innerHTML = "";
		else
		{
			noTFNUP.innerHTML = "Invalid input";
			proceed = false;
		}
		if (cluster.value.trim() != "" && cluster.value.length <= 180)
			clstr.innerHTML = "";
		else
		{
			clstr.innerHTML = "Invalid input";
			proceed = false;
		}
		if (SY.value.trim() != "" && SY.value.length <= 10)
			noSY.innerHTML = "";
		else
		{
			noSY.innerHTML = "Invalid School Year";
			proceed = false;
		}
		
		
		
		
		
		return proceed;	
	
}

//	return proceed;
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




function getMonth(month,DayId,YearId)
{
var str="";	
var bool =0;
	if (month.length==0)
  	{ 
	document.getElementById(DayId).innerHTML="";
	document.getElementById(YearId).innerHTML="";

  	return;
  	}
	if(month=="Jan"|| month== 1||month=="Mar"||month== 3||month=="May"||month== 5||month=="Jul"||month== 7||month=="Aug"||month== 8||month=="Oct"||month== 10||month=="Dec"||month== 12)
	{
	str= returnOpt(1,31);
	}else{
		
		if(month=="Apr"||month== 4||month=="Jun"||month== 6||month=="Sep"||month== 9||month=="Nov"||month== 11){
			
			str =  returnOpt(1,30);//30 days
		}else{
		if(month=="Feb"||month== 2){
			
			str = returnOpt(1,28);//28 days
		}else{
			bool = 1;
			str = '<option value ="">Day</option>';
		}
		}
	}

	document.getElementById(DayId).innerHTML='<select name="'+DayId+'">'+str+'</select>';
	
	if(bool==0){
		var d = new Date();
		document.getElementById(YearId).innerHTML='<select name="'+YearId+'" >'+returnOpt(1950,d.getFullYear()+1)+'</select>';
	}else{
		
		document.getElementById(YearId).innerHTML='<select name="'+YearId+'" ><option value="">Year</select>';
		
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

