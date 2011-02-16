<?php 

class Residentmodel extends CI_Model {


   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    	$this->load->library('MyClasses/OptionClass');
    }
    
   function edit_resident($fname,$lname,$mname){
		
		$_SESSION["fname"] = $fname;
		$_SESSION["lname"] = $lname;
		$_SESSION["mname"] = $mname;
		
		$this->load->database();
		
		$query = $this->db->query("SELECT * from resident WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$opt = new OptionClass();
		$r ="";
		$arrResField = $opt->returnFieldsArray("Resident");
		$cnt = 0;
		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->db->query("SELECT * from scholarship WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("scholarship");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->db->query("SELECT * from custodian WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("custodian");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->db->query("SELECT * from othersourcesincome WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("othersourcesincome");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->db->query("SELECT * from hobbies WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("hobbies");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		
		$query = $this->db->query("SELECT * from honorsreceived WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("honorsreceived");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->db->query("SELECT * from talent WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("talent");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->db->query("SELECT * from org WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("org");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->db->query("SELECT * from appliances WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("appliances");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->db->query("SELECT * from residentloginfo WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("residentloginfo");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
		$query = $this->db->query("SELECT * from reservation WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("reservation");

		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
	$query = $this->db->query("SELECT * from residentkey WHERE FirstName='$fname' AND LastName='$lname' AND MidName='$mname'");
		$arrResField = $opt->returnFieldsArray("residentkey");

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
		
		$con = mysql_connect("localhost","DORMA","dorm");
		
		mysql_select_db("dormdatabase", $con);
		mysql_query("DELETE FROM Resident WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'")or die("Can't Delete ".mysql_error());
		mysql_query("DELETE FROM Scholarship WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		mysql_query("DELETE FROM Custodian WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		mysql_query("DELETE FROM Hobbies WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		mysql_query("DELETE FROM Honors WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		mysql_query("DELETE FROM residentkey WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		mysql_query("DELETE FROM residentloginfo WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		mysql_query("DELETE FROM violation WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		
		mysql_close($con);
		
		
	}
 
	
   function view_entry($table,$arrcol,$fname,$lname,$mname){
		
		$con = mysql_connect("localhost","DORMA","dorm");
		
		mysql_select_db("dormdatabase", $con);
		
		
		
		$query = "<table class='view_resi'>";
		$result = mysql_query("SELECT * FROM $table	
		WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
	
	while($row = mysql_fetch_array($result))
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
  	//$query .= "<tr><td>&nbsp</td></tr>";
  	}	
		
	return $query."</table>";
			
	}
	
   function add_entry($_POST){
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
		
   		$con = mysql_connect("localhost","DORMA","dorm");
		if($_POST["roomSem1"]!=""){
			$RoomNumber=$_POST["roomSem1"];
		}else if($_POST["roomSem2"]!=""){
				$RoomNumber=$_POST["roomSem2"];
			
		}else if($_POST["roomSemS"]!=""){
				$RoomNumber=$_POST["roomSemS"];
			
		}else{	$RoomNumber="";}
	
	if (!$con){

			die('Could not connect: '.mysql_error());
		}
		
		mysql_select_db("dormdatabase",$con);


		if(isset($_POST['submitResident'])){

		$vc  =new Residentmodel;
		$opt = new OptionClass;
$str.= "New Resident Added<br/>";
$str.= "Name: $_POST[firstname] $_POST[middlename] $_POST[lastname]<br/>";
		
	
$Bday = $_POST["Month"]."/".$_POST["Day"]."/".$_POST["Year"];		
$StudentNumber = trim($_POST["Batch"]."-".$_POST["StudNumber"]);
$form ="";
if ($_POST["dateInSem1"] != ""){
	$checkIn = $_POST["dateInSem1"];
	$form =  $_POST["formSem1"];
}
else if ($_POST["dateInSem2"] != ""){
	$checkIn = $_POST["dateInSem2"];
	$form =  $_POST["formSem2"];
}
else if ($_POST["dateInSemS"] != ""){
	$checkIn = $_POST["dateInSemS"];
	$form =  $_POST["formSemS"];
}
$checkOut="";/*
if ($_POST["dateOutSem1"] != ""){
	$checkOut = $_POST["dateOutSem1"];
}
else if ($_POST["dateOutSem2"] != ""){
	$checkOut = $_POST["dateOutSem2"];
}
else if ($_POST["dateOutSemS"] != ""){
	$checkOut = $_POST["dateOutSemS"];
}*/


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
		'$RoomNumber')";
	mysql_query($sql) or die( "resident".mysql_error());	

$arrcol = $opt->returnFieldsArray("resident");
$str.=$opt->viewTable("resident",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
	
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
$str.= $opt->viewTable("Scholarship",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
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
$str.= $opt->viewTable("honorsreceived",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
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
$str.= $opt->viewTable("Hobbies",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

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
$str.= $opt->viewTable("othersourcesincome",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

}

if(isset($_POST["Org"])&&trim($_POST["Org"])!=""){
	
	$sql = "Insert into Org
		Values(
		'$_POST[lastname]', , 
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$_POST[Org]' )";
mysql_query($sql) or die( "org".mysql_error());
$arrcol = $opt->returnFieldsArray("org");
$str.= $opt->viewTable("org",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

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
$str.= $opt->viewTable("othersourcesincome",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);

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

mysql_query($sql) or die( "custodian".mysql_error());
$arrcol = $opt->returnFieldsArray("Custodian");
$str.= $opt->viewTable("Custodian",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
}

}


if ($_POST["OrNum1"] != ""){
	$sem = 1;
	$date = $_POST["Date1"];
	$orNum = $_POST["OrNum1"];
	$amount = $_POST["Amount1"];
	$remarks = $_POST["Remarks1"];
}
else if ($_POST["OrNum2"] != ""){
	$sem = 2;
	$date = $_POST["Date2"];
	$orNum = $_POST["OrNum2"];
	$amount = $_POST["Amount2"];
	$remarks = $_POST["Remarks2"];
}
else if ($_POST[OrNum3] != ""){
	$sem = 'S';
	$date = $_POST["Date3"];
	$orNum = $_POST["OrNum3"];
	$amount = $_POST["Amount3"];
	$remarks = $_POST["Remarks3"];
}

$sql = "insert into reservation
		values (
		'$_POST[lastname]',
		'$_POST[middlename]', 
		'$_POST[firstname]',
		'$sem',
		'$orNum', 
		'$amount',
		'$remarks',
		'$date')";

mysql_query($sql) or die( "Reservation".mysql_error());


if ($_POST["OrNumKey1"] != ""){
	$term = "1";
	$date = $_POST["Date1"];
	$orNum = $_POST["OrNumKey1"];
	$amount = $_POST["AmountKey1"];
	$dateReceived = $_POST["dateReceived1"];
	$dateReturned = $_POST["dateReturned1"];
	$remarks = $_POST["RemarksKey1"];
}
else if ($_POST["OrNumKey2"] != ""){
	$term = "2";
	$date = $_POST["Date2"];
	$orNum = $_POST["OrNumKey2"];
	$amount = $_POST["AmountKey2"];
	$dateReceived = $_POST["dateReceived2"];
	$dateReturned = $_POST["dateReturned2"];
	$remarks = $_POST["RemarksKey2"];
}
else if ($_POST["OrNumKeyS"] != ""){
	$term = "S";
	$date = $_POST["DateS"];
	$orNum = $_POST["OrNumKeyS"];
	$amount = $_POST["AmountKeyS"];
	$dateReceived = $_POST["dateReceivedS"];
	$dateReturned = $_POST["dateReturnedS"];
	$remarks = $_POST["RemarksKeyS"];
}

$sql = "insert into residentkey
		values (
		'$_POST[lastname]',
		'$_POST[middlename]', 
		'$_POST[firstname]',
		'$term',
		'$orNum',
		'$amount',
		'$dateReceived',
		'$dateReturned',
		'$remarks')";
mysql_query($sql) or die( "Key".mysql_error());

	$sql = "Insert into residentloginfo
		Values(
		'$_POST[lastname]',
		'$_POST[middlename]', 
		'$_POST[firstname]', 
		'$checkIn',
		'$checkOut',
		'$form',
		'$RoomNumber',
		'$term' )";
mysql_query($sql) or die( "loginfo".mysql_error());
$arrcol = $opt->returnFieldsArray("residentloginfo");
$str.= $opt->viewTable("residentloginfo",$arrcol,$_POST["firstname"],$_POST["lastname"],$_POST["middlename"]);
   
if(isset($_SESSION["numApp"])){
	$numApp= $_SESSION["numApp"]-1;
	echo $numApp."<br/>";
	if($numApp>0){
		$cnt = 0;
	
		for($cnt=0;$cnt<$numApp;$cnt++){
		$appName = $_POST["ApplianceName".$cnt];
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
	    '$RoomNumber'
	    )";
		mysql_query($sql) or die( "App ".mysql_error());
		}
		
		}
	}
}

mysql_close($con);
		
return $str;		
}
   function getDateCheckIn($fname,$mname,$lname){
					$this->load->database();
					$this->db->select('DateCheckIn, DateCheckOut');
					$this->db->where('LastName', $lname);
					$this->db->where('FirstName', $fname);
					$this->db->where('MidName', $mname);
					$this->db->from('residentloginfo');
					$log = $this->db->get();
					$in = "";
  					foreach ($log->result() as $row)
					{	
						if($row->DateCheckOut==""){
							$in =$row->DateCheckIn; 
						}
						
					}
			return $in;
	}

	function getApp($fname,$mname,$lname){
  					$arr = "";

  					$this->load->database();
					$this->db->select('AppName,DateInstalled,DateCancelled');
					$this->db->where('LastName', $lname);
					$this->db->where('FirstName', $fname);
					$this->db->where('MidName', $mname);
					$this->db->from('appliances');
					$app = $this->db->get();
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
  					$this->load->database();
					$this->db->select('*');
					$this->db->from('appliances');
					$this->db->order_by("LastName","asc");
					$app = $this->db->get();
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
  					$this->load->database();
					$this->db->select('Total');
					$this->db->where('LastName', $lname);
					$this->db->where('FirstName', $fname);
					$this->db->where('MidName', $mname);
					$this->db->from('balance');
					$bal = $this->db->get();
					
					
					$this->db->select('DormFee,AppFee,TransFee');
					$this->db->where('LastName', $lname);
					$this->db->where('FirstName', $fname);
					$this->db->where('MidName', $mname);
					$this->db->from('payment');
					$pay = $this->db->get();
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
								$this->db->where('LastName', $lname);
								$this->db->where('FirstName', $fname);
								$this->db->where('MidName', $mname);
								$this->db->delete('balance');
							}else{
								$bool = true;
							}
					
					}
			
			return $bool;		
					
					
  	}
  	
   function setBalance($fname,$mname,$lname,$period,$residentFee,$appFee,$total){
					
					$this->load->database();
					$this->db->select('FirstName,LastName');
					$this->db->where('LastName', $lname);
					$this->db->where('FirstName', $fname);
					$this->db->where('MidName', $mname);
					$this->db->from('balance');
					$bal = $this->db->get();
					
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
					$this->db->insert('balance', $data);
				}else{
					$data = array(
           		 			'PeriodCovered' => "$period",
							'ResidentFee' => "$residentFee",
							'AppFee' => "$appFee",
							'Total' => "$total"
							
					);
					$this->db->where('LastName', $lname);
					$this->db->where('FirstName', $fname);
					$this->db->where('MidName', $mname);
					$this->db->update('balance', $data); 
					
				}

				 
	}
  
   function tally_resident($temp){
		$con = mysql_connect("localhost","DORMA","dorm");
		mysql_select_db("dormdatabase", $con);
		
		$sql = "Select Count(*) from Resident where Gender='MALE'";
		$result[0] = mysql_query($sql) or die("tally".mysql_error());

		$sql = "Select Count(*) from Resident where Gender='FEMALE'";
		$result[1] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Classification = 'FRESHMAN'";
		$result[2] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Classification = 'FRESHMAN'";
		$result[3] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Classification = 'SOPHOMORE'";
		$result[4] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Classification = 'SOPHOMORE'";
		$result[5] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Classification = 'JUNIOR'";
		$result[6] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Classification = 'JUNIOR'";
		$result[7] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Classification = 'SENIOR'";
		$result[8] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Classification = 'SENIOR'";
		$result[9] = mysql_query($sql) or die("tally".mysql_error());
		if($temp==1){
		$sql = "Select Count(*) from Resident where College = 'CA'";
		$result[10] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where College = 'CAS'";
		$result[11] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where College = 'CA-CAS'";
		$result[12] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where College = 'CDC'";
		$result[13] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where College = 'CEAT'";
		$result[14] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where College = 'CEM'";
		$result[15] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where College = 'CFNR'";
		$result[16] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where College = 'CHE'";
		$result[17] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where College = 'CVM'";
		$result[18] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONI'";
		$result[19] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONI'";
		$result[20] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONII'";
		$result[21] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONII'";
		$result[22] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONIII'";
		$result[23] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONIII'";
		$result[24] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and (Region = 'REGIONIV-A' or Region = 'REGIONIV-B')";
		$result[25] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and (Region = 'REGIONIV-A' or Region = 'REGIONIV-B')";
		$result[26] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONV'";
		$result[27] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONV'";
		$result[28] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONVI'";
		$result[29] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONVI'";
		$result[30] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONVII'";
		$result[31] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONVII'";
		$result[32] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONVIII'";
		$result[33] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONVIII'";
		$result[34] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONIX'";
		$result[35] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONIX'";
		$result[36] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONX'";
		$result[37] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONX'";
		$result[38] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONXI'";
		$result[39] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONXI'";
		$result[40] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONXII'";
		$result[41] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONXII'";
		$result[42] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'REGIONXIII'";
		$result[43] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'REGIONXIII'";
		$result[44] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'NCR'";
		$result[45] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'NCR'";
		$result[46] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'CAR'";
		$result[47] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'CAR'";
		$result[48] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'CARAGA'";
		$result[49] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'CARAGA'";
		$result[50] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'MALE' and Region = 'ARMM'";
		$result[51] = mysql_query($sql) or die("tally".mysql_error());
		
		$sql = "Select Count(*) from Resident where Gender = 'FEMALE' and Region = 'ARMM'";
		$result[52] = mysql_query($sql) or die("tally".mysql_error());
		}
		$arr;
		for($i = 0; $i < count($result); $i++){
			$arr[$i] = mysql_result($result[$i],0);
		}
		
		return $arr;
	}
   
   function createBalanceTable($fname,$lname,$mname){
		
					$this->load->database();
					$this->db->select('PeriodCovered,ResidentFee,Appfee,TransFee,Total');
					$this->db->where('LastName', $lname);
					$this->db->where('FirstName', $fname);
					$this->db->where('MidName', $mname);
					$this->db->from('balance');
					$bal = $this->db->get();
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
   	  $query = $this->db->query($q);
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
		$this->load->database();
		
		$query = mysql_query("SELECT * FROM Custodian	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
			
		$result = "<table class=\"custodian_table\">";
				
		while($row = mysql_fetch_array($query))
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
		
		$this->load->database();
	
		
		/*	Scholarship	*/
		$query = mysql_query("SELECT * FROM scholarship	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
			
		$result = "<table class=\"otherInfo_table\">";
			
				
		while($row = mysql_fetch_array($query))
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
		$query = mysql_query("SELECT * FROM honorsreceived	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
				
		while($row = mysql_fetch_array($query))
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
		$query = mysql_query("SELECT * FROM hobbies	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
				
		while($row = mysql_fetch_array($query))
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
		$query = mysql_query("SELECT * FROM othersourcesincome	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
				
		while($row = mysql_fetch_array($query))
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
		$query = mysql_query("SELECT * FROM org	
			WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
				
		while($row = mysql_fetch_array($query))
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
		$this->load->database();
		
		$this->db->select('CTRLNum, RumNum, AppName, Term, DateInstalled, DateCancelled, Remarks');
		$this->db->where('LastName', $lname);
		$this->db->where('FirstName', $fname);
		$this->db->where('MidName', $mname);
		$this->db->from('appliances');
		$app = $this->db->get();
		
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
				$app = strtolower($row->AppName);
				if ($app == "ef") $app = "Electric Fan";
				else if ($app == "cw/p") $app = "Computer w/ printer";
				else if ($app == "cw/op") $app = "Computer w/o printer";
				
				$app = ucwords($app);
				
				$_SESSION["appCtrlNum$cnt"] = $row->CTRLNum;
				
				$result.="<tr>";
				$result.="<td>".$row->CTRLNum."</td>";
				$result.="<td>".$row->RumNum."</td>";
				$result.="<td>".$app."</td>";
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
		
		$this->load->database();
		
		
		$count = 0;
		
		for ($count = 0; $count < $_SESSION["appCount"]; $count++){
			if (isset($_POST["dateCancelled$count"])){
			$date = $_POST["dateCancelled$count"];
			$CTRLNum = $_SESSION["appCtrlNum$count"];
			
			$data = array(
	               'DateCancelled' => $date
	       	);

	       	$CTRLNum = $_SESSION["appCtrlNum$count"];
	       	
			
			$this->db->where('CTRLNum', $CTRLNum);
			$this->db->update('appliances', $data);
			} 			
		}
		
		unset($_SESSION["fname"]);
		unset($_SESSION["lname"]);
		unset($_SESSION["mname"]);
		
		for ($i = 0; $i< $_SESSION["appCount"]; $i++)
			unset($_SESSION["DateCancelled$i"]);
		
		unset($_SESSION["appCount"]);
		
	}	//end of updateAppliance
	
	
	function updateResident($_POST, $fname, $lname, $mname){
		$arrayKeys = array_keys($_POST);
		$arrayValues = array_values($_POST);
		
		for($i=0;$i<count($arrayValues);$i++){
			if($arrayValues[$i]!=""){
		
			$_POST["$arrayKeys[$i]"]=strtoupper($arrayValues[$i]);
			
			}else{
				$_POST["$arrayKeys[$i]"]="";
			
			}
		}
		
		
		
		$this->load->database();
		
		$stdNo = trim($_POST["Batch"]."-".$_POST["StudNumber"]);
		$Bday = $_POST["Month"]."/".$_POST["Day"]."/".$_POST["Year"];
		
		if($_POST["roomSem1"]!=""){
			$RoomNumber=$_POST["roomSem1"];
		}else if($_POST["roomSem2"]!=""){
				$RoomNumber=$_POST["roomSem2"];
			
		}else if($_POST["roomSemS"]!=""){
				$RoomNumber=$_POST["roomSemS"];
			
		}else{	$RoomNumber="";}
		
		
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
			'RoomNumber' => $RoomNumber
       	);
		
		
		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('resident', $data);
		
		
		/* Update all other tables
		 * When name is changed, we need to update all tables since it is the primary key */
		
		/* UPDATE APPLIANCES */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'CTRLNum' => $_POST["controlNum0"]
		
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('appliances', $data);
		
		/* UPDATE BALANCE */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"])
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('balance', $data);
		
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

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('custodian', $data);
		
		/* UPDATE HOBBIES */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'HobbyName' => strtoupper($_POST["Hobbies"])
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('hobbies', $data);
		
		/* UPDATE HONORSRECEIVED */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'Honors' => strtoupper($_POST["Honors"])
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('honorsreceived', $data);
		
		/* UPDATE ORG */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'OrgName' => strtoupper($_POST["Org"])
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('org', $data);
		
		/* UPDATE OTHERSOURCESINCOME */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'OtherSources' => strtoupper($_POST["otherSourcesOfIncome"]),
			'OtherSourceAmount ' => strtoupper($_POST["otherIncomeAmount"])
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('othersourcesincome', $data);
		
		/* UPDATE PAYMENT */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"])
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('payment', $data);
		
		/* UPDATE RESERVATION */
		$sem = "";
		$date = "";
		$orNum = "";
		$amount = "";
		$remarks = "";
		
		if ($_POST["OrNum1"] != ""){
			$sem = "1";
			$date = $_POST["Date1"];
			$orNum = $_POST["OrNum1"];
			$amount = $_POST["Amount1"];
			$remarks = $_POST["Remarks1"];
		}
		else if ($_POST["OrNum2"] != ""){
			$sem = "2";
			$date = $_POST["Date2"];
			$orNum = $_POST["OrNum2"];
			$amount = $_POST["Amount2"];
			$remarks = $_POST["Remarks2"];
		}
		else if ($_POST["OrNumS"] != ""){
			$sem = "S";
			$date = $_POST["DateS"];
			$orNum = $_POST["OrNumS"];
			$amount = $_POST["AmountS"];
			$remarks = $_POST["RemarksS"];
		}
		
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'Sem' => strtoupper($sem),
			'ReserveOrnum' => strtoupper($orNum),
			'ReserveAmount' => strtoupper($amount),
			'ReserveRemarks' => strtoupper($remarks),
			'ReserveDate' => strtoupper($date)
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('reservation', $data);
		
		/* UPDATE RESIDENTKEY */
		
		if ($_POST["OrNumKey1"] != ""){
			$term = "1";
			$date = $_POST["Date1"];
			$orNum = $_POST["OrNumKey1"];
			$amount = $_POST["AmountKey1"];
			$dateReceived = $_POST["dateReceived1"];
			$dateReturned = $_POST["dateReturned1"];
			$remarks = $_POST["RemarksKey1"];
		}
		else if ($_POST["OrNumKey2"] != ""){
			$term = "2";
			$date = $_POST["Date2"];
			$orNum = $_POST["OrNumKey2"];
			$amount = $_POST["AmountKey2"];
			$dateReceived = $_POST["dateReceived2"];
			$dateReturned = $_POST["dateReturned2"];
			$remarks = $_POST["RemarksKey2"];
		}
		else if ($_POST["OrNumKeyS"] != ""){
			$term = "S";
			$date = $_POST["DateS"];
			$orNum = $_POST["OrNumKeyS"];
			$amount = $_POST["AmountKeyS"];
			$dateReceived = $_POST["dateReceivedS"];
			$dateReturned = $_POST["dateReturnedS"];
			$remarks = $_POST["RemarksKeyS"];
		}
		
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'KeyTerm' => strtoupper($term),
			'KeyOrnum' => strtoupper($orNum),
			'KeyAmount' => strtoupper($amount),
			'DateReceived' => strtoupper($dateReceived),
			'DateReturned' => strtoupper($dateReturned),
			'KeyRemarks' => strtoupper($remarks)
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('residentkey', $data);
		
		/* UPDATE RESIDENTLOGINFO */
		
		if ($_POST["dateInSem1"] != ""){
			$checkIn = $_POST["dateInSem1"];
	   		$term = "1";
			$form = $_POST["formSem1"];
			$room = $_POST["roomSem1"];
		}
		else if ($_POST["dateInSem2"] != ""){
			$checkIn = $_POST["dateInSem2"];
			$term = "2";
			$form = $_POST["formSem2"];
			$room = $_POST["roomSem2"];
		}
		else if ($_POST["dateInSemS"] != ""){
			$checkIn = $_POST["dateInSemS"];
			$term = "S";
			$form = $_POST["formSemS"];
			$room = $_POST["roomSemS"];
		}
		
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'DateCheckIn' => strtoupper($checkIn),
			'FormFive' => strtoupper($form),
			'RoomNo' => strtoupper($room),
			'Term' => strtoupper($term)
       	);

       	
       	
		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('residentloginfo', $data);
		
		
		/* UPDATE SCHOLARSHIP */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'ScholarshipName' => strtoupper($_POST["Scholarship"]),
			'MonthlyStipend' => strtoupper($_POST["MonthlyStipend"])
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('scholarship', $data);
		
		/* UPDATE TALENT */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"]),
			'TalentName ' => strtoupper($_POST["Talents0"])			
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('talent', $data);
		
		
		/* UPDATE VIOLATION */
		$data = array(
			'FirstName' => strtoupper($_POST["firstname"]),
			'MidName' => strtoupper($_POST["middlename"]),
			'LastName' => strtoupper($_POST["lastname"])
       	);

		$this->db->where('FirstName', $fname);
		$this->db->where('LastName', $lname);
		$this->db->where('MidName', $mname);
		$this->db->update('violation', $data);
		
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
		
			$query = $this->db->query($q);
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
	  			 $arr=explode("/",$row->DateCheckout);
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
	  			 $arr=explode("/",$row->DateCheckout);
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
		
		$query = $this->db->query($q);
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
		
					
					$this->db->select('AppName,DateInstalled,DateCancelled,DateConfiscated');
					$this->db->order_by('AppName');
					$this->db->from('Appliances');
					$appData = $this->db->get();
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
			
	
	foreach($appName as $app  ){
			
			$arr[$app] = $in[$app].",".$can[$app].",".$con[$app];
			
		}
	
	return $arr;
	}
	
	function getActualCollection($month){
		//DormFee	AppFee	TransFee	DatePaid;
					$df =0; $dfCnt = 0 ;
					$af =0; $afCnt =0;
					$tf =0; $tfCnt =0;
					
					$this->db->select('DormFee,AppFee,TransFee,DatePaid');
					$this->db->from('Payment');
					$collectionData = $this->db->get();
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
 					$this->load->database();
					$this->db->select('AppFee,ResidentFee,TransFee');
					$this->db->from('balance');
					$bal = $this->db->get();

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
 					$this->load->database();
					$this->db->select('AppFee,ResidentFee');
					$this->db->from('previousaccountables');
					$bal = $this->db->get();

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