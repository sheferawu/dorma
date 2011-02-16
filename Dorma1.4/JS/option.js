/**
 * 
 */

 var xmlHttp44;
 var xmlHttp22;
 var xmlHttp33;
var cat;

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
 		
 		
 		function stateChanged44() 
 		{ 
 		//try{
 		if (xmlHttp22.readyState==4)
 		{ 
 			
 		document.getElementById("div"+cat).innerHTML=xmlHttp22.responseText;
 		}//}catch(err){}
 		}
 
		function addApp()
			{	var tbl = document.getElementById('app');
					
					var lastRow = tbl.rows.length;
					var iteration = lastRow-1;
					
					
					var row = tbl.insertRow(lastRow);
					var cellRight;
					var el;
					var cnt = 0;
					var arr = new Array('NONE','RADIO','EF', 'CW/P', 'CW/OP');
					var arr1 = new Array('None','Radio','Electric Fan', 'Computer With Printer', 'Computer With Out Printer');

					
					
					
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
						el = document.createElement('input');
						el.type = 'text';
						el.name = "dateInstalled" + (iteration);
						el.id = "dateInstalled" + (iteration);
						cellRight.appendChild(el);
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
				
					url=url+"&periodcovered="+document.getElementById(paid).value;
					url=url+"&ornum="+document.getElementById(ornum).value;
					url=url+"&datepaid="+document.getElementById(datepaid).value;
					url=url+"&remarks="+document.getElementById(remarks).value;
					
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
				if (window.XMLHttpRequest){		// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}else{		// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open("GET",url,false);
				xmlhttp.send(null);
				document.getElementById('content').innerHTML=xmlhttp.responseText;
				document.getElementById('search').value="Search...";
				document.getElementById('suggest').innerHTML="";	

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
				
				
			}