

var httpobject;
var o;
function getInfo(str,opt)
{  o = opt;
 if(str.length != 0)
 {
httpobject=GetHttpObject();
if (httpobject !=null)
  {
 var url="option.php";
 url=url+"?str="+str;
 url=url+"&opt="+opt;
 httpobject.onreadystatechange=stateChanged;
 httpobject.open("GET",url,true);
 httpobject.send(null);
 }
 }
 else
 {	
if(opt==1){
 	document.getElementById("runsfor1").innerHTML="";
  }
  if(opt ==0){
 	document.getElementById("option").innerHTML="";
  }
  
 }
 
}
function delInfo(str,opt,size)
{  
 if(str.length != 0)
 {
httpobject=GetHttpObject();
if (httpobject !=null)
  {
 var url="option.php";
 url=url+"?str="+str;
 url=url+"&opt="+opt;
 url=url+"&size="+size;
 httpobject.onreadystatechange=stateChanged2;
 httpobject.open("GET",url,true);
 httpobject.send(null);
 }
 }
 else
 {	 	
 document.getElementById("opt").innerHTML="";
 }
 
}
function stateChanged()
{
if (httpobject.readyState==4)
{
if(o==1){
document.getElementById("runsfor1").innerHTML=httpobject.responseText;
}if(o==0){
document.getElementById("option").innerHTML=httpobject.responseText;
}
}
}

function stateChanged2()
{
if (httpobject.readyState==4)
{

document.getElementById("opt").innerHTML=httpobject.responseText;

}
}


function GetHttpObject()
{
if (window.ActiveXObject) 
  return new ActiveXObject("Microsoft.XMLHTTP");
  else if (window.XMLHttpRequest) 
  return new XMLHttpRequest();
  else 
  {
  alert("Your browser does not support AJAX.");
  return null;
  }
}