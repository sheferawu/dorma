<?php 

class Residentmodel extends CI_Model {
 var $db_group_name2 = "dorm";

   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
     $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	$this->load->model('optionmodel');
    }
   function get_database_group() {
        return $this->db_group_name2;
    }
   function  searchGuarantor($str){
   	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    $query = "Select FirstName,MidName,LastName From Resident where FirstName Like '%$str%' OR MidName Like '%$str%' OR LastName Like '%$str%'";
   	$table="<table id=\"sg\" border=\"0\">";
    $res=$this->{$this->db_group_name2}->query($query);
   	if($res->num_rows()>0){
   		$cnt = 0;
   		foreach($res->result() as $r){
   			$r->FirstName = ucwords(strtolower($r->FirstName));
   			$r->MidName = ucwords(strtolower($r->MidName));
   			$r->LastName= ucwords(strtolower($r->LastName));
   			$table.="<tr><td onclick = 'setValue2(this.innerText)' onkeydown='setValue2(this.innerText)'>$r->FirstName $r->MidName  $r->LastName</td></tr>";
   			$cnt++;
   			if($cnt>=2)break;
   		}
   	}else{
   		$table.="<tr><td id=\"nrf\">No Record Found</td></tr>";
   	}
    $table.="</table>";
   	return $table;
   }
   function	getNumApp($fname,$mname,$lname){
  		$query = $this->{$this->db_group_name2}->query("SELECT Count(*) from appliances WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$ar = $query->result();
  		$ar = (array)$ar[0];
    
    	$ar = array_values($ar);
    	return $ar[0];	
   }
   function edit_resident($fname,$lname,$mname){
		
		$_SESSION["fname"] = $fname;
		$_SESSION["lname"] = $lname;
		$_SESSION["mname"] = $mname;
		
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from resident WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		//$this->Optionmodel = new OptionClass();
		$r ="";
		$arrResField = $this->Optionmodel->returnFieldsArray("Resident");
		$cnt = 0;
		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from scholarship WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("scholarship");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from custodian WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("custodian");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from othersourcesincome WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("othersourcesincome");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from hobbies WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("hobbies");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from honorsreceived WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("honorsreceived");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from talent WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("talent");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from org WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("org");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from appliances WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("appliances");
$cnt = 0;
		foreach ($query->result() as $row)
		{
			
			foreach($arrResField as $af){
			$r[$af."".$cnt] = strtolower($row->$af);
			}
			$cnt++;
		}
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from residentloginfo WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("residentloginfo");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->{$this->db_group_name2}->query("SELECT * from reservation WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("reservation");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
	$query = $this->{$this->db_group_name2}->query("SELECT * from residentkey WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $this->Optionmodel->returnFieldsArray("residentkey");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		return $r;		
	}

	    
   function delete_resident($fname,$lname,$mname){
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
	
		//$con = $this->{$this->db_group_name2}->connect("localhost","DORMA","dorm");
		
		//$this->{$this->db_group_name2}->select_db("dormdatabase", $con);
   $this->{$this->db_group_name2}->query("DELETE FROM Resident WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM Scholarship WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM Custodian WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM Hobbies WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM Honorsreceived WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM residentkey WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM residentloginfo WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM violation WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM scholarship WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM talent WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM payment WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		$this->{$this->db_group_name2}->query("DELETE FROM reservation WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		
		//$this->{$this->db_group_name2}->close($con);
		
		
	}
	
   function delete_transient($fname,$lname,$mname){
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
         $this->{$this->db_group_name2}->query("DELETE FROM Transient WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
	}
   function view_entryT($arrcol,$fname,$lname,$mname){
   		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	$query = "<table class='view_trans'>";
		$result = $this->{$this->db_group_name2}->query("SELECT * FROM transient	
		WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		
	foreach($result->result_array() as $row )
  		{ 
		foreach($arrcol as $q){
			if(trim($row[$q])!=""){
 				$title = $q;
				
				if($q=="ControlNumber") $title = "Control Number";
				else if($q=="FillUpDate") $title = "Fill Up Date";
				else if($q=="LastName") $title = "Last Name";
				else if($q=="FirstName") $title = "First Name";
				else if($q=="MidName") $title = "Middle Name";
				else if($q=="TCheckIn") $title = "Time Check In";
				else if($q=="TCheckOut") $title = "Time Check Out";
				else if($q=="RoomAssign") $title = "Room Assignment";
				else if($q=="OrNum") $title = "OR Number";
				else if($q=="AmountPaid") $title = "Amount Paid";
				$item = ucwords(strtolower($row[$q]));
				$query.="<tr><td class=\"field\">".$title.":</td><td>".$item."</td></tr>"; 
			}
			
		}
   }
   return $query."</table>";
   }
	
   function view_entry($table,$arrcol,$fname,$lname,$mname){
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	$query = "<table class='view_resi'>";
		$result = $this->{$this->db_group_name2}->query("SELECT * FROM $table	
		WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
	
	foreach($result->result_array() as $row )
  		{ 
 		foreach($arrcol as $q){
 			if(trim($row[$q])!=""){
 				$title = $q;
 				
 				if ($q == "StudentNumber") $title = "Student Number";
 				else if ($q == "FirstName") $title = "First Name";
 				else if ($q == "MidName") $title = "Middle Name";
 				else if ($q == "LastName") $title = "Last Name";
 				else if ($q == "Bday") $title = "Birthday";
 				else if ($q == "CivStatus") $title = "Civil Status";
 				else if ($q == "LastSchoolAttended") $title = "Last School Attended";
 				else if ($q == "SchoolType") $title = "School Type";
 				else if ($q == "STFAPBracket") $title = "STFAP Bracket";
 				else if ($q == "TelNo") $title = "Telephone Number";
 				else if ($q == "Email") $title = "Email Address";
 				else if ($q == "NumBro") $title = "Number of brother(s)";
 				else if ($q == "NumSis") $title = "Number of sister(s)";
 				else if ($q == "BirthOrder") $title = "Birth Order";
 				else if ($q == "BFGF") $title = "Boyfriend/Girfriend";
 				else if ($q == "RoomNumber") $title = "Room Number";
 				
					$item = ucwords(strtolower($row[$q]));
 				
 				if ($q == "Region"){
 					$item = strtoupper($item);
 				}
 				else if ($q == "Email") $item = strtolower($item);
 				else if ($q == "College" || $q == "Course") $item = strtoupper($item);
 				
				
 				$query.="<tr><td class=\"field\">".$title.":</td><td>".$item."</td></tr>"; 
 			}
 		} 
		
  	}	
		
	return $query."</table>";
			
	}
	
   function editT($arrTrans,$_GET){
   	$fname =$_GET["fname"];
   	$mname =$_GET["mname"];
   	$lname =$_GET["lname"];

   
   	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    $query = "SELECT * from transient where FirstName = '$fname' and MidName = '$mname' and LastName = '$lname'";		
    $result = $this->{$this->db_group_name2}->query($query); 	
   	$arr = "";	
   	
    foreach($result->result() as $row){
   			foreach($arrTrans as $at){
   			$arr[$at] = $row->$at;
   			}
   		
    	}
    	return $arr ; 
   }
	
   function add_transientEntry($_POST){
		$str="";
   		$arrayKeys = array_keys($_POST);
		$arrayValues = array_values($_POST);
		for($i=0;$i<count($arrayValues);$i++){
			if($arrayValues[$i]!=""){
		
			$_POST["$arrayKeys[$i]"]=strtoupper($arrayValues[$i]);
			
			}else{
				$_POST["$arrayKeys[$i]"]="";
			
			}
		}
		
		if(isset($_POST['submitTransient'])){
			$vc  = new Residentmodel;
		
			$_SESSION["newResidentInfo"]= "New Transient Added<br/>";
			
			$checkIn = $_POST["MonthIn"]."/".$_POST["DayIn"]."/".$_POST["YearIn"];
			$checkOut = $_POST["MonthOut"]."/".$_POST["DayOut"]."/".$_POST["YearOut"];
			$co = str_replace("/","",$checkOut);
			$co = str_replace("0","",$co);
			
			if($co ==""){
				$checkOut ="";
			}
			
			
			$sql = "Insert into transient values
					('$_POST[ControlNum]',
					'$_POST[Date]',
					'$_POST[lastname]',
					'$_POST[firstname]',
					'$_POST[middlename]',
					'$_POST[purpose]',
					'$_POST[Emergency]',
					'$_POST[dormName]',
					'$checkIn',
					'$_POST[tcheckin]',
					'$checkOut',
					'$_POST[tcheckout]',
					'$_POST[bedding]',
					'$_POST[roomassign]',
					'$_POST[ornum]',
					'$_POST[guarantor]',
					'$_POST[type]',
					'$_POST[rates]',
					'$_POST[amount]',
					$_POST[MonthIn]					
					)";
			
			$this->{$this->db_group_name2}->query($sql);
		}
		$_SESSION["trans"] = "Transient Added!<br/>";
	}
   function add_entry($_POST){
   		
   		$str="";
   		$fname = $_POST["firstname"]; 
		$mname = $_POST["middlename"]; 
		$lname = $_POST["lastname"];
		
$sql = "SELECT LastName from resident where LastName = '$lname' and MidName = '$mname' and FirstName = '$fname'";		
  $result= $this->{$this->db_group_name2}->query($sql);	
	$temp ="";	
  foreach($result->result() as $row){
			$temp =  "Resident not added!<br/>$fname $mname $lname is already on the record!";
		}
  	if($temp!=""){
  		return $temp;
  	}
  	
  	$arrayKeys = array_keys($_POST);
		$arrayValues = array_values($_POST);
		for($i=0;$i<count($arrayValues);$i++){
			if($arrayValues[$i]!=""){
		
			$_POST["$arrayKeys[$i]"]=strtoupper($arrayValues[$i]);
			
			}else{
				$_POST["$arrayKeys[$i]"]="";
			
			}
		}

		if(isset($_POST['submitResident'])){

		$vc  =new Residentmodel;
		//$this->Optionmodel = new OptionClass;
$str.= "<h3>New Resident Added</h3>";
$str.= "Name: $_POST[firstname] $_POST[middlename] $_POST[lastname]<br/><hr/><br/>";
		
	
$Bday = $_POST["Month"]."/".$_POST["Day"]."/".$_POST["Year"];		
$StudentNumber = trim($_POST["Batch"]."-".$_POST["StudNumber"]);
$form =$_POST["form5"];
 $sql = "SELECT LastName from resident where StudentNumber  ='$StudentNumber'";		
  $result= $this->{$this->db_group_name2}->query($sql);	
	
   $temp ="";	
  foreach($result->result() as $row){
			$temp =  "Resident not added!<br/>$fname $mname $lname's student number ($StudentNumber) is already on the record!";
		}
  	if($temp!=""){
  		return $temp;
  	}


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
		'$_POST[room]')";
		 $this->{$this->db_group_name2}->query($sql);	

$arrcol = $this->Optionmodel->returnFieldsArray("resident");
$str.=$this->Optionmodel->viewTable("resident",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
	
if(isset($_POST["Scholarship"])&&trim($_POST["Scholarship"])!=""){
	
	$sql = "Insert into Scholarship
		Values(
		'$_POST[firstname]', 
		'$_POST[middlename]', 
		'$_POST[lastname]', 
		'$_POST[Scholarship]', 
		'$_POST[MonthlyStipend]' )";
			
 $this->{$this->db_group_name2}->query($sql);
$arrcol = $this->Optionmodel->returnFieldsArray("Scholarship");
$str.= $this->Optionmodel->viewTable("Scholarship",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
}

if(isset($_POST["Honors"])&&trim($_POST["Honors"])!=""){
	
	$sql = "Insert into honorsreceived
		Values(
		'$_POST[lastname]',
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[Honors]' )";
$this->{$this->db_group_name2}->query($sql);
$arrcol = $this->Optionmodel->returnFieldsArray("honorsreceived");
$str.= $this->Optionmodel->viewTable("honorsreceived",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
}

if(isset($_POST["HobbyName"])&&trim($_POST["HobbyName"])!=""){
	
	$sql = "Insert into Hobbies
		Values(
		'$_POST[lastname]',
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[HobbyName]' )";
$this->{$this->db_group_name2}->query($sql) ;
$arrcol = $this->Optionmodel->returnFieldsArray("Hobbies");
$str.= $this->Optionmodel->viewTable("Hobbies",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

}

if(isset($_POST["otherSourcesOfIncome"])&&trim($_POST["otherSourcesOfIncome"])!=""){
	
	$sql = "Insert into othersourcesincome
		Values(
		'$_POST[lastname]', 
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[otherSourcesOfIncome]', 
		'$_POST[otherIncomeAmount]' )";
$this->{$this->db_group_name2}->query($sql);
$arrcol = $this->Optionmodel->returnFieldsArray("othersourcesincome");
$str.= $this->Optionmodel->viewTable("othersourcesincome",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

}

if(isset($_POST["Org"])&&trim($_POST["Org"])!=""){
	
	$sql = "Insert into Org
		Values(
		'$_POST[lastname]',
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[Org]' )";
$this->{$this->db_group_name2}->query($sql);
$arrcol = $this->Optionmodel->returnFieldsArray("org");
$str.= $this->Optionmodel->viewTable("org",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

}

if(isset($_POST["radio_ctr1"])&&trim($_POST["radio_ctr1"])!=""){
	
	$sql = "Insert into othersourcesincome
		Values(
		'$_POST[lastname]', 
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[radio_ctr1]' )";
$this->{$this->db_group_name2}->query($sql);
$arrcol = $this->Optionmodel->returnFieldsArray("othersourcesincome");
$str.= $this->Optionmodel->viewTable("othersourcesincome",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

}
if($_POST["cg1name"]!=""&&$_POST["cg2name"]!=""&&$_POST["cfname"]!=""&&$_POST["cfname"]!=""){
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

$this->{$this->db_group_name2}->query($sql);
$arrcol = $this->Optionmodel->returnFieldsArray("Custodian");
$str.= $this->Optionmodel->viewTable("Custodian",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
}

}




$getTerm = "Select Term from dorm";
$t = $this->{$this->db_group_name2}->query($getTerm);

foreach($t->result() as $row)
	$term = $row->Term;

$date = $_POST["MonthR"]."/".$_POST["DayR"]."/".$_POST["YearR"];	
	
$sql = "insert into reservation
		values (
		'$_POST[lastname]',
		'$_POST[middlename]', 
		'$_POST[firstname]',
		'$term',
		'$_POST[OrNum]', 
		'$_POST[Amount]',
		'$_POST[Remarks]',
		'$date')";

$this->{$this->db_group_name2}->query($sql);


$dateReceived = $_POST["MonthRec"]."/".$_POST["DayRec"]."/".$_POST["YearRec"];	
$dateReturned = $_POST["MonthRet"]."/".$_POST["DayRet"]."/".$_POST["YearRet"];	

$sql = "insert into residentkey
		values (
		'$_POST[lastname]',
		'$_POST[middlename]', 
		'$_POST[firstname]',
		'$term',
		'$_POST[OrNumKey]',
		'$_POST[AmountKey]',
		'$dateReceived',
		'$dateReturned',
		'$_POST[RemarksKey]')";
$this->{$this->db_group_name2}->query($sql);


$checkIn = $_POST["MonthLI1"]."/".$_POST["DayLI1"]."/".$_POST["YearLI1"];	
$checkOut = $_POST["MonthLI2"]."/".$_POST["DayLI2"]."/".$_POST["YearLI2"];	
if(str_replace("/","",$checkOut)==""){
	$checkOut ="";
}

$sql = "Insert into residentloginfo
		Values(
		'$_POST[lastname]',
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$checkIn',
		'$checkOut',
		'$_POST[form5]',
		'$_POST[room]',
		'$term' )";
$this->{$this->db_group_name2}->query($sql);
$arrcol = $this->Optionmodel->returnFieldsArray("residentloginfo");
$str.= $this->Optionmodel->viewTable("residentloginfo",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
   
if(isset($_SESSION["numApp"])){
	$numApp= $_SESSION["numApp"]-1;
	//echo $numApp."<br/>";
	if($numApp>0){
		$cnt = 0;
	
		for($cnt=0;$cnt<$numApp;$cnt++){
			
			
		$appName = $_POST["ApplianceName".$cnt];
		
		$_POST["dateInstalled".$cnt] = $_POST["dateInstalledMonth".$cnt]."/".$_POST["dateInstalledDay".$cnt]."/".$_POST["dateInstalledYear".$cnt];
		
		$dateInstalled = $_POST["dateInstalled".$cnt];
		
		$cnum = $_POST["controlNum".$cnt];
		if(strtoupper($appName)!="NONE"&&$appName!=""&&$cnum!=""&&$cnum!=0){	
		$sql = "Insert into Appliances(LastName,FirstName,MidName,AppName,DateInstalled,CTRLNum,RumNum)
		Values(
		'$_POST[lastname] ', 
		'$_POST[firstname]', 
	    '$_POST[middlename]', 
	    '$appName',
	    '$dateInstalled',
	    '$cnum',
	    '$_POST[room]'
	    )";
		$this->{$this->db_group_name2}->query($sql);
		}
		
		}
	}
}


		
return $str;		
}
   function getDateCheckIn($fname,$mname,$lname){
					$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
					$this->{$this->db_group_name2}->select('DateCheckIn, DateCheckOut');
					$this->{$this->db_group_name2}->where('LastName', $lname);
					$this->{$this->db_group_name2}->where('FirstName', $fname);
					$this->{$this->db_group_name2}->where('MidName', $mname);
					$this->{$this->db_group_name2}->from('residentloginfo');
					$log = $this->{$this->db_group_name2}->get();
					$in = "";
  					foreach ($log->result() as $row)
					{	
						if($row->DateCheckOut==""){
							$in =$row->DateCheckIn; 
						}
						
					}
			return $in;
	}
	
   function getTransientRate($fname,$mname,$lname){
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
					$this->{$this->db_group_name2}->select('Rates');
					$this->{$this->db_group_name2}->where('LastName', $lname);
					$this->{$this->db_group_name2}->where('FirstName', $fname);
					$this->{$this->db_group_name2}->where('MidName', $mname);
					$this->{$this->db_group_name2}->from('transient');
					$log = $this->{$this->db_group_name2}->get();
					$rate = "";
  					foreach ($log->result() as $row)
					{	
						
							$rate =$row->Rates; 
						
						
					}
			return $rate;
	}

   function getApp($fname,$mname,$lname){
  					$arr = "";

  					  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
					$this->{$this->db_group_name2}->select('AppName,DateInstalled,DateCancelled');
					$this->{$this->db_group_name2}->where('LastName', $lname);
					$this->{$this->db_group_name2}->where('FirstName', $fname);
					$this->{$this->db_group_name2}->where('MidName', $mname);
					$this->{$this->db_group_name2}->from('appliances');
					$app = $this->{$this->db_group_name2}->get();
  					$cnt =0;
					foreach ($app->result() as $row)
					{	if($row->DateCancelled==""){
						$arr[$cnt] = $row->AppName."@".$row->DateInstalled;
						$cnt++;
						
					}
					}
			return $arr; 	
  	}
   function getAppRecords(){
  					$arr = "";
  					  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
					$this->{$this->db_group_name2}->select('*');
					$this->{$this->db_group_name2}->from('appliances');
					$this->{$this->db_group_name2}->order_by("LastName","asc");
					$app = $this->{$this->db_group_name2}->get();
  					$cnt =0;
					foreach ($app->result() as $row)
					{	
						$arr[$cnt] = $row->CTRLNum."@".$row->LastName.", ". $row->FirstName." ".$row->MidName."@". $row->RumNum."@". $row->AppName."@".$row->DateInstalled."@".$row->DateCancelled."@".$row->Remarks;
						$cnt++;
					}
			return $arr; 	
  	}

   function setBalanceFromPay($fname,$mname,$lname){
 			 		$bool = false;
  					  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
					$this->{$this->db_group_name2}->select('Total');
					$this->{$this->db_group_name2}->where('LastName', $lname);
					$this->{$this->db_group_name2}->where('FirstName', $fname);
					$this->{$this->db_group_name2}->where('MidName', $mname);
					$this->{$this->db_group_name2}->from('balance');
					$bal = $this->{$this->db_group_name2}->get();
					
					
					$this->{$this->db_group_name2}->select('DormFee,AppFee,TransFee');
					$this->{$this->db_group_name2}->where('LastName', $lname);
					$this->{$this->db_group_name2}->where('FirstName', $fname);
					$this->{$this->db_group_name2}->where('MidName', $mname);
					$this->{$this->db_group_name2}->from('payment');
					$pay = $this->{$this->db_group_name2}->get();
					if(count($pay->result())>0&&count($bal->result())>0){
					$df="";
					$af="";
					$tf="";
					foreach($pay->result() as $row){
						$df=$row->DormFee;
						$af=$row->AppFee;
						$tf=$row->TransFee;
					}
					
					foreach($pay->result() as $row){
						$totalBal=$row->DormFee;
					}
					$df =  explode("@",$df);
					$af =  explode("@",$af);
					$tf =  explode("@",$tf);
					$len = count($df);
					$totalPay="0";
					for($c=0;$c<$len;$c++){
						bcscale(2);
						 $temp= bcadd($df[$c],$af[$c],$tf[$c]);
						$totalPay =bcadd($total,$temp);
					}
						  $totalPay."lol</br>";
						$totalBal."lol</br>";
						
						$diff = bcsub($totalBal ,$totalPay);
						$diff."</br>";
						if($diff<=0){
								$this->{$this->db_group_name2}->where('LastName', $lname);
								$this->{$this->db_group_name2}->where('FirstName', $fname);
								$this->{$this->db_group_name2}->where('MidName', $mname);
								$this->{$this->db_group_name2}->delete('balance');
							}else{
								$bool = true;
							}
					
					}
			
			return $bool;		
					
					
  	}
  	
   function setBalance($fname,$mname,$lname,$period,$residentFee,$appFee,$total){
					
					  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
					$this->{$this->db_group_name2}->select('FirstName,LastName');
					$this->{$this->db_group_name2}->where('LastName', $lname);
					$this->{$this->db_group_name2}->where('FirstName', $fname);
					$this->{$this->db_group_name2}->where('MidName', $mname);
					$this->{$this->db_group_name2}->from('balance');
					$bal = $this->{$this->db_group_name2}->get();
					
				if(count($bal->result())<1){
					$data = array(
               				'FirstName' => "$fname" ,
               				'MidName' => "$mname" ,
               				'LastName' => "$lname",
           		 			'PeriodCovered' => "$period",
							'ResidentFee' => "$residentFee",
							'AppFee' => "$appFee",
							'Total' => "$total"
							
					);	
					$this->{$this->db_group_name2}->insert('balance', $data);
				}else{
					$data = array(
           		 			'PeriodCovered' => "$period",
							'ResidentFee' => "$residentFee",
							'AppFee' => "$appFee",
							'Total' => "$total"
							
					);
					$this->{$this->db_group_name2}->where('LastName', $lname);
					$this->{$this->db_group_name2}->where('FirstName', $fname);
					$this->{$this->db_group_name2}->where('MidName', $mname);
					$this->{$this->db_group_name2}->update('balance', $data); 
					
				}

				 
	}
  
   function tally_resident($temp){
		//$con = $this->{$this->db_group_name2}->connect("localhost","DORMA","dorm");
		//$this->{$this->db_group_name2}->select_db("dormdatabase", $con);
	$arr = "";	
	
   	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	$sql = "Select Count(*) from Resident";
     	 $ar= $this->{$this->db_group_name2}->query($sql)->result();
    	
    	$ar = (array)$ar[0];
    
    	$ar = array_values($ar);
    	
    	
    	if($ar[0]>0){
		
    	 $sql = "Select Count(*) from Resident where Gender='MALE'";
		
    	$result[0] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());

		$sql = "Select Count(*) from Resident where Gender='FEMALE'";
		$result[1] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Classification = 'FRESHMAN'";
		$result[2] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Classification = 'FRESHMAN'";
		$result[3] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Classification = 'SOPHOMORE'";
		$result[4] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Classification = 'SOPHOMORE'";
		$result[5] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Classification = 'JUNIOR'";
		$result[6] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Classification = 'JUNIOR'";
		$result[7] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Classification = 'SENIOR'";
		$result[8] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Classification = 'SENIOR'";
		$result[9] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		if($temp==1){
		$sql = "Select Count(*) from Resident where College = 'CA'";
		$result[10] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where College = 'CAS'";
		$result[11] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where College = 'CA-CAS'";
		$result[12] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where College = 'CDC'";
		$result[13] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where College = 'CEAT'";
		$result[14] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where College = 'CEM'";
		$result[15] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where College = 'CFNR'";
		$result[16] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where College = 'CHE'";
		$result[17] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where College = 'CVM'";
		$result[18] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONI'";
		$result[19] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONI'";
		$result[20] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONII'";
		$result[21] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONII'";
		$result[22] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONIII'";
		$result[23] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONIII'";
		$result[24] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and (Region = 'REGIONIV-A' or Region = 'REGIONIV-B')";
		$result[25] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and (Region = 'REGIONIV-A' or Region = 'REGIONIV-B')";
		$result[26] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONV'";
		$result[27] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONV'";
		$result[28] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONVI'";
		$result[29] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONVI'";
		$result[30] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONVII'";
		$result[31] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONVII'";
		$result[32] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONVIII'";
		$result[33] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONVIII'";
		$result[34] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONIX'";
		$result[35] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONIX'";
		$result[36] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONX'";
		$result[37] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONX'";
		$result[38] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONXI'";
		$result[39] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONXI'";
		$result[40] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONXII'";
		$result[41] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONXII'";
		$result[42] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONXIII'";
		$result[43] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONXIII'";
		$result[44] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'NCR'";
		$result[45] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'NCR'";
		$result[46] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'CAR'";
		$result[47] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'CAR'";
		$result[48] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'CARAGA'";
		$result[49] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'CARAGA'";
		$result[50] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'ARMM'";
		$result[51] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'ARMM'";
		$result[52] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select MaleOccupant from dorm";
		$result[53] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "Select FemaleOccupant from dorm";
		$result[54] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		}
		for($i = 0; $i < count($result); $i++){
			$ar = $result[$i]->result();
			
    		 $ar = (array)$ar[0];
    		 $ar = array_values($ar);
    		$arr[$i] = $ar[0];
		}
    	}
		return $arr;
	}
   
   function createBalanceTable($fname,$lname,$mname){
		
					  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
					$this->{$this->db_group_name2}->select('PeriodCovered,ResidentFee,Appfee,TransFee,Total');
					$this->{$this->db_group_name2}->where('LastName', $lname);
					$this->{$this->db_group_name2}->where('FirstName', $fname);
					$this->{$this->db_group_name2}->where('MidName', $mname);
					$this->{$this->db_group_name2}->from('balance');
					$bal = $this->{$this->db_group_name2}->get();
				$table="<table class=\"balance_table\">";
				$table.="<tr><th>PeriodCovered</th><th>Resident Fee</th><th>AppFee Fee</th><th>Trans Fee</th><th>Total</th></tr>";	
				foreach($bal->result() as $b){
					$table.="<tr>";
					$table.="<td>$b->PeriodCovered</td>";
					$table.="<td>$b->ResidentFee</td>";
					$table.="<td>$b->Appfee</td>";
					$table.="<td>$b->TransFee</td>";
					$table.="<td>$b->Total</td>";
					$table.="</tr>";
					
				}
				
				$table.="</table>";
	return $table;	
}
   
   function queryThis($q,$id){
   	  $query = $this->{$this->db_group_name2}->query($q);
	  $arr = "";
	  $cnt = 0;
	  foreach($query->result() as $row  ){
	  	if($id!="ALL"){
	  	$arr[$cnt++] = $row->$id;
	  	}else{
	  	$arr[$cnt++] = $row->LastName.", ".$row->FirstName." ".$row->MidName;
	  		
	  	}
	  }
   	return $arr; 
   }
  
   function viewCustodian($arrcol,$fname,$lname,$mname){
		  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
		
		$query =  $this->{$this->db_group_name2}->query("SELECT * FROM Custodian	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
			
		$result = "<table class=\"custodian_table\">";
				
		foreach($query->result_array() as $row)
  		{ 
			foreach($arrcol as $q){
				if(trim($row[$q])!=""){
				
					/* Exclude reisdent's name */
					if ($q == "FirstName") continue;
					if ($q == "MidName") continue;
					if ($q == "LastName") continue;
					
					$title = $q;
					
					if ($q == "Guardian1") $title = "Guardian 1";
					else if ($q == "Guardian2") $title = "Guardian 2";
					else if ($q == "Guardian1tel") $title = "Telephone no.";
					else if ($q == "Guardian2tel") $title = "Telephone no.";
					else if ($q == "Guardian1add") $title = "Address";
					else if ($q == "Guardian2add") $title = "Address";
					else if ($q == "MotherName") $title = "Mother's Name";
					else if ($q == "MotherOccupation") $title = "Occupation";
					else if ($q == "MotherMonthlyIncome") $title = "Monthly Income";
					else if ($q == "MotherEmployer") $title = "Employer";
					else if ($q == "MotherOfficeAddress") $title = "Office Address";
					else if ($q == "MTelNo") $title = "Telephone no.";
					else if ($q == "FatherName") $title = "Father's Name";
					else if ($q == "FatherOccupation") $title = "Occupation";
					else if ($q == "FatherMonthlyIncome") $title = "Monthly Income";
					else if ($q == "FatherEmployer") $title = "Employer";
					else if ($q == "FatherOfficeAddress") $title = "Office Address";
					else if ($q == "FTelNo") $title = "Telephone no.";
					else if ($q == "LivingStat") $title = "Status";
					else if ($q == "MarriageStatus") $title = "Marriage Status";
					
					$item = ucwords(strtolower($row[$q]));
					
					if ($q == "LivingStat"){
						if (strtoupper($item) == "BOTH") $item = "Both living";
						else if (strtoupper($item) == "F_DECEASED") $item = "Deceased father";
						else if (strtoupper($item) == "M_DECEASED") $item = "Deceased mother";
						else if (strtoupper($item) == "BOTH_DECEASED") $item = "Both deceased";
					}
					
					$result.="<tr><td class=\"field\">".$title.":</td><td>".$item."</td></tr>"; 
				}
			} 

		
			
		}
		
		return $result."</table>";
	}	//end of viewCustodian
	
   function viewOtherInfo($arrcol1,$arrcol2,$arrcol3,$arrcol4,$arrcol5,$fname,$lname,$mname){
		
		  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
	
		
		/*	Scholarship	*/
		$query = $this->{$this->db_group_name2}->query("SELECT * FROM scholarship	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
			
		$result = "<table class=\"otherInfo_table\">";
			
				
		foreach($query->result() as $row)
  		{ 
			
			foreach($arrcol1 as $q){
				if(trim($row[$q])!=""){
				
					/* Exclude reisdent's name */
					if ($q == "FirstName") continue;
					if ($q == "MidName") continue;
					if ($q == "LastName") continue;
					
					$title = $q;
					
					if ($q == "ScholarshipName") $title = "Scholarship";
					else if ($q == "MonthlyStipend") $title = "Monthly Stipend";
					
					$item = ucwords(strtolower($row[$q]));
					
					$result.="<tr><td class=\"field\">".$title.":</td><td>".$item."</td></tr>"; 
				}
			}

			$result.="<tr><td colspan=\"2\">&nbsp;</td></tr>";
		}
		
		/*	Honors	*/
		$query = $this->{$this->db_group_name2}->query("SELECT * FROM honorsreceived	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
				
		foreach($query->result_array() as $row)
  		{ 
			foreach($arrcol2 as $q){
				if(trim($row[$q])!=""){
				
					/* Exclude reisdent's name */
					if ($q == "FirstName") continue;
					if ($q == "MidName") continue;
					if ($q == "LastName") continue;
					
					$title = $q;
					$item = ucwords(strtolower($row[$q]));
					
					$result.="<tr><td class=\"field\">".$title.":</td><td>".$item."</td></tr>"; 
				}
			}

			$result.="<tr><td colspan=\"2\">&nbsp;</td></tr>";
		}
		
		/*	Hobbies	*/
		$query = $this->{$this->db_group_name2}->query("SELECT * FROM hobbies	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
				
		foreach($query->result() as $row)
  		{ 
			foreach($arrcol3 as $q){
				if(trim($row[$q])!=""){
				
					/* Exclude reisdent's name */
					if ($q == "FirstName") continue;
					if ($q == "MidName") continue;
					if ($q == "LastName") continue;
					
					$title = $q;
					$item = ucwords(strtolower($row[$q]));
					
					if ($q == "HobbyName") $title = "Hobby";
					$result.="<tr><td class=\"field\">".$title.":</td><td>".$item."</td></tr>"; 
				}
			}

			$result.="<tr><td colspan=\"2\">&nbsp;</td></tr>";
		}
		
		/*	Other Sources of Income	*/
		$query = $this->{$this->db_group_name2}->query("SELECT * FROM othersourcesincome	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
				
		foreach($query->result_array() as $row)
  		{ 
			foreach($arrcol4 as $q){
				if(trim($row[$q])!=""){
				
					/* Exclude reisdent's name */
					if ($q == "FirstName") continue;
					if ($q == "MidName") continue;
					if ($q == "LastName") continue;
					
					$title = $q;
					
					if ($q == "OtherSources") $title = "Other Sources of Income";
					$item = ucwords(strtolower($row[$q]));
					
					$result.="<tr><td class=\"field\">".$title.":</td><td>".$item."</td></tr>"; 
				}
			}

			$result.="<tr><td colspan=\"2\">&nbsp;</td></tr>";
		}
		
		/*	Org	*/
		$query = $this->{$this->db_group_name2}->query("SELECT * FROM org	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
				
		foreach($query->result_array() as $row)
  		{ 
			foreach($arrcol5 as $q){
				if(trim($row[$q])!=""){
				
					/* Exclude reisdent's name */
					if ($q == "FirstName") continue;
					if ($q == "MidName") continue;
					if ($q == "LastName") continue;
					
					$title = $q;
					$item = ucwords(strtolower($row[$q]));
					
					if ($q == "OrgName") $title = "Organization";
					
					$result.="<tr><td class=\"field\">".$title.":</td><td>".$item."</td></tr>"; 
				}
			}
		}
		
		return $result."</table>";
	}	//end of viewOtherInfo
	
   function viewAppliances($fname,$lname,$mname){
		  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
		
		$this->{$this->db_group_name2}->select('CTRLNum, RumNum, AppName, Term, DateInstalled, DateCancelled, Remarks');
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->from('appliances');
		$app = $this->{$this->db_group_name2}->get();
		
		$result = "
					<form action=\"index.php?c=resident&m=updateApp\" method=\"POST\" name=\"checkOutApp\"\">
					<table class=\"appliance_table\"><tr><th>CTRL No</th><th>Room No</th><th>Appliance</th>
					<th>Term</th><th>Date Installed</th><th>Date Cancelled</th><th>Remarks</th>";
		
		$cnt = 0;
		
		if ($app->num_rows() > 0)
		{	
			$_SESSION["fname"] = $fname;
			$_SESSION["lname"] = $lname;
			$_SESSION["mname"] = $mname;
			
			foreach ($app->result() as $row)
			{	
				/*$app = strtolower($row->AppName);
				if ($app == "ef") $app = "Electric Fan";
				else if ($app == "cw/p") $app = "Computer w/ printer";
				else if ($app == "cw/op") $app = "Computer w/o printer";
				
				$app = ucwords($app);*/
				
				$_SESSION["appCtrlNum$cnt"] = $row->CTRLNum;
				
				$result.="<tr>";
				$result.="<td>".$row->CTRLNum."</td>";
				$result.="<td>".$row->RumNum."</td>";
				$result.="<td>".$row->AppName."</td>";
				$result.="<td>".$row->Term."</td>";
				$result.="<td>".$row->DateInstalled."</td>";
					
				if ($row->DateCancelled == "")
					$result.="<td><input type=\"text\" size=\"12\" name=\"dateCancelled$cnt\"/></td>";
				else
					$result.="<td>".$row->DateCancelled."</td>";
					
				$result.="<td>".$row->Remarks."</td>";
				$result.="</tr>";
				$cnt++;
			}
			
			$result.= "<tr><td colspan=\"7\"><center><input type=\"submit\" name=\"checkOutApp\"/></center></td></tr>";
			
		}
		
		$_SESSION["appCount"] = $cnt;
		
		return $result."</table></form>";
	}	//end of viewAppliances
	
	
   function updateAppliance($_POST, $LastName, $MidName, $FirstName){
		$arrayKeys = array_keys($_POST);
		$arrayValues = array_values($_POST);
		
		for($i=0;$i<count($arrayValues);$i++){
			if($arrayValues[$i]!=""){
		
			$_POST["$arrayKeys[$i]"]=strtoupper($arrayValues[$i]);
			
			}else{
				$_POST["$arrayKeys[$i]"]="";
			
			}
		}
		
		  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
		
		
		$count = 0;
		
		for ($count = 0; $count < $_SESSION["appCount"]; $count++){
			if (isset($_POST["dateCancelled$count"])){
			$date = $_POST["dateCancelled$count"];
			$CTRLNum = $_SESSION["appCtrlNum$count"];
			
			$data = array(
	               'DateCancelled' => $date
	       	);

	       	$CTRLNum = $_SESSION["appCtrlNum$count"];
	       	
			
			$this->{$this->db_group_name2}->where('CTRLNum', $CTRLNum);
			$this->{$this->db_group_name2}->update('appliances', $data);
			} 			
		}
		
		unset($_SESSION["fname"]);
		unset($_SESSION["lname"]);
		unset($_SESSION["mname"]);
		
		for ($i = 0; $i< $_SESSION["appCount"]; $i++)
			unset($_SESSION["DateCancelled$i"]);
		
		unset($_SESSION["appCount"]);
		
	}	//end of updateAppliance
	
	
   function updateTransient($_POST,$fname,$mname,$lname){
	$arrayKeys = array_keys($_POST);
		$arrayValues = array_values($_POST);
		
		for($i=0;$i<count($arrayValues);$i++){
			if($arrayValues[$i]!=""){
		
			$_POST["$arrayKeys[$i]"]=strtoupper($arrayValues[$i]);
			
			}else{
				$_POST["$arrayKeys[$i]"]="";
			
			}
		}
		
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
		
		$checkIn = $_POST["MonthIn"]."/".$_POST["DayIn"]."/".$_POST["YearIn"];
$checkOut = $_POST["MonthOut"]."/".$_POST["DayOut"]."/".$_POST["YearOut"];

	$data = array(
				'ControlNumber' => strtoupper($_POST["ControlNum"]),
				'FillUpDate' => strtoupper($_POST["Date"]),
				'LastName' => strtoupper($_POST["lastname"]),
				'FirstName' => strtoupper($_POST["firstname"]),
				'MidName' => strtoupper($_POST["middlename"]),
				'Purpose' => strtoupper($_POST["purpose"]),
				'Emergency' => strtoupper($_POST["Emergency"]),
				'Dorm' => strtoupper($_POST["dormName"]),
				'Emergency' => strtoupper($_POST["Emergency"]),
				'CheckIn' => $checkIn,
				'TCheckIn' => strtoupper($_POST["tcheckin"]),
				'CheckOut' => $checkIn,
				'TCheckOut' => strtoupper($_POST["tcheckout"]),
				'Bedding' => strtoupper($_POST["bedding"]),
				'RoomAssign' => strtoupper($_POST["roomassign"]),
				'OrNum' => strtoupper($_POST["ornum"]),
				'Guarantor' => strtoupper($_POST["guarantor"]),
				'Type' => strtoupper($_POST["type"]),
				'Rates' => strtoupper($_POST["rates"]),
				'AmountPaid' => strtoupper($_POST["amount"]));
	
		$this->{$this->db_group_name2}->where('FirstName', $fname);
			$this->{$this->db_group_name2}->where('LastName', $lname);
			$this->{$this->db_group_name2}->where('MidName', $mname);
			$this->{$this->db_group_name2}->update('transient', $data);
		
	}
	
   function updateResident($_POST, $fname, $lname, $mname,$numApp){
		$arrayKeys = array_keys($_POST);
		$arrayValues = array_values($_POST);
		
		for($i=0;$i<count($arrayValues);$i++){
			if($arrayValues[$i]!=""){
		
			$_POST["$arrayKeys[$i]"]=strtoupper($arrayValues[$i]);
			
			}else{
				$_POST["$arrayKeys[$i]"]="";
			
			}
			
			
		}
		
		
		
	  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
		
		$stdNo = trim($_POST["Batch"]."-".$_POST["StudNumber"]);
		$Bday = $_POST["Month"]."/".$_POST["Day"]."/".$_POST["Year"];
		/*
		if($_POST["roomSem1"]!=""){
			$RoomNumber=$_POST["roomSem1"];
		}else if($_POST["roomSem2"]!=""){
				$RoomNumber=$_POST["roomSem2"];
			
		}else if($_POST["roomSemS"]!=""){
				$RoomNumber=$_POST["roomSemS"];
			
		}else{	$RoomNumber="";}
		*/
		
		$data = array(
        	'StudentNumber' => $stdNo,
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'Bday' => $Bday,
			'Gender' => strtoupper($_POST["Gender"]),
			'CivStatus' => strtoupper($_POST["CivilStatus"]),
			'Course' => strtoupper($_POST["course"]),
			'LastSchoolAttended' => strtoupper($_POST["lastSchoolAttended"]),
			'SchoolType' => strtoupper($_POST["SchoolType"]),
			'Religion' => strtoupper($_POST["Religion"]),
			'Classification' => strtoupper($_POST["classification"]),
			'STFAPBracket' => strtoupper($_POST["STFAPBracket"]),
			'Address' => strtoupper($_POST["HomeAddress"]),
			'Region' => strtoupper($_POST["Region"]),
			'TelNo' => strtoupper($_POST["TelephoneNumber"]),
			'Email' => strtoupper($_POST["Email"]),
			'NumBro' => strtoupper($_POST["NumBrothers"]),
			'NumSis' => strtoupper($_POST["NumSisters"]),
			'BirthOrder' => strtoupper($_POST["BirthOrder"]),
			'Ailments' => strtoupper($_POST["Ailments"]),
			'Medications' => strtoupper($_POST["Medications"]),
			'BFGF' => strtoupper($_POST["bfgf"]),
			'College' => strtoupper($_POST["college"]),
			//'Age' => strtoupper($_POST["Age"]),
			'RoomNumber' => $_POST["room"]
       	);
		
		
		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('resident', $data);
		
		
		/* Update all other tables
		 * When name is changed, we need to update all tables since it is the primary key */
		
		/* UPDATE APPLIANCES */
	if($numApp>0){
		$this->{$this->db_group_name2}->query("DELETE FROM Appliances WHERE FirstName= '$_POST[firstname]' AND LastName= '$_POST[lastname]' AND MidName= '$_POST[middlename]'");
		
		for($jj = 0 ;$jj<$numApp-1;$jj++){
		if($_POST["ApplianceName".$jj]!="NONE"){
		$dateIn = $_POST["dateInstalledMonth".$jj]."/".$_POST["dateInstalledDay".$jj]."/".$_POST["dateInstalledYear".$jj];
		
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'CTRLNum' => $_POST["controlNum".$jj],
			'AppName' =>$_POST["ApplianceName".$jj],
			'DateInstalled' =>$dateIn
       	);

		$this->{$this->db_group_name2}->insert('appliances', $data);
	}
	}
	}
		/* UPDATE BALANCE */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"])
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('balance', $data);
		
		/* UPDATE CUSTODIAN */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'Guardian1' => strtoupper($_POST["cg1name"]),
			'Guardian2' => strtoupper($_POST["cg2name"]),
			'Guardian1tel' => strtoupper($_POST["cg1telno"]),
			'Guardian2tel' => strtoupper($_POST["cg2telno"]),
			'Guardian1add' => strtoupper($_POST["cg1add"]),
			'Guardian2add' => strtoupper($_POST["cg2add"]),
			'MotherName' => strtoupper($_POST["cmname"]),
			'MotherOccupation' => strtoupper($_POST["cmocc"]),
			'MotherMonthlyIncome' => strtoupper($_POST["cmincome"]),
			'MotherEmployer' => strtoupper($_POST["cmemp"]),
			'MotherOfficeAddress' => strtoupper($_POST["cmadd"]),
			'MTelNo' => strtoupper($_POST["cmtelno"]),
			'FatherName' => strtoupper($_POST["cfname"]),
			'FatherOccupation' => strtoupper($_POST["cfocc"]),
			'FatherMonthlyIncome' => strtoupper($_POST["cfincome"]),
			'FatherEmployer' => strtoupper($_POST["cfemp"]),
			'FatherOfficeAddress' => strtoupper($_POST["cfadd"]),
			'FTelNo' => strtoupper($_POST["cftelno"]),
			'LivingStat' => strtoupper($_POST["cmliving"]),
			'MarriageStatus' => strtoupper($_POST["marriageStatus"])			
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('custodian', $data);
		
		/* UPDATE HOBBIES */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'HobbyName' => strtoupper($_POST["Hobbies"])
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('hobbies', $data);
		
		/* UPDATE HONORSRECEIVED */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'Honors' => strtoupper($_POST["Honors"])
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('honorsreceived', $data);
		
		/* UPDATE ORG */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'OrgName' => strtoupper($_POST["Org"])
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('org', $data);
		
		/* UPDATE OTHERSOURCESINCOME */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'OtherSources' => strtoupper($_POST["otherSourcesOfIncome"]),
			'OtherSourceAmount ' => strtoupper($_POST["otherIncomeAmount"])
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('othersourcesincome', $data);
		
		/* UPDATE PAYMENT */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"])
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('payment', $data);
		
		/* UPDATE RESERVATION */
		
		$getTerm = "Select Term from dorm";
		$t = $this->{$this->db_group_name2}->query($getTerm);

		foreach($t->result() as $row)
			$term = $row->Term;
			
		$date = $_POST["MonthR"]."/".$_POST["DayR"]."/".$_POST["YearR"];
		//$orNum = "$_POST["Or"";
		$amount = "";
		$remarks = "";
		
		
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'Sem' => strtoupper($term),
			'ReserveOrnum' => strtoupper($_POST["OrNum"]),
			'ReserveAmount' => strtoupper($_POST["Amount"]),
			'ReserveRemarks' => strtoupper($_POST["Remarks"]),
			'ReserveDate' => strtoupper($date)
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('reservation', $data);
		
		/* UPDATE RESIDENTKEY */
		$dateReceived = $_POST["MonthRec"]."/".$_POST["DayRec"]."/".$_POST["YearRec"];	
		$dateReturned = $_POST["MonthRet"]."/".$_POST["DayRet"]."/".$_POST["YearRet"];	
		
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'KeyTerm' => strtoupper($term),
			'KeyOrnum' => strtoupper($_POST["OrNumKey"]),
			'KeyAmount' => strtoupper($_POST["AmountKey"]),
			'DateReceived' => strtoupper($dateReceived),
			'DateReturned' => strtoupper($dateReturned),
			'KeyRemarks' => strtoupper($_POST["RemarksKey"])
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('residentkey', $data);
		
		/* UPDATE RESIDENTLOGINFO */
		$dateCheckIn = $_POST["MonthLI1"]."/".$_POST["DayLI1"]."/".$_POST["YearLI1"];	
		$dateCheckOut = $_POST["MonthLI2"]."/".$_POST["DayLI2"]."/".$_POST["YearLI2"];	
		
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'DateCheckIn' => strtoupper($dateCheckIn),
			'DateCheckOut' => strtoupper($dateCheckOut),
			'FormFive' => strtoupper($_POST["form5"]),
			'RoomNo' => strtoupper($_POST["room"]),
			'Term' => strtoupper($term)
       	);

       	
       	
		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('residentloginfo', $data);
		
		
		/* UPDATE SCHOLARSHIP */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'ScholarshipName' => strtoupper($_POST["Scholarship"]),
			'MonthlyStipend' => strtoupper($_POST["MonthlyStipend"])
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('scholarship', $data);
		
		/* UPDATE TALENT */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'TalentName ' => strtoupper($_POST["Talents0"])			
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('talent', $data);
		
		
		/* UPDATE VIOLATION */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"])
       	);

		$this->{$this->db_group_name2}->where('FirstName', $fname);
		$this->{$this->db_group_name2}->where('LastName', $lname);
		$this->{$this->db_group_name2}->where('MidName', $mname);
		$this->{$this->db_group_name2}->update('violation', $data);
		
		unset($_SESSION["fname"]);
		unset($_SESSION["lname"]);
		unset($_SESSION["mname"]);
		
	}	//end of updateResident
	
   function getNumberOutIn($month){
									
			$q=" SELECT resident.Gender,residentloginfo.DateCheckIn,residentloginfo.DateCheckOut
					 FROM residentloginfo
					 LEFT JOIN Resident
					 ON resident.LastName=residentloginfo.LastName
					 AND resident.FirstName=residentloginfo.FirstName 
					 AND resident.MidName=residentloginfo.MidName";
		
			$query = $this->{$this->db_group_name2}->query($q);
		$inMale=0;$inFemale=0;
		$outMale=0; $outFemale=0;		
	  foreach($query->result() as $row  ){
	  		if($row->Gender=="MALE"){
	  			if($row->DateCheckOut==""){
	  					$arr=explode("/",$row->DateCheckIn);
	  					if($arr[0]==$month){
	  						$inMale++;
	  					}
	  			}else{
	  			 $arr=explode("/",$row->DateCheckOut);
	  				if($arr[0]==$month){
	  						$outMale++;
	  					}
	  			}
	  		}else{
	  			
	  		if($row->DateCheckOut==""){
	  				 $arr=explode("/",$row->DateCheckIn);
	  				if($arr[0]==$month){
	  						$inFemale++;
	  					}
	  			}else{
	  			 $arr=explode("/",$row->DateCheckOut);
	  				if($arr[0]==$month){
	  						$outFemale++;
	  					}
	  			}
	  		}
	  }
	
	$arr[0] = $inMale;
	$arr[1] = $outMale;
	$arr[2] = $inFemale;
	$arr[3] = $outFemale;
	
	return $arr;
}
	
   function getUnitsOfAppliances($month){
		$q = "SELECT DISTINCT AppName
			 FROM Appliances Order by AppName";
		
		$query = $this->{$this->db_group_name2}->query($q);
		$appName ="";
		$cnt = 0;
		$arr ="";
		$in= "";
		$can= "";
		$con= "";
		foreach($query->result() as $row  ){
			$appName[$cnt] = $row->AppName;
			$arr[$appName[$cnt]] = "";
			$in[$appName[$cnt]] = 0;
			$can[$appName[$cnt]] = 0;
			$con[$appName[$cnt]] = 0;
			$cnt++;
		}
		
					
					$this->{$this->db_group_name2}->select('AppName,DateInstalled,DateCancelled,DateConfiscated');
					$this->{$this->db_group_name2}->order_by('AppName');
					$this->{$this->db_group_name2}->from('Appliances');
					$appData = $this->{$this->db_group_name2}->get();
					$cnt  =0;
					$arr = "";
					
					foreach($appData->result() as $row  ){
						if($appName[$cnt]==$row->AppName){
								if($row->DateInstalled!=""){
								$din = explode("/",$row->DateInstalled);
										if($din[0]==$month){
											$in[$appName[$cnt]]++;
										}
								}
								if($row->DateInstalled!=""){
								$dca = explode("/",$row->DateCancelled);
										if($dca[0]==$month){
											$can[$appName[$cnt]]++;
										}
								}
								if($row->DateInstalled!=""){
								$dco = explode("/",$row->DateConfiscated);
										if($dco[0]==$month){
											$con[$appName[$cnt]]++;
										}
								
								}
						}else{
							$cnt++;
							if($appName[$cnt]==$row->AppName){
								
							if($row->DateInstalled!=""){
								$din = explode("/",$row->DateInstalled);
										if($din[0]==$month){
											$in[$appName[$cnt]]++;
										}
								}
								if($row->DateInstalled!=""){
								$dca = explode("/",$row->DateCancelled);
										if($dca[0]==$month){
											$can[$appName[$cnt]]++;
										}
								}
								if($row->DateInstalled!=""){
								$dco = explode("/",$row->DateConfiscated);
										if($dco[0]==$month){
											$con[$appName[$cnt]]++;
										}
								
								}
							
							
							}
						}
					
					}
			
	if($appName!=""){
	foreach($appName as $app  ){
			
			$arr[$app] = $in[$app].",".$can[$app].",".$con[$app];
			
		}
	}
	return $arr;
	}
	
   function getActualCollection($month){
		//DormFee	AppFee	TransFee	DatePaid;
					$df =0; $dfCnt = 0 ;
					$af =0; $afCnt =0;
					$tf =0; $tfCnt =0;
					
					$this->{$this->db_group_name2}->select('DormFee,AppFee,TransFee,DatePaid');
					$this->{$this->db_group_name2}->from('Payment');
					$collectionData = $this->{$this->db_group_name2}->get();
					foreach($collectionData->result() as $row  ){
						
						if($row->DatePaid!=""){
							 $dp= explode("@",$row->DatePaid);
							foreach($dp as $d){
								 $pc= explode("/",$d);
							
							if($pc[0]==$month){
								if(trim(str_ireplace("@","",$row->DormFee))!=""){
										 $dorm= explode("@",$row->DormFee);
										foreach($dorm as $dr){
											$df+=$dr;
										}
								}							
								
								if(trim(str_ireplace("@","",$row->AppFee))!=""){
								 $app= explode("@",$row->AppFee);
										foreach($app as $ap){
											$af+=$ap;
										}
								}
								
								if(trim(str_ireplace("@","",$row->TransFee))!=""){
								 	$tr= explode("@",$row->TransFee);
										foreach($tr as $t){
											$tf+=$t;
										}
								}
							}
						}
						}
					}
					
		$total = $df.",".$af.",".$tf;
		return $total;					
 }

   function getAccountReceivable($month){
 					  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
					$this->{$this->db_group_name2}->select('AppFee,ResidentFee,TransFee');
					$this->{$this->db_group_name2}->from('balance');
					$bal = $this->{$this->db_group_name2}->get();

					$af = 0;$rf = 0;$tf = 0;
 					$total = 0;
					foreach($bal->result() as $row){
						$af+=$row->AppFee;
						$rf+=$row->ResidentFee;
						$tf+=$row->TransFee;
						$total+=$af+$rf;	
					}
			$str = $total.",".$rf.",".$af.",".$tf ;
 		return $str;//Total ResidentFee AppFee TransFee
 }

   function getPrevAccountReceivable($month){
 					  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	
					$this->{$this->db_group_name2}->select('AppFee,ResidentFee');
					$this->{$this->db_group_name2}->from('previousaccountables');
					$bal = $this->{$this->db_group_name2}->get();

					$af = 0;$rf = 0;
 					$total = 0;
					foreach($bal->result() as $row){
						$af+=$row->AppFee;
						$rf+=$row->ResidentFee;
						$total+=$af+$rf;	
					}
			$str = $total.",".$rf.",".$af ;
 		return $str;//Total ResidentFee AppFee
 }


}   
 ?>