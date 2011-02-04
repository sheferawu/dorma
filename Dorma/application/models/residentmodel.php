<?php 
class Residentmodel extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
	function delete_resident($fname,$lname,$mname){
		
		$con = mysql_connect("localhost","DORMA","dorm");
		
		mysql_select_db("dormdatabase", $con);
		mysql_query("DELETE FROM Resident WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'")or die("Can't Delete ".mysql_error());
		mysql_query("DELETE FROM Scholarship WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		mysql_query("DELETE FROM Custodian WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		mysql_query("DELETE FROM Hobbies WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		mysql_query("DELETE FROM Honors WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		
		mysql_close($con);
		
		
	}
	
	function view_entry($table,$arrcol,$fname,$lname,$mname){
		
		$con = mysql_connect("localhost","DORMA","dorm");
		
		mysql_select_db("dormdatabase", $con);
		
		
		
		$query = "<table>";
		$result = mysql_query("SELECT * FROM $table	
		WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
	
	while($row = mysql_fetch_array($result))
  		{ 
 		foreach($arrcol as $q){
 			if(trim($row[$q])!=""){
 			$query.="<tr><td>".$q.": ".$row[$q]."</td></tr>"; 
 			}
 		} 
  	$query .= "<tr><td>&nbsp</td></tr>";
  	}	
		
	return $query."</table>";
			
	}
	
function add_entry($_POST){
		$con = mysql_connect("localhost","DORMA","dorm");
		$str = "";

	if (!$con){

			die('Could not connect: '.mysql_error());
		}
		
		mysql_select_db("dormdatabase",$con);


		if(isset($_POST['submitResident'])){

		$vc  =new Residentmodel;
		$opt = new OptionClass;
$str.= "New Resident Added<br/>";

	
$Bday = $_POST["Month"]."/".$_POST["Day"]."/".$_POST["Year"];		
$StudentNumber = trim($_POST["Batch"]."-".$_POST["StudNumber"]);
$sql = "Insert into Resident
		Values('$StudentNumber',
		'$_POST[firstname]', 
		'$_POST[middlename]', 
		'$_POST[lastname]', 
		'$Bday ',
		'$_POST[Gender] ', 
		'$_POST[CivilStatus] ', 
		'$_POST[course]', 
		'$_POST[lastSchoolAttended]', 
		'$_POST[SchoolType]', 
		'$_POST[Religion]', 
		'$_POST[classification]', 
		'$_POST[STFAPBracket]', 
		'$_POST[HomeAddress]', 
		'$_POST[Region]', 
		'$_POST[TelephoneNumber] ', 
		'$_POST[Email]', 
		'$_POST[NumBrothers]', 
		'$_POST[NumSisters]', 
		'$_POST[BirthOrder]', 
		'$_POST[Ailments]', 
		'$_POST[Medications]', 
		'$_POST[bfgf]', 
		'$_POST[college]', 
		'$_POST[Age]', 
		'$_POST[RoomNumber]' )";
	mysql_query($sql) or die( "resident".mysql_error());	

$arrcol = $opt->returnFieldsArray("resident");
$str.=$vc->view_entry("resident",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
	
if(isset($_POST["Scholarship"])&&trim($_POST["Scholarship"])!=""){
	
	$sql = "Insert into Scholarship
		Values(
		'$_POST[firstname]', 
		'$_POST[middlename]', 
		'$_POST[lastname]', 
		'$_POST[Scholarship]', 
		'$_POST[MonthlyStipend]' )";
			
mysql_query($sql) or die( "Scholarship".mysql_error());
$arrcol = $opt->returnFieldsArray("Scholarship");
$str.= $vc->view_entry("Scholarship",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
}

if(isset($_POST["Honors"])&&trim($_POST["Honors"])!=""){
	
	$sql = "Insert into honorsreceived
		Values(
		'$_POST[lastname]', , 
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[Honors]' )";
mysql_query($sql) or die( "honors".mysql_error());
$arrcol = $opt->returnFieldsArray("honorsreceived");
$str.= $vc->view_entry("honorsreceived",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
}

if(isset($_POST["HobbyName"])&&trim($_POST["HobbyName"])!=""){
	
	$sql = "Insert into Hobbies
		Values(
		'$_POST[lastname]', , 
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[HobbyName]' )";
mysql_query($sql) or die( "Hobbyname".mysql_error());
$arrcol = $opt->returnFieldsArray("Hobbies");
$str.= $vc->view_entry("Hobbies",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

}

if(isset($_POST["otherSourcesOfIncome"])&&trim($_POST["otherSourcesOfIncome"])!=""){
	
	$sql = "Insert into othersourcesincome
		Values(
		'$_POST[lastname]', , 
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[otherSourcesOfIncome]', 
		'$_POST[otherIncomeAmount]' )";
mysql_query($sql) or die( "other".mysql_error());
$arrcol = $opt->returnFieldsArray("othersourcesincome");
$str.= $vc->view_entry("othersourcesincome",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

}

if(isset($_POST["Org"])&&trim($_POST["Org"])!=""){
	
	$sql = "Insert into othersourcesincome
		Values(
		'$_POST[lastname]', , 
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[Org]' )";
mysql_query($sql) or die( "org".mysql_error());
$arrcol = $opt->returnFieldsArray("othersourcesincome");
$str.= $vc->view_entry("othersourcesincome",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

}

if(isset($_POST["radio_ctr1"])&&trim($_POST["radio_ctr1"])!=""){
	
	$sql = "Insert into othersourcesincome
		Values(
		'$_POST[lastname]', , 
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[radio_ctr1]' )";
mysql_query($sql) or die( "org".mysql_error());
$arrcol = $opt->returnFieldsArray("othersourcesincome");
$str.= $vc->view_entry("othersourcesincome",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

}
$sql = "Insert into Custodian
		Values(
		'$_POST[firstname]', 
	'$_POST[middlename]', 
	'$_POST[lastname] ', 
		'$_POST[cg1name] ', 
		'$_POST[cg2name] ', 
		'$_POST[cg1telno] ', 
		'$_POST[cg2telno] ', 
		'$_POST[cg1add] ', 
		'$_POST[cg2add] ', 
		'$_POST[cmname] ', 
		'$_POST[cmocc] ', 
		'$_POST[cmincome] ', 
		'$_POST[cmemp] ', 
		'$_POST[cmadd] ', 
		'$_POST[cmtelno] ', 
		'$_POST[cfname] ', 
		'$_POST[cfocc] ', 
		'$_POST[cfincome] ', 
		'$_POST[cfemp] ', 
		'$_POST[cfadd] ', 
		'$_POST[cftelno] ', 
		'$_POST[cmliving] ', 
		'$_POST[marriageStatus]' )";

mysql_query($sql) or die( custodianmysql_error());
$arrcol = $opt->returnFieldsArray("Custodian");
$str.= $vc->view_entry("Custodian",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);


}
mysql_close($con);
		
return $str;		
	}
	
}   
 ?>