var tipwidth='150px'; //default tooltip width
var tipbgcolor='lightyellow';  //tooltip bgcolor
var disappeardelay=250; //tooltip disappear speed onMouseout (in miliseconds)
var vertical_offset="0px"; //horizontal offset of tooltip from anchor link
var horizontal_offset="-3px"; //horizontal offset of tooltip from anchor link
var xmlhttpTool;
/////No further editting needed

/*var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ie4||ns6)
document.write('<div id="fixedtipdiv" style="visibility:hidden;width:'+tipwidth+';background-color:'+tipbgcolor+'" ></div>')

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}


function showhide(obj, e, visible, hidden, tipwidth){
if (ie4||ns6)
dropmenuobj.style.left=dropmenuobj.style.top=-500
if (tipwidth!=""){
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=tipwidth
}
if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")
obj.visibility=visible
else if (e.type=="click")
obj.visibility=hidden
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=(whichedge=="rightedge")? parseInt(horizontal_offset)*-1 : parseInt(vertical_offset)*-1
if (whichedge=="rightedge"){
var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth
}
else{
var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight
}
return edgeoffset
}

function displayDormInfo(menucontents, obj, e, tipwidth){
if (window.event) event.cancelBubble=true
else if (e.stopPropagation) e.stopPropagation()
clearhidetip()
dropmenuobj=document.getElementById? document.getElementById("fixedtipdiv") : fixedtipdiv
dropmenuobj.innerHTML=menucontents

if (ie4||ns6){
showhide(dropmenuobj.style, e, "visible", "hidden", tipwidth)
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+"px"
}
}

function hidetip(e){
if (typeof dropmenuobj!="undefined"){
if (ie4||ns6)
dropmenuobj.style.visibility="hidden"
}
}

function displayWelcomeNote(){
if (ie4||ns6)
delayhide=setTimeout("hidetip()",disappeardelay)
}

function clearhidetip(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}
*/

function displayDormInfo(dorm){
	
	
	dormTitle.innerHTML = dorm;
	
	xmlhttpTool = GetXmlHttpObjectTool();
	var url="index.php?c=home&m=setInfoTable";
	url+="&dorm="+dorm;
	xmlhttpTool.onreadystatechange=stateChangedTool;
	xmlhttpTool.open("GET",url,true);
	xmlhttpTool.send(null);
}
function stateChangedTool() 
{ 

if (xmlhttpTool.readyState==4)
{ 	
	document.getElementById("dInfo").innerHTML = "lol";	
document.getElementById("dInfo").innerHTML=xmlhttpTool.responseText;
}else{
	document.getElementById("dInfo").innerHTML = '<img src="IMG/circleload.gif" />';
	
}
}
function displayWelcomeNote(){
	dormTitle.innerHTML = "Welcome";
	dInfo.innerHTML = "Dorma is an abridged version of \"Dorm Manager System\" which lets users store and manipulate relevant records of all dormitories' residents and transients.";

}
function GetXmlHttpObjectTool()
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

