var xmlHttp
var xmlHttp2
var xmlHttp4;


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
function suggest(str,id)
{
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
xmlHttp2.onreadystatechange=stateChanged2;
xmlHttp2.open("GET",url,true);
xmlHttp2.send(null);


} 

function stateChanged() 
{ 
if (xmlHttp.readyState==4)
{ 
document.getElementById("suggest").innerHTML=xmlHttp.responseText;
}
}

function stateChanged2() 
{ 
if (xmlHttp2.readyState==4)
{ 
document.getElementById("content").innerHTML=xmlHttp2.responseText;
}
}
function stateChanged4(){
	
	if (xmlHttp4.readyState==4)
	{ 

		document.getElementById("content").innerHTML=xmlHttp4.responseText;
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
	suggest(str.trim());
}

function clearfield(){

	if (search.value == "Search...")
		document.getElementById("search").value="";
		
		document.getElementById("suggest").style.visibility="visible";
}

function restart(){
	
	//document.getElementById("suggest").style.visibility="hidden";
	
	if (search.value == "")
		document.getElementById("search").value="Search...";
	

}
