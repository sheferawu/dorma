var xmlhttp;
var xmlhttp112;
var xmlHttp44;
var xmlHttp22;
var xmlHttp222;
var xmlHttp33;
var cat;

	function updateBal(){
		
		xmlHttp112=GetXmlHttpObject();
		var url="index.php?c=dorm&m=updateBalance";
		xmlHttp112.onreadystatechange=stateChanged122;
		xmlHttp112.open("GET",url,true);
		xmlHttp112.send(null);	
	
	}
	function saveDormPass(){
		var proceed = true;	
		if (currPswd.value.trim() != "" || newPswd.value.trim() != ""){
			
			
			
			if (newPswd.value.trim() == ""||newPswd.value.length < 4){
				np.innerHTML = "Invalid password";
				proceed = false;
			}
			else{
				np.innerHTML = "";
			}
			
			if (currPswd.value.trim() == ""){
				checkPwd.innerHTML = "Invalid password";
				proceed = false;
			}
			
			if(document.getElementById("checkPwd").innerHTML=="Invalid Password"){
				proceed = false;
				document.getElementById("checkPwd").innerHTML = "Invalid Password";
			}
			if(newPswd.value.indexOf("'")!=-1){
				np.innerHTML = "Invalid character!";
				
			}
		}else{
			np.innerHTML = "";
			checkPwd.innerHTML = "";
		}
		
		if(proceed==true){
			
			if (currPswd.value.trim() != "" || newPswd.value.trim() != ""){
				np.innerHTML = "";
				checkPwd.innerHTML = "";
				xmlHttp112=GetXmlHttpObject();
				var url="index.php?c=option&m=savePassWord";
				url+= "&password="+newPswd.value;
				xmlHttp112.onreadystatechange=stateChanged212;
				xmlHttp112.open("GET",url,true);
				xmlHttp112.send(null);	
			
			
			
			}
			
		}
	
	}
	function checkPassword(pwd){
		if(pwd.indexOf("'")!=-1){
			document.getElementById("checkPwd").innerHTML="Invalid Character!";
			document.getElementById("currPswd").value="";
			return ;
		}
		
		if(pwd.trim()==""){
			 document.getElementById("checkPwd").innerHTML="";
				
			return;
		}
		xmlHttp112=GetXmlHttpObject();
		var url="index.php?c=option&m=checkPassWord";
		url+= "&password="+pwd;
		xmlHttp112.onreadystatechange=stateChanged221;
		xmlHttp112.open("GET",url,true);
		xmlHttp112.send(null);
	
		
	}
	function setCluster(){
	
	
		if(document.getElementById("eMonth")
		 &&document.getElementById("eDay")
		 &&document.getElementById("eYear")
		 &&document.getElementById("sMonth")
		 &&document.getElementById("sDay")
		 &&document.getElementById("sYear")){
			
			var start = document.getElementById("sMonth").value+"/"+document.getElementById("sDay").value+"/"+document.getElementById("sYear").value;
			var end = document.getElementById("eMonth").value+"/"+document.getElementById("eDay").value+"/"+document.getElementById("eYear").value;
			var pay = document.getElementById("monthlyrent").value;
			if(pay!=""&&!isNaN(pay)){
			xmlHttp112=GetXmlHttpObject();
		
			var url="index.php?c=option&m=makeCluster";
			url+= "&start="+start; 
			url+= "&end="+end;
			url+="&pay="+pay;
			xmlHttp112.onreadystatechange=stateChanged211;
			xmlHttp112.open("GET",url,true);
			xmlHttp112.send(null);
			}else{
				alert("Error in monthly rent value");
			}
		}
	}
	function getResReport(date,mode){
		 xmlHttp112=GetXmlHttpObject();
			
			if(date!=0){
			if(mode == 1){
			var url="index.php?c=dorm&m=residentswithaccount&m2=1";
			}else
				if(mode==2){
					var url="index.php?c=dorm&m=transientsWithAccount&m2=1";
					
				}else
					if(mode==3){
						var url="index.php?c=dorm&m=applianceReport&m2=1";
						
					}else {return;}
			url+= "&date="+date; 
			xmlHttp112.onreadystatechange=stateChanged112;
			xmlHttp112.open("GET",url,true);
			xmlHttp112.send(null);
			}else{
				document.getElementById("residentSearch").innerHTML=xmlHttp112.responseText;
				
			}

	}
	function getAccReport(date){
		 xmlHttp112=GetXmlHttpObject();
			
			if(date!=0){
			var url="index.php?c=dorm&m=currentAccomplishReport&m2=1";
			url+= "&date="+date; 
			xmlHttp112.onreadystatechange=stateChanged112;
			xmlHttp112.open("GET",url,true);
			xmlHttp112.send(null);
			}else{
				document.getElementById("residentSearch").innerHTML=xmlHttp112.responseText;
				
			}

	}
	
	function stateChanged112() 
		{ 
		//try{
		if (xmlHttp112.readyState==4)
		{ 
			
		document.getElementById("residentSearch").innerHTML=xmlHttp112.responseText;
		}else{
			document.getElementById("residentSearch").innerHTML = '<img src="IMG/circleload.gif" /> Loading Content...';
			
		}
		}
	function stateChanged122() 
	{ 
	//try{
	if (xmlHttp112.readyState==4)
	{ 
		
	document.getElementById("updateBal").innerHTML=xmlHttp112.responseText;
	}else{
		document.getElementById("updateBal").innerHTML = '<img src="IMG/squareload.gif" /> UpdatingBalance...';
		
	}
	}
	function stateChanged211() 
	{ 

	if (xmlHttp112.readyState==4)
	{ 
		
	document.getElementById("clusterDiv").innerHTML=xmlHttp112.responseText;
	}else{
		document.getElementById("clusterDiv").innerHTML = '<img src="IMG/squareload.gif" />Creating clusters..';
		
	}
	}
	function stateChanged221() 
	{ 

	if (xmlHttp112.readyState==4)
	{ 
		
	  document.getElementById("checkPwd").innerHTML=xmlHttp112.responseText;
	
	}else{
		document.getElementById("checkPwd").innerHTML = '<img src="IMG/squareload.gif" /><br/>Checking Pasword';
		
	}
	}
	function stateChanged212() 
	{ 

	if (xmlHttp112.readyState==4)
	{ 
		
	  document.getElementById("changepassword").innerHTML=xmlHttp112.responseText;
	
	}else{
		document.getElementById("changepassword").innerHTML = '<img src="IMG/squareload.gif" /><br/>Saving Pasword';
		
	}
	}
	function stateChanged44() 
		{ 
		//try{
		if (xmlHttp22.readyState==4)
		{ 
			
		document.getElementById("div"+cat).innerHTML=xmlHttp22.responseText;
		}else{
			document.getElementById("div"+cat).innerHTML = '<img src="IMG/circleload.gif" /> Loading Content...';
			
		}
		}
	
	function statechange101(){
		
		if (xmlhttp.readyState==4)
		{
			
		document.getElementById('content').innerHTML=xmlhttp.responseText;
		}else{
			document.getElementById('content').innerHTML = '<center><img src="IMG/squareload.gif" /> Loading Content...</center>';
			
			
		}
	}

	function changeSortPage(category,subcat,i){
	
		 xmlHttp22=GetXmlHttpObject();
			
			cat = subcat;
			
			var url="index.php?c=resident&m=pagesortcontent";
			url=url+"&cat="+category;
			url=url+"&page="+i;
			url=url+"&subcat="+subcat;
			xmlHttp22.onreadystatechange=stateChanged44;
			xmlHttp22.open("GET",url,true);
			xmlHttp22.send(null);


		
	}

	function viewSortList(category,subcat){
 			 xmlHttp22=GetXmlHttpObject();
 			
 			if(document.getElementById(subcat).value.indexOf("+")!=-1){
 			cat = subcat;
 			
 			var url="index.php?c=resident&m=sortcontent";
 			url=url+"&cat="+category;
 			url=url+"&sub="+subcat;
 			document.getElementById(subcat).value =subcat+"-" ;
 			xmlHttp22.onreadystatechange=stateChanged44;
 			xmlHttp22.open("GET",url,true);
 			xmlHttp22.send(null);
 			}else{
 				document.getElementById("div"+subcat).innerHTML ="" ;
 				document.getElementById(subcat).value =subcat+"+" ;
 	 				
 			}
 			
 		}
 		
	function addApp(appId,arr)
			{	var tbl = document.getElementById(appId);
					
					var lastRow = tbl.rows.length;
					var iteration = lastRow-1;
				
					arr1= arr = arr.split("*");
					var row = tbl.insertRow(lastRow);
					var cellRight;
					var el;
					var cnt = 0;
					cellRight = row.insertCell(0);
					el = document.createElement('select');
					el.name = "ApplianceName" + (iteration);
					el.id = "ApplianceName" + (iteration);
					var cnt1 = 0;
					var p;
					for(cnt1=0;cnt1<arr.length;cnt1++){
						
					 el.options[cnt1] = new Option(arr1[cnt1], arr[cnt1]);
					 }
					 cellRight.appendChild(el);

					 cellRight = row.insertCell(1);
						el = document.createElement('input');
						el.type = 'text';
						el.name = "controlNum" + (iteration);
						
						el.id = "controlNum" + (iteration);
						el.size = "7";
						
						cellRight.appendChild(el);
						
					cellRight = row.insertCell(2);
					el = document.createElement('select');
					el.name = "dateInstalledMonth" + (iteration);
					el.id = "dateInstalledMonth" + (iteration);
					el.options[0] = new Option("M", "0");;
					
					for(cnt1=1;cnt1<=12;cnt1++){
						
						 el.options[cnt1] = new Option(cnt1, cnt1);
						 }
					
					cellRight.appendChild(el);
					
					cellRight = row.insertCell(3);
					el = document.createElement('select');
					el.name = "dateInstalledDay" + (iteration);
					el.id = "dateInstalledDay" + (iteration);
					
					el.options[0] = new Option("D", "0");;
					cellRight.appendChild(el);
					

					cellRight = row.insertCell(4);
					el = document.createElement('select');
					el.name = "dateInstalledYear" + (iteration);
					el.id = "dateInstalledYear" + (iteration);
					
					el.options[0] = new Option("Y", "0");;
					cellRight.appendChild(el);
					
					
				
					document.getElementById('dateInstalledMonth'+(iteration)).onchange = Function("getMonth(this.options[this.selectedIndex].value,'dateInstalledDay"+(iteration)+"','dateInstalledYear"+(iteration)+"')") ;
			
					var xmlHttp22=GetXmlHttpObject();
						if (xmlHttp22==null)
						{
						alert ("Your browser does not support AJAX!");
						return;
						}	 
					var newIteration = iteration+1;
					var url="index.php?c=resident&m=setNumApp";
					url=url+"&numapp="+(newIteration);
					xmlHttp22.open("GET",url,true);
					xmlHttp22.send(null);
		
				
			}
		
	function addAppSet(appId){
			var tbl = document.getElementById(appId);
			var lastRow = tbl.rows.length;
			var iteration = lastRow-1;
			var row = tbl.insertRow(lastRow);
			var cellRight;
			var el;
			
			
			cellRight = row.insertCell(0);
			el = document.createElement('input');
			el.type = 'text';
			el.name = "App" + (iteration);
			el.id = "App" + (iteration);
			cellRight.appendChild(el);
			
			cellRight = row.insertCell(1);
			el = document.createElement('input');
			el.type = 'text';
			el.name = "AppMonth" + (iteration);
			el.id = "AppMonth" + (iteration);
			cellRight.appendChild(el);
			
			cellRight = row.insertCell(2);
			el = document.createElement('input');
			el.type = 'text';
			el.name = "AppDaily" + (iteration);
			el.id = "AppDaily" + (iteration);
			cellRight.appendChild(el);
			
			cellRight = row.insertCell(3);
			el = document.createElement('input');
			el.type = 'Button';
			el.name = "AppButton" + (iteration);
			el.id = "AppButton" + (iteration);
			el.value = "Submit form first!";
			cellRight.appendChild(el);
			
			var xmlHttp222=GetXmlHttpObject();
			if (xmlHttp222==null)
			{
			alert ("Your browser does not support AJAX!");
			return;
			}	 
		var newIteration = iteration+1;
		var url="index.php?c=dorm&m=setNumApp";
		url=url+"&numapp="+(newIteration);
		xmlHttp222.open("GET",url,true);
		xmlHttp222.send(null);

		}
		
	function removeApp()
		{
		  var tbl = document.getElementById('app');
		  var lastRow = tbl.rows.length;
		  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
		}
		
	
	function deleteAll(fName,mName,lName){


			var r=confirm("Delete all records of payment of "+fName+" "+mName+" "+lName+"?");
				
		
			if (r==true)
			{
				xmlHttp44=GetXmlHttpObject();
				if (xmlHttp44==null)
				{
					alert ("Your browser does not support AJAX!");
					return;
				}
			
				var url="index.php?c=dorm&m=deletepay";
				url=url+"&fname="+fName;
				url = url+"&lname="+lName;
				url = url+"&mname="+mName;
				xmlHttp44.open("GET",url,true);
				xmlHttp44.send(null);
				alert("Payment Records  of "+fName+" "+mName+" "+lName+" are Deleted!");
				loadPayment();
			}else{
				alert("Records are not deleted!");
			}
			return;
		}
	
	
	function submitThis(numClus,paid,ornum,datepaid,remarks){
		//alert(document.getElementById(paid).checked);
		/**/
		var err = false;
		if(document.getElementById(ornum).value.trim()==""){
			
			err = true;
		}
			if(document.getElementById(datepaid).value.trim()==""){
			
			err = true;
		}
			
			if(document.getElementById(datepaid).value.split("/").length != 3){
				var arDate = document.getElementById(datepaid).value.split("/");
				if(isNaN(arDate[0])&&isNaN(arDate[1])&&isNaN(arDate[2]));
				err = true;
			}
			if(err==false&&document.getElementById(paid).checked){
					var num = 0;
					var cnt=0;
				
					
					var xmlHttp=GetXmlHttpObject();
					if (xmlHttp==null)
					  {
					  alert ("Your browser does not support AJAX!");
					  return;
					  }
					
					var url="index.php?c=dorm&m=getpay";
					var paidVal =  document.getElementById(paid).value;
						paidVal = paidVal.replace(/'/,"");
						paidVal = paidVal.replace(/"/,"");
					var ornumVal =  document.getElementById(ornum).value;
						ornumVal = ornumVal.replace(/'/,"");
						ornumVal = ornumVal.replace(/"/,"");
					var datepaidVal =  document.getElementById(datepaid).value;
						datepaidVal = datepaidVal.replace(/'/,"");
						datepaidVal = datepaidVal.replace(/"/,"");
					var remarksVal =  document.getElementById(remarks).value;
					remarksVal = remarksVal.replace(/'/,"");
					remarksVal = remarksVal.replace(/"/,"");
						
					url=url+"&periodcovered="+paidVal;
					url=url+"&ornum="+ornumVal;
					url=url+"&datepaid="+datepaidVal;
					url=url+"&remarks="+remarksVal;
					

					xmlHttp.open("GET",url,true);
					xmlHttp.send(null);
				var r=confirm("Records Save");
					if(r){
					loadPayment();
					}else{
						loadPayment();
							
					}
					}
					else{
					
					alert("wrong input!");
					document.getElementById(paid).checked =false;
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
	
	function loadXMLDoc(url){
			//alert("lol");
				if (window.XMLHttpRequest){		// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}else{		// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open("GET",url,false);
				xmlhttp.send(null);
				//xmlhttp.onreadystatechange = statechange101;
				document.getElementById('content').innerHTML=xmlhttp.responseText;
				document.getElementById('search').value="Search...";
				document.getElementById('suggest').innerHTML="";	
				document.getElementById("suggest").style.visibility="hidden";
				document.getElementById("residentSearch").innerHTML="";
				document.getElementById("transientSearch").innerHTML="";
				$("div.otherOptions_info").hide();
				$("div.password_info").hide();
				$("div.applianceSet").hide();
				 $("div.dorm_info").hide();
				 $("div.suggest").hide();
				 $("div.appliance_info").hide();	
				 $("div.resident_info").hide();
				 $("div.accomodation_info").hide();
				 $("div.classification_info").hide();
				 $("div.college_info").hide();
				 $("div.regional_info").hide();
				 $("div.vacancy_info").hide();
				 $("div.view_info").hide();
				 $("div.balanceTable").hide();
				 $("div.log_info").hide();
				 $("div.reservation_info").hide();
				 $("div.key_info").hide();
				 $("div.payment_info").hide(); 
				 $("div.balanceTable").hide();
				 $("div.other_info").hide();
				 $("div.custodian_info").hide();
				 $("div.violation_info").hide();
			}


	function loadAppliances(url){
				
				if(document.getElementById('loadApp').value=="Load Appliances"){
					if (window.XMLHttpRequest){		// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}else{		// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.open("GET",url,false);
				xmlhttp.send(null);
				document.getElementById('app').innerHTML=xmlhttp.responseText;
				document.getElementById('search').value="Search...";
				document.getElementById('suggest').innerHTML="";
				document.getElementById('loadApp').value= "Unload Appliances";
				}else{
					document.getElementById('loadApp').value= "Load Appliances";
					document.getElementById('app').innerHTML="";
					
				}				
			}

			
	function dropDown(item) {			    
			    $("."+item).slideToggle("normal");
			}
	function dropDown2(item) {			    
				loadPayment();
				$("."+item).slideToggle("normal");
			    
			}
	function loadPayment(){
				if (window.XMLHttpRequest){		// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}else{		// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open("GET","index.php?c=dorm&m=pay",false);
				xmlhttp.send(null);
				document.getElementById('pay').innerHTML=xmlhttp.responseText;
				
				if (window.XMLHttpRequest){		// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp2=new XMLHttpRequest();
				}else{		// code for IE6, IE5
					xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp2.open("GET","index.php?c=resident&m=bal",false);
				xmlhttp2.send(null);
				document.getElementById('residentBalance').innerHTML=xmlhttp2.responseText;
				
				
				
			}
	function changeAppClus(appName){
		
		var url = "index.php?c=option&m=changeAppClus";
		url+="&appname="+appName;
		if (window.XMLHttpRequest){		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else{		// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET",url,false);
		xmlhttp.send(null);
		document.getElementById('content').innerHTML=xmlhttp.responseText;
		
	}		
			
			
