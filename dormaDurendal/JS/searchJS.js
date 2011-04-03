var xmlHttp;
var xmlHttp2;

var xmlHttp2a;
var xmlHttp5;
var xmlHttp4;

var xmlHttp444;
var xmlHttp3;


var selected ="";
function deleteResident(fName,mName,lName){
	
	//var r=false;
	var r=confirm("Delete "+fName+" "+mName+" "+lName+"?");
	//prompt("Deleted1 "+fName+" "+mName+" "+lName+"!"+r);			
	
	if (r==true)
	  {	
		xmlHttp4=GetXmlHttpObject();
		if (xmlHttp4==null)
		  {
		  alert ("Your browser does not support AJAX!");
		  return;
		  }
		
		var url="index.php?c=resident&m=delete";
		url=url+"&fname="+fName;
		url = url+"&lname="+lName;
		url = url+"&mname="+mName;
		xmlHttp4.onreadystatechange=stateChanged4;
		xmlHttp4.open("GET",url,true);
		xmlHttp4.send(null);
		alert("Deleted "+fName+" "+mName+" "+lName+"!");
		document.getElementById("search").value="Search...";
		
	}
	else
	  {alert("Not Deleted"+fName+" "+mName+" "+lName );
		 
	  return;
	  }
}
function deleteTransient(fName,mName,lName){
	
	//var r=false;
	var r=confirm("Delete "+fName+" "+mName+" "+lName+"?");
	//prompt("Deleted1 "+fName+" "+mName+" "+lName+"!"+r);			
	
	if (r==true)
	  {	
		xmlHttp5=GetXmlHttpObject();
		if (xmlHttp5==null)
		  {
		  alert ("Your browser does not support AJAX!");
		  return;
		  }
		
		var url="index.php?c=resident&m=deleteT";
		url=url+"&fname="+fName;
		url = url+"&lname="+lName;
		url = url+"&mname="+mName;
		xmlHttp5.onreadystatechange=stateChanged5;
		xmlHttp5.open("GET",url,true);
		xmlHttp5.send(null);
		alert("Deleted "+fName+" "+mName+" "+lName+"!");			
	}
	else
	  {alert("Not Deleted"+fName+" "+mName+" "+lName );
		 
	  return;
	  }
}

function changePage(page){
	
	xmlHttp2=GetXmlHttpObject();
	if (xmlHttp2==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 

	var url="index.php?c=option&m=loadLinkTable";
	url=url+"&link="+page;
	xmlHttp2.onreadystatechange=stateChanged2;
	xmlHttp2.open("GET",url,true);
	xmlHttp2.send(null);


}
function changePage2(page){
	
	xmlHttp5=GetXmlHttpObject();
	if (xmlHttp5==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 

	var url="index.php?c=option&m=loadLinkTable2";
	url=url+"&link2="+page;
	xmlHttp5.onreadystatechange=stateChanged5;
	xmlHttp5.open("GET",url,true);
	xmlHttp5.send(null);


}

function suggestG(str){
	str = str.replace(/"/g,"");
	str = str.replace(/'/g,"");
	if (str.length==0)
	  { 
	  document.getElementById("gsearch").innerHTML="";

	 return;
	  }


xmlHttp3=GetXmlHttpObject();
if (xmlHttp3==null)
{
alert ("Your browser does not support AJAX!");
return;
}
var url="index.php?c=resident&m=searchGuarantor";
url=url+"&str="+str.trim();
xmlHttp3.onreadystatechange=stateChanged3;
xmlHttp3.open("GET",url,true);
xmlHttp3.send(null);

}
function suggest(str)
{
	var id="";
	document.getElementById("content").innerHTML="";
	str = str.replace(/"/g,"");
	str = str.replace(/'/g,"");

if (str.length==0)
  { 
  document.getElementById("search").innerHTML="";

 return;
  }
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
var url="index.php?c=option&m=loadSuggestionBox";
url=url+"&strSearch="+str.trim();
url=url+"&id="+id;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

xmlHttp2=GetXmlHttpObject();


var url="index.php?c=option&m=loadLinkTable";
url=url+"&link="+"1";
xmlHttp2.onreadystatechange=stateChanged1;
xmlHttp2.open("GET",url,true);
xmlHttp2.send(null);


xmlHttp5=GetXmlHttpObject();


var url="index.php?c=option&m=loadLinkTable2";
url=url+"&link2="+"1";
xmlHttp5.onreadystatechange=stateChanged5;
xmlHttp5.open("GET",url,true);
xmlHttp5.send(null);


}

function searchV(str){
	
selected = str;

xmlHttp3=GetXmlHttpObject();
if (xmlHttp3==null)
{
alert ("Your browser does not support AJAX!");
return;
}
fNameVal = document.getElementById("fnameV").value.replace(/'/g,"");
mNameVal = document.getElementById("mnameV").value.replace(/'/g,"");
lNameVal = document.getElementById("lnameV").value.replace(/'/g,"");

var url="index.php?c=resident&m=searchViolator";
url=url+"&fname="+fNameVal;
url=url+"&mname="+mNameVal;
url=url+"&lname="+lNameVal;
xmlHttp3.onreadystatechange=stateChanged303;
xmlHttp3.open("GET",url,true);
xmlHttp3.send(null);

}

function stateChanged() 
{ 
if (xmlHttp.readyState==4)
{
if(xmlHttp.responseText!=""){ 
document.getElementById("suggest").style.visibility="visible";
document.getElementById("suggest").innerHTML=xmlHttp.responseText;
}
}else{

	document.getElementById("suggest").innerHTML = '<center><img src="IMG/squareload.gif" /></center>';
		
}
}

function stateChanged303() 
{ 
if (xmlHttp3.readyState==4)
{
if(xmlHttp3.responseText!=""){ 
	document.getElementById("divlnameV").innerHTML="";
	document.getElementById("divfnameV").innerHTML="";
	document.getElementById("divmnameV").innerHTML="";
	
	document.getElementById(selected).style.visibility="visible";
	document.getElementById(selected).innerHTML=xmlHttp3.responseText;
}
}else{

	document.getElementById(selected).innerHTML = '<center><img src="IMG/squareload.gif" />Loading Residents..</center>';
		
}
}
function stateChanged3() 
{ 
if (xmlHttp3.readyState==4)
{
if(xmlHttp3.responseText!=""){ 
	document.getElementById("gsearch").style.visibility="visible";
	document.getElementById("gsearch").innerHTML=xmlHttp3.responseText;
}
}else{

	document.getElementById("gsearch").innerHTML = '<center><img src="IMG/squareload.gif" />Loading Guarantors..</center>';
		
}
}
function stateChanged1() 
{ 
if (xmlHttp2.readyState==4)
{
document.getElementById("content").innerHTML="";
if(document.getElementById("residentSearch")){	
	document.getElementById("residentSearch").innerHTML=xmlHttp2.responseText;
}
}else{

	document.getElementById("residentSearch").innerHTML = '<img src="IMG/circleload.gif" /> Loading Content...';
		
}
}

function stateChanged2() 
{ 
if (xmlHttp2.readyState==4)
{
if(document.getElementById("residentSearch")){	
document.getElementById("residentSearch").innerHTML=xmlHttp2.responseText;
}
}else{
	document.getElementById("residentSearch").innerHTML = '<img src="IMG/circleload.gif" /> Loading Content...';
	
}
}
function stateChanged4(){
	
	if (xmlHttp4.readyState==4)
	{ 
		document.getElementById("content").innerHTML="";
		document.getElementById("residentSearch").innerHTML=xmlHttp4.responseText;
	}else{
		document.getElementById("residentSearch").innerHTML = '<img src="IMG/circleload.gif" /> Loading Content...';
		
	}
	
	
}
function stateChanged5(){
	
	if (xmlHttp5.readyState==4)
	{ 
		if(document.getElementById("transientSearch")){
		document.getElementById("transientSearch").innerHTML=xmlHttp5.responseText;
		}
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

function setValue(str){
	

	document.getElementById("search").value=str;
	document.getElementById("suggest").style.visibility="hidden";
	suggest(str);
}
function setValue2(str){
	

	document.getElementById("guarantor").value=str;
	document.getElementById("gsearch").style.visibility="hidden";
	
}

function setValue3(str){
	
	var arr = str.split("@");	
	
	document.getElementById("lnameV").value=arr[2];
	document.getElementById("fnameV").value=arr[0];
	document.getElementById("mnameV").value=arr[1];
	
}


function clearfield(){

	if (search.value == "Search...")
		document.getElementById("search").value="";

		//document.getElementById("suggest").style.visibility="visible";
}

function restart(){
	if(document.getElementById('auto')){
	var tbl = document.getElementById('auto');
	if( tbl.rows.length<=0){
	document.getElementById("suggest").style.visibility="hidden";
	
	}
	}else{
	document.getElementById("suggest").style.visibility="hidden";
	}
	if (document.getElementById("search").value == "")
		document.getElementById("search").value="Search...";
	

}

function showThis(){

document.getElementById("suggest").style.visibility="visible";

}
