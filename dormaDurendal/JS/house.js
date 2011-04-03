var xmlhttpHouse;
var xmlhttpHouse2;
var xmlhttpHouse3;
function addRow(tableId){

	var fields= new Array ("DormName","Alias","Location","Manager","Password","Info");
	var tbl = document.getElementById(tableId);
	
	var lastRow = tbl.rows.length;
	var iteration = lastRow-1;
	var row = tbl.insertRow(lastRow);
	var cellRight;
	var el;
	var cnt = 0;
	var len = fields.length;
	for(cnt = 0;cnt<len;cnt++){
	cellRight = row.insertCell(cnt);
	el = document.createElement('input');
	el.type = 'text';
	el.name = fields[cnt] + (iteration);
	el.id = fields[cnt] + (iteration);
	cellRight.appendChild(el);
	}
	
	var xmlhttpHouse=GetXmlHttpObject3();
	if (xmlhttpHouse==null)
	{
	alert ("Your browser does not support AJAX!");
	return;
	}	 
	var newIteration = iteration+1;
	var url="index.php?c=house&m=setNumDorm";
	url=url+"&numdorm="+(newIteration);
	xmlhttpHouse.open("GET",url,true);
	xmlhttpHouse.send(null);

}
	
function GetXmlHttpObject3()
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



function setDormSelect(val){
	if(val==0){return;}
	var xmlhttpHouse=GetXmlHttpObject3();
	if (xmlhttpHouse==null)
	{
	alert ("Your browser does not support AJAX!");
	return;
	}	 
	
	var url="index.php?c=house&m=setDb";
	url=url+"&db="+val;
	xmlhttpHouse.open("GET",url,true);
	xmlhttpHouse.send(null);
	
}

function suggest(str)
{	str = str.replace(/"/,"");
	str = str.replace(/'/,"");
	document.getElementById("residentSearchHouse").innerHTML="";

	if (str.length==0)
	  { 
	  document.getElementById("searchHouse").innerHTML="";

	 return;
	  }
	xmlHttpHouse=GetXmlHttpObject3();
	var url="index.php?c=option&m=loadSuggestionBox";
	url=url+"&strSearch="+str.trim();	
	xmlHttpHouse.onreadystatechange=stateChangedHouse;
	xmlHttpHouse.open("GET",url,true);
	xmlHttpHouse.send(null);

	xmlHttpHouse2=GetXmlHttpObject3();
	var url="index.php?c=option&m=loadLinkTableHouse";
	url=url+"&link="+"1";
	xmlHttpHouse2.onreadystatechange=stateChangedHouse1;
	xmlHttpHouse2.open("GET",url,true);
	xmlHttpHouse2.send(null);

}
function stateChangedHouse() 
{ 
if (xmlHttpHouse.readyState==4)
{
if(xmlHttpHouse.responseText!=""){ 
document.getElementById("suggestHouse").style.visibility="visible";
document.getElementById("suggestHouse").innerHTML=xmlHttpHouse.responseText;
}
}else{

document.getElementById("suggestHouse").innerHTML = '<img src="IMG/squareload.gif" />';
		
}
}

function stateChangedHouse1() 
{ 
if (xmlHttpHouse2.readyState==4)
{
if(xmlHttpHouse2.responseText!=""){ 
document.getElementById("residentSearchHouse").style.visibility="visible";
document.getElementById("residentSearchHouse").innerHTML=xmlHttpHouse2.responseText;
}
}else{

document.getElementById("residentSearchHouse").innerHTML = '<img src="IMG/circleload.gif" />';
		
}
}


function setValue(str){
	

	document.getElementById("searchHouse").value=str;
	document.getElementById("suggestHouse").style.visibility="hidden";
	suggest(str);
}
function clearfield(){

	if (searchHouse.value == "Search...")
		document.getElementById("searchHouse").value="";

		//document.getElementById("suggest").style.visibility="visible";
}

function restart(){
	if(document.getElementById('auto')){
	var tbl = document.getElementById('auto');
	if( tbl.rows.length<=0){
	document.getElementById("suggestHouse").style.visibility="hidden";
	
	}
	}else{
	document.getElementById("suggestHouse").style.visibility="hidden";
	}
	if (document.getElementById("searchHouse").value == "")
		document.getElementById("searchHouse").value="Search...";
	

}

function showThis(){

	document.getElementById("suggestHouse").style.visibility="visible";

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
		if(document.getElementById('contentHouse')){
			document.getElementById('contentHouse').innerHTML=xmlhttp.responseText;
		}
		if(document.getElementById('searchHouse')){
			document.getElementById('searchHouse').value="Search...";
		}
		if(document.getElementById('suggestHouse')){
			document.getElementById('suggestHouse').innerHTML="";	
			document.getElementById('suggestHouse').style.visibility="hidden";
			
		}
		if(document.getElementById("residentSearchHouse")){
			document.getElementById("residentSearchHouse").innerHTML="";
			
		}
		if(document.getElementById("pay")){
		 $("div.payment_info").hide(); 
		}

		
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
	document.getElementById('pay').innerHTML="<center>"+xmlhttp.responseText+"</center>";
}


function deleteAll(fName,mName,lName){


	var r=confirm("Delete all records of payment of "+fName+" "+mName+" "+lName+"?");
		

	if (r==true)
	{
		xmlHttpHouse=GetXmlHttpObject3();
		if (xmlHttpHouse==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
	
		var url="index.php?c=dorm&m=deletepay";
		url=url+"&fname="+fName;
		url = url+"&lname="+lName;
		url = url+"&mname="+mName;
		xmlHttpHouse.open("GET",url,true);
		xmlHttpHouse.send(null);
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
		
			
			var xmlHttpHouse=GetXmlHttpObject3();
			if (xmlHttpHouse==null)
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
			
			xmlHttpHouse.open("GET",url,true);
			xmlHttpHouse.send(null);
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
		}}
	
	function changePage4(page){
		
		xmlHttpHouse3=GetXmlHttpObject3();
		if (xmlHttpHouse3==null)
		  {
		  alert ("Your browser does not support AJAX!");
		  return;
		  } 

		var url="index.php?c=option&m=loadLinkTableHouse";
		url=url+"&link="+page;
		xmlHttpHouse3.onreadystatechange=stateChangedHouse22;
		xmlHttpHouse3.open("GET",url,true);
		xmlHttpHouse3.send(null);


	}
	function stateChangedHouse22() 
	{ 
	if (xmlHttpHouse3.readyState==4)
	{
	if(document.getElementById("residentSearchHouse")){	
	document.getElementById("residentSearchHouse").innerHTML=xmlHttpHouse3.responseText;
	}
	}else{
		document.getElementById("residentSearchHouse").innerHTML = '<img src="IMG/circleload.gif" /> Loading Content...';
		
	}
	}


