var xmlHttp
var xmlHttp2

function getMonth(month)
{
	
if (month.length==0)
  { 
  document.getElementById("Day").innerHTML="";
  document.getElementById("Year").innerHTML="";
  
  return;
  }
xmlHttp=GetXmlHttpObject();

if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
var url="addOption.php";
url=url+"?month="+month;
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

xmlHttp2=GetXmlHttpObject();


url ="addOption.php";
if(month!="Month"){
url=url+"?y="+"1";
}else{ url=url+"?y="+"0";
}
xmlHttp2.onreadystatechange=stateChanged2;
xmlHttp2.open("GET",url,true);
xmlHttp2.send(null);
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

