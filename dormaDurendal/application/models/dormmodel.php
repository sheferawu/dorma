<?php 

class Dormmodel extends CI_Model {
	var $db_group_name2 = "dorm";
		 
 	function __construct()
    {
        parent::__construct();
 		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
 
    }
	
    function get_database_group() {
        return $this->db_group_name2;
    }
    
    function checkSettings(){
 		  $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	  $sql = "Select Count(*) from dorm";
     	  $ar= $this->{$this->db_group_name2}->query($sql)->result();
    	
    	  $ar = (array)$ar[0];
    
    	  $ar = array_values($ar);
    	  
    	return $ar[0];
    	
    }
    
    function getCollegeStudNum($fname,$mname,$lname){
    		
    	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	  
        $col= $this->{$this->db_group_name2}->query("Select College,StudentNumber from resident where LastName = '$lname' AND FirstName = '$fname' AND MidName = '$mname'");
    	$arr = "";
    	foreach($col->result() as $c){
    		$arr[0] = $c->College;
    		$arr[1] = $c->StudentNumber;
    	}
    	return $arr;
    }
    
    function saveEditPrev($_POST){
    	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	$selected = $_POST["check"];
    	$numSelected = count($selected);
    	
    	for($i = 0; $i < $numSelected; $i++){
    	$this->{$this->db_group_name2}->query("Delete from previousaccountables where name=\"$selected[$i]\"");
    	}
    	
    }
    
    function editPrev(){
    	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	$prevAcc = $this->{$this->db_group_name2}->query("Select * From  previousaccountables");
   		 echo "Resident With Accounts:<br/>";
    	
    	 echo  "<form name =\"prevAcc\" action =\"index.php?c=dorm&m=editPrev\" method =\"POST\"><table border><tr><th>StudentNumber</th><th>Name</th><th>College</th><th>ResidentFee</th><th>AppFee</th><th>TransFee</th><th>PeriodCovered</th><th>Option</th></tr>";
    	foreach ($prevAcc->result() as $row)
				{	
				
				echo "<tr><td>$row->StudentNumber</td><td>$row->Name</td><td>$row->College</td><td>$row->ResidentFee</td><td>$row->AppFee</td><td>$row->TransFee</td><td>$row->PeriodCovered</td><td><input type=\"checkbox\" name=\"check[]\" value=\"$row->Name\" />Delete?</td></tr>";
				}
    	echo "</table>";
    	
    	echo "<input type=\"submit\" value=\"Save Changes\" name=\"saveChanges\"> </form>";
    }
    
    function newTerm(){
    	
    	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
    	  
    	 $resMinBal= $this->{$this->db_group_name2}->query("SELECT resident.* FROM resident 
    										LEFT JOIN balance
											ON resident.LastName = balance.LastName
											AND resident.FirstName = balance.FirstName
											AND resident.MidName = balance.MidName
											WHERE balance.LastName IS NULL
											AND balance.FirstName IS NULL
											AND balance.MidName IS NULL
											;");
    	 $cnt = 0;
    	echo "Resident Without Accounts:<br/>";
    	
    	 $table1 = "<form name =\"newSem\" action =\"index.php?c=dorm&m=newterm\" method =\"POST\"><table border><tr><th>Name</th><th>Option</th></tr>";
    	foreach ($resMinBal->result() as $row)
				{	
				
					$table1.="<tr><td>$row->FirstName $row->MidName $row->LastName</td><td><input type=\"checkbox\" name=\"check[]\" value=\"$row->FirstName@$row->MidName@$row->LastName\" />Delete?</td></tr>";
				
				}
				
		$cnt = 0;
		$table1.= "</table>";
		echo $table1;		
    	$bal= $this->{$this->db_group_name2}->query("SELECT * FROM balance;");
    	echo "Resident With Accounts:<br/>";
    	$table1 = "<table border><tr><th>Name</th><th>Balance</th><th>Option</th></tr>";
    	foreach ($bal->result() as $row)
				{
					$table1.="<tr><td>$row->FirstName $row->MidName $row->LastName</td><td> $row->Total</td><td><input type=\"checkbox\" name=\"balcheck[]\" value=\"$row->FirstName@$row->MidName@$row->LastName@$row->PeriodCovered@$row->ResidentFee@$row->AppFee@$row->TransFee@$row->Total\"/>Delete?</td></tr>";
					
				
				}
		$table1.= "</table><input type=\"submit\" name=\"saveChanges\" value=\"SAVE CHANGES\"></form>";
		
		echo $table1;		
    
    }
    
    function setPrevAccounts($name,$arr,$col){
    $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
//$row->FirstName@$row->MidName@$row->LastName@$row->PeriodCovered@$row->ResidentFee@$row->AppFee@$row->TransFee@$row->Total
    $sql ="Insert Into previousaccountables values(
    '$col[1]',
    '$name',
    '$col[0]',
    '$arr[4]',
    '$arr[5]',
    '$arr[6]',
    '$arr[3]'
    )";
		
    $this->{$this->db_group_name2}->query($sql);
    }
    
    
	
    function delete_resident_pay($fname,$lname,$mname){
 		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
		$this->{$this->db_group_name2}->query("DELETE FROM payment WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
		
		
		
		
	}
	
function saveSettings($_POST){
  	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
				
  	//for the dorm table 
  	
  	//start date
  	
  	$sDate= $_POST["sMonth"]."/".$_POST["sDay"]."/".$_POST["sYear"];
  	$eDate= $_POST["eMonth"]."/".$_POST["eDay"]."/".$_POST["eYear"];
  
  	$query = "DELETE FROM dorm";
  	$_POST["Clusters"]= "";
  	$prevArrClus = "";
  	if(isset($_SESSION["clusterCnt"])){
  		if($_SESSION["clusterCnt"]>0){
  			
  				$clusterCnt = $_SESSION["clusterCnt"];
  				unset($_SESSION["clusterCnt"]);
  				
  				for($i = 0;$i<$clusterCnt;$i++){
  					
  					if(isset($_POST["cluster$i"])){
  						if(trim($_POST["cluster$i"])==""){
  							if($i+1!=$clusterCnt&&$i!=0){
  							$_SESSION["Settings"] = "Error in Clusters (Middle cluster's textbox should be not empty)! Settings Not Saved!$i";
  								redirect('');
  								
  							}
  							continue;
  						}
  						
  						$arrClus = explode("-",$_POST["cluster$i"]);
  						if(count($arrClus)==2){
  							$temp1 = count(explode("/",$arrClus[0]))+count(explode("/",$arrClus[1]));
  							
  							if($temp1==6){
  							$date1 = new DateTime($arrClus[0]);
  							$date2 = new DateTime($arrClus[1]);
  							if($date2>$date1){
  								
  								if($prevArrClus ==""){
  								$prevArrClus[0] = $date1;
  								$prevArrClus[1] = $date2;
  								
  								$_POST["Clusters"].=$_POST["cluster$i"]."*";
  								}else{
  								if($prevArrClus[0]<$date1
  								 &&$prevArrClus[0]<$date2
  								 &&$prevArrClus[1]<$date1
  								 &&$prevArrClus[1]<$date2
  								 ){
  									$_POST["Clusters"].=$_POST["cluster$i"]."*";
  								 	
  								 }else{
  								 	
  								$_SESSION["Settings"] = "Error in Clusters (Current clusters should be bigger than the previous clusters)! Settings Not Saved!";
  								redirect('');
  								 	
  								 }	
  								}
  							}else{
  								
  								$_SESSION["Settings"] = "Error in Clusters (Second part should be bigger than the first part)! Settings Not Saved!";
  								redirect('');
  								
  							}
  							
  							}else{
  								$_SESSION["Settings"] = "Error in Clusters (Cluster should have /)! Settings Not Saved!";
  								redirect('');
  								
  								
  							}
  						}else{
  								$_SESSION["Settings"] = "Error in Clusters (Cluster should have -)! Settings Not Saved!";
  								redirect('');
  							
  						}
  							
  					}else{
  						$_SESSION["Settings"] = "Error in Clusters (Set Error)! Settings Not Saved!";
  						redirect('');
  					}
  				}
  		
  		}else{
  		$_SESSION["Settings"] = "Error in Clusters! Settings Not Saved!";
  		redirect('');
  			
  		}
  		
  	}else{
  		$_SESSION["Settings"] = "Error in Clusters! Settings Not Saved!";
  		
  		redirect('');
  	}
  	
  	
  	$_POST["Clusters"] = trim($_POST["Clusters"]);
  	$_POST["Clusters"] = substr($_POST["Clusters"],0,strlen($_POST["Clusters"])-1);
	$numCluster = count(explode("*",$_POST["Clusters"]));
  	//$_SESSION["Settings"] = $_POST["Clusters"];

  		
  	
  	$insertquery = "
 INSERT INTO `dorm` (`DormName`, `Alias`, `MonthlyRent`, `DailyRent`, `StartDate`, `EndDate`, `NumberOfRooms`, `MaxResidentPerRoom`, `NumCluster`, `Clusters`, `Occupancy`,`TFUP`,`TFNUP`,`SchoolYear`,`Term`, `MaleOccupant`, `FemaleOccupant`) VALUES
('$_POST[DormName]', '$_POST[Alias]', '$_POST[MonthlyRent]','$_POST[DailyRent]', '$sDate', '$eDate', '$_POST[NumberOfRooms]', $_POST[MaxResidentPerRoom],  $numCluster, '$_POST[Clusters]',$_POST[Occupancy],$_POST[TFUP],$_POST[TFNUP],'$_POST[SY]','$_POST[Term]', '$_POST[MaleOcc]', '$_POST[FemaleOcc]')
  ";
  
  	$this->{$this->db_group_name2}->query($query);
  	
  	$this->{$this->db_group_name2}->query($insertquery);
//para sa appliance

 if(isset($_SESSION["numAppSet"])&&$_SESSION["numAppSet"]>0){
 	
 	$numApp = $_SESSION["numAppSet"];
 	$insertApp = "INSERT INTO `dormappliance` (`ApplianceName`, `MonthlyRent`, `DailyRent`) VALUES";
 	$query = "DELETE FROM dormappliance";
  	$sucess = true;
 	for($i = 0;$i<$numApp;$i++){
 		
 		if(isset($_POST["App".$i])&&$_POST["AppMonth".$i]&&$_POST["AppDaily".$i]){
 			$app = $_POST["App".$i];
 			$appM = $_POST["AppMonth".$i];
 			$appD = $_POST["AppDaily".$i];
 			if(trim($app)!=""&&trim($appM)!=""&&trim($appD)!="")
 				$app = strtoupper($app);
 			$insertApp.="('".$app."','".$appM."','".$appD."'),";
 		}else{
 			
 			$sucess = false;
 			
 			break;
 		}
 	}
 	$insertApp = substr($insertApp,0,strlen($insertApp)-1);
 		if($sucess){
 			$sucess = "";
  	$this->{$this->db_group_name2}->query($query);
  	
  	$this->{$this->db_group_name2}->query($insertApp);
 		
 		}else{
 			$sucess = "Failure To Modify Appliances";
 		}
 		
 } 
 
 
 
 	
 $_SESSION["Settings"] = "New Settings Saved!<br/>$sucess";
  	
  }  	
    function getDormApp(){
 		       $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
				$this->{$this->db_group_name2}->select('*');
				$app = $this->{$this->db_group_name2}->get('dormappliance');
				$arr = "";
				$cnt = 0;
				foreach ($app->result() as $row)
				{
						
					$arr[$cnt++]= $row->ApplianceName."*".$row->MonthlyRent."*".$row->DailyRent; 
				}
	
 		       	
  	
  	return $arr;
  	
  } 
  
    function getDormAppNames(){
 		       $this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
				$this->{$this->db_group_name2}->select('ApplianceName');
				$app = $this->{$this->db_group_name2}->get('dormappliance');
				$arr = "NONE*";
				
				foreach ($app->result() as $row)
				{
						
					$arr.= $row->ApplianceName."*"; 
				}
				$arr = substr($arr,0,strlen($arr)-1);;
				$arr = "'".$arr."'";
 		       	
  	
  	return $arr;
  	
  } 
  
  	function edit_settings(){
  	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
  	$this->load->model('Optionmodel');
  	//$dorm = $_SESSION["DORMNAME"];
  	$query = $this->{$this->db_group_name2}->query("SELECT * from dorm ");	
  
  		$r ="";
		$arrResField = $this->Optionmodel->returnFieldsArray("dorm");
		$cnt = 0;
		foreach ($query->result() as $row)
		{
			$cnt = 0;
			foreach($arrResField as $af){
			$r[$af] = strtolower($row->$af);
			}
		}
		
	return $r;
  }
  
  	function createDb($dormAlias){
				$this->load->dbforge();
				$this->load->dbutil();
			
				
			 $dbname= strtolower($dormAlias.'db');
				$_SESSION["db"] =$dbname ;
			 if($this->dbutil->database_exists($dbname)){
				$transient ="CREATE TABLE IF NOT EXISTS `transient` (
			  `ControlNumber` varchar(10) NOT NULL,
			  `FillUpDate` varchar(15) DEFAULT NULL,
			  `LastName` varchar(15) NOT NULL DEFAULT '',
			  `FirstName` varchar(15) NOT NULL DEFAULT '',
			  `MidName` varchar(15) NOT NULL DEFAULT '',
			  `Purpose` varchar(30) DEFAULT NULL,
			  `Emergency` varchar(10) DEFAULT NULL,
			  `CheckIn` varchar(15) DEFAULT NULL,
			  `TCheckIn` varchar(15) DEFAULT NULL,
			  `CheckOut` varchar(15) DEFAULT NULL,
			  `TCheckOut` varchar(15) DEFAULT NULL,
			  `Bedding` varchar(15) DEFAULT NULL,
			  `RoomAssign` varchar(5) DEFAULT NULL,
			  `OrNum` varchar(15) DEFAULT NULL,
			  `Guarantor` varchar(90) DEFAULT NULL,
			  `Type` varchar(20) DEFAULT NULL,
			  `Rates` varchar(20) DEFAULT NULL,
			  `AmountPaid` int(10) DEFAULT NULL,
			  `Month` int(2) NOT NULL,
			  PRIMARY KEY (`FirstName`,`MidName`,`LastName`)
			)
				
				";
				$dormapp="CREATE TABLE IF NOT EXISTS `dormappliance` (
			  `ApplianceName` varchar(50) NOT NULL,
			  `MonthlyRent` decimal(5,2) DEFAULT NULL,
			  `DailyRent` decimal(5,2) DEFAULT NULL,
			  PRIMARY KEY (`ApplianceName`)
			)";
					
					$app = "CREATE TABLE IF NOT EXISTS `appliances` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `CTRLNum` int(10) NOT NULL DEFAULT '0',
			  `RumNum` int(10) DEFAULT NULL,
			  `AppName` varchar(15) DEFAULT NULL,
			  `Term` char(1) DEFAULT NULL,
			  `DateInstalled` varchar(15) DEFAULT NULL,
			  `DateCancelled` varchar(15) DEFAULT NULL,
			  `DateConfiscated` varchar(15) DEFAULT NULL,
			  `Remarks` varchar(128) DEFAULT NULL,
			  KEY `LastName` (`LastName`),
			  KEY `MidName` (`MidName`),
			  KEY `FirstName` (`FirstName`)
			)";
					
					$bal = "CREATE TABLE IF NOT EXISTS `balance` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `PeriodCovered` varchar(128) DEFAULT NULL,
			  `ResidentFee` decimal(10,2) NOT NULL,
			  `AppFee` decimal(10,2) NOT NULL,
			  `TransFee` decimal(10,2) NOT NULL,
			  `Total` decimal(15,4) DEFAULT NULL,
			  PRIMARY KEY (`LastName`,`MidName`,`FirstName`),
			  KEY `MidName` (`MidName`),
			  KEY `LastName` (`LastName`)
			)";
					
					$cust = "CREATE TABLE IF NOT EXISTS `custodian` (
			  `FirstName` varchar(30) NOT NULL DEFAULT '',
			  `MidName` varchar(15) NOT NULL DEFAULT '',
			  `LastName` varchar(15) NOT NULL DEFAULT '',
			  `Guardian1` varchar(60) DEFAULT NULL,
			  `Guardian2` varchar(60) DEFAULT NULL,
			  `Guardian1tel` varchar(11) DEFAULT NULL,
			  `Guardian2tel` varchar(11) DEFAULT NULL,
			  `Guardian1add` varchar(100) DEFAULT NULL,
			  `Guardian2add` varchar(100) DEFAULT NULL,
			  `MotherName` varchar(60) DEFAULT NULL,
			  `MotherOccupation` varchar(20) DEFAULT NULL,
			  `MotherMonthlyIncome` int(20) DEFAULT NULL,
			  `MotherEmployer` varchar(30) DEFAULT NULL,
			  `MotherOfficeAddress` varchar(100) DEFAULT NULL,
			  `MTelNo` varchar(11) DEFAULT NULL,
			  `FatherName` varchar(60) DEFAULT NULL,
			  `FatherOccupation` varchar(20) DEFAULT NULL,
			  `FatherMonthlyIncome` int(20) DEFAULT NULL,
			  `FatherEmployer` varchar(30) DEFAULT NULL,
			  `FatherOfficeAddress` varchar(100) DEFAULT NULL,
			  `FTelNo` varchar(11) DEFAULT NULL,
			  `LivingStat` varchar(128) NOT NULL,
			  `MarriageStatus` varchar(15) DEFAULT NULL,
			  PRIMARY KEY (`FirstName`,`MidName`,`LastName`),
			  KEY `FirstName` (`FirstName`),
			  KEY `MidName` (`MidName`)
			)";
					
					$dorm = "CREATE TABLE IF NOT EXISTS `dorm` (
			  `DormName` varchar(30) NOT NULL DEFAULT '',
			  `Alias` varchar(10) DEFAULT NULL,
			  `MonthlyRent` int(11) DEFAULT NULL,
			  `DailyRent` decimal(5,2) DEFAULT NULL,
			  `StartDate` varchar(12) DEFAULT NULL,
			  `EndDate` varchar(12) DEFAULT NULL,
			  `NumberOfRooms` int(11) DEFAULT NULL,
			  `MaxResidentPerRoom` int(11) DEFAULT NULL,
			  `NumCluster` int(11) DEFAULT NULL,
			  `Clusters` varchar(128) DEFAULT NULL,
			  `Occupancy` int(11) DEFAULT NULL,
			  `TFUP` int(3) DEFAULT NULL,
			  `TFNUP` int(3) DEFAULT NULL,
			  `SchoolYear` varchar(10) DEFAULT NULL,
			  `Term` char(1) NOT NULL,
			  `FemaleOccupant` int(11) DEFAULT NULL,
			  `MaleOccupant` int(11) DEFAULT NULL,
			  PRIMARY KEY (`DormName`)
			)";
					
					$hob = "CREATE TABLE IF NOT EXISTS `hobbies` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `HobbyName` varchar(20) DEFAULT NULL,
			  PRIMARY KEY (`LastName`,`MidName`,`FirstName`),
			  KEY `LastName` (`LastName`),
			  KEY `MidName` (`MidName`)
			)";
					
					$honors = "CREATE TABLE IF NOT EXISTS `honorsreceived` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `Honors` varchar(40) DEFAULT NULL,
			  PRIMARY KEY (`LastName`,`MidName`,`FirstName`),
			  KEY `LastName` (`LastName`),
			  KEY `MidName` (`MidName`)
			)";
					
					$mp = "CREATE TABLE IF NOT EXISTS `manpower` (
			  `EmpNum` varchar(30) NOT NULL DEFAULT '',
			  `Name` varchar(15) DEFAULT NULL,
			  `DateStarted` varchar(8) DEFAULT NULL,
			  PRIMARY KEY (`EmpNum`)
			)";
					
					$org = "CREATE TABLE IF NOT EXISTS `org` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `OrgName` varchar(50) DEFAULT NULL,
			  PRIMARY KEY (`LastName`,`MidName`,`FirstName`),
			  KEY `LastName` (`LastName`),
			  KEY `MidName` (`MidName`)
			)";
					
					$others = "CREATE TABLE IF NOT EXISTS `othersourcesincome` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `OtherSources` varchar(20) DEFAULT NULL,
			  `OtherSourceAmount` int(11) DEFAULT NULL,
			  PRIMARY KEY (`LastName`,`MidName`,`FirstName`),
			  KEY `LastName` (`LastName`),
			  KEY `MidName` (`MidName`)
			)";
					
					$pay = "CREATE TABLE IF NOT EXISTS `payment` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `Term` varchar(128) NOT NULL,
			  `PeriodCovered` varchar(128) DEFAULT NULL,
			  `Ornum` varchar(128) DEFAULT NULL,
			  `DormFee` varchar(128) NOT NULL,
			  `AppFee` varchar(128) DEFAULT NULL,
			  `TransFee` varchar(128) DEFAULT NULL,
			  `DatePaid` varchar(128) DEFAULT NULL,
			  `Remarks` varchar(128) DEFAULT NULL
			)";
					
					$prevacc ="CREATE TABLE IF NOT EXISTS `previousaccountables` (
			  `StudentNumber` varchar(10) DEFAULT NULL,
			  `Name` varchar(90) NOT NULL,
			  `College` varchar(6) DEFAULT NULL,
			  `ResidentFee` decimal(10,2) DEFAULT NULL,
			  `AppFee` decimal(10,2) DEFAULT NULL,
			  `TransFee` decimal(10,2) DEFAULT NULL,
			  `PeriodCovered` varchar(30) DEFAULT NULL,
			  PRIMARY KEY (`Name`)
			)";
					
					$reserve  = "CREATE TABLE IF NOT EXISTS `reservation` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `Sem` varchar(1) NOT NULL,
			  `ReserveOrnum` varchar(15) DEFAULT NULL,
			  `ReserveAmount` int(11) DEFAULT NULL,
			  `ReserveRemarks` varchar(30) DEFAULT NULL,
			  `ReserveDate` varchar(20) NOT NULL,
			  PRIMARY KEY (`FirstName`,`MidName`,`LastName`),
			  KEY `LastName` (`LastName`),
			  KEY `MidName` (`MidName`)
			)";
					
					$resident = "CREATE TABLE IF NOT EXISTS `resident` (
			  `StudentNumber` varchar(10) NOT NULL,
			  `FirstName` varchar(30) NOT NULL DEFAULT '',
			  `MidName` varchar(15) NOT NULL DEFAULT '',
			  `LastName` varchar(15) NOT NULL DEFAULT '',
			  `Bday` varchar(20) DEFAULT NULL,
			  `Gender` varchar(10) DEFAULT NULL,
			  `CivStatus` varchar(10) DEFAULT NULL,
			  `Course` varchar(30) DEFAULT NULL,
			  `LastSchoolAttended` varchar(50) DEFAULT NULL,
			  `SchoolType` varchar(10) DEFAULT NULL,
			  `Religion` varchar(20) DEFAULT NULL,
			  `Classification` varchar(15) DEFAULT NULL,
			  `STFAPBracket` varchar(3) DEFAULT NULL,
			  `Address` varchar(200) DEFAULT NULL,
			  `Region` varchar(10) DEFAULT NULL,
			  `TelNo` int(11) DEFAULT NULL,
			  `Email` varchar(30) DEFAULT NULL,
			  `NumBro` int(11) DEFAULT NULL,
			  `NumSis` int(11) DEFAULT NULL,
			  `BirthOrder` varchar(15) DEFAULT NULL,
			  `Ailments` varchar(30) DEFAULT NULL,
			  `Medications` varchar(30) DEFAULT NULL,
			  `BFGF` int(11) DEFAULT NULL,
			  `College` varchar(30) DEFAULT NULL,
			  `Age` int(11) DEFAULT NULL,
			  `RoomNumber` varchar(4) NOT NULL,
			  PRIMARY KEY (`FirstName`,`MidName`,`LastName`),
			  UNIQUE KEY `StudentNumber` (`StudentNumber`)
			)";
				
					$residentkey = "CREATE TABLE IF NOT EXISTS `residentkey` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `KeyTerm` varchar(1) NOT NULL,
			  `KeyOrnum` varchar(15) DEFAULT NULL,
			  `KeyAmount` int(11) DEFAULT NULL,
			  `DateReceived` varchar(15) DEFAULT NULL,
			  `DateReturned` varchar(15) DEFAULT NULL,
			  `KeyRemarks` varchar(30) DEFAULT NULL,
			  PRIMARY KEY (`FirstName`,`MidName`,`LastName`),
			  KEY `LastName` (`LastName`),
			  KEY `MidName` (`MidName`)
			)";
					
					
					$residentloginfo = "CREATE TABLE IF NOT EXISTS `residentloginfo` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `DateCheckIn` varchar(15) DEFAULT NULL,
			  `DateCheckOut` varchar(15) DEFAULT NULL,
			  `FormFive` varchar(15) DEFAULT NULL,
			  `RoomNo` varchar(4) DEFAULT NULL,
			  `Term` varchar(2) DEFAULT NULL,
			  PRIMARY KEY (`FirstName`,`MidName`,`LastName`),
			  KEY `LastName` (`LastName`),
			  KEY `MidName` (`MidName`)
			)";
					
					$scholarship = "CREATE TABLE IF NOT EXISTS `scholarship` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `ScholarshipName` varchar(20) NOT NULL DEFAULT '',
			  `MonthlyStipend` int(6) DEFAULT NULL,
			  PRIMARY KEY (`LastName`,`MidName`,`FirstName`,`ScholarshipName`),
			  KEY `LastName` (`LastName`),
			  KEY `MidName` (`MidName`),
			  KEY `FirstName` (`FirstName`)
			)";
					
					$talent = "CREATE TABLE IF NOT EXISTS `talent` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `TalentName` varchar(20) DEFAULT NULL,
			  PRIMARY KEY (`LastName`,`MidName`,`FirstName`),
			  KEY `LastName` (`LastName`),
			  KEY `MidName` (`MidName`)
			)";
					
					$violation = "CREATE TABLE IF NOT EXISTS `violation` (
			  `LastName` varchar(15) NOT NULL,
			  `MidName` varchar(15) NOT NULL,
			  `FirstName` varchar(30) NOT NULL,
			  `DateOfViolation` varchar(15) DEFAULT NULL,
			  `ActionTaken` varchar(30) DEFAULT NULL,
			  `Date` varchar(15) DEFAULT NULL,
			  `Nature` varchar(20) DEFAULT NULL
			)";
					
					$workload = "CREATE TABLE IF NOT EXISTS `workload` (
			  		`ID` int(4) not null unique auto_increment,
					`Nature` varchar(30) NOT NULL,
			  		`SpecificWork` varchar(20) NOT NULL,
			 		`Manpower` varchar(100) NOT NULL,
			  		`Status` varchar(128) NOT NULL,
			  		`DateStarted` varchar(20) NOT NULL,
			  		`DateCompleted` varchar(20) NOT NULL,
			  		`Remarks` varchar(20) NOT NULL
					)";
			
			//$this->dbforge->create_database($dbname);
			$_SESSION["db"] =$dbname ;
			$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
			if(!$this->{$this->db_group_name2}->table_exists("dorm")){
				$this->{$this->db_group_name2}->query($dorm);}
			if(!$this->{$this->db_group_name2}->table_exists("resident")){
			$this->{$this->db_group_name2}->query($resident);
			}
			if(!$this->{$this->db_group_name2}->table_exists("residentkey")){
			
			$this->{$this->db_group_name2}->query($residentkey);
			}
			if(!$this->{$this->db_group_name2}->table_exists("residentloginfo")){
			
			$this->{$this->db_group_name2}->query($residentloginfo);
			}
			if(!$this->{$this->db_group_name2}->table_exists("scholarship")){
			
			$this->{$this->db_group_name2}->query($scholarship);
			}
			if(!$this->{$this->db_group_name2}->table_exists("talent")){
			
			$this->{$this->db_group_name2}->query($talent);
			}
			if(!$this->{$this->db_group_name2}->table_exists("custodian")){
			
			$this->{$this->db_group_name2}->query($cust);
			}
			$this->{$this->db_group_name2}->query($honors);
			if(!$this->{$this->db_group_name2}->table_exists("balance")){
			
			$this->{$this->db_group_name2}->query($bal);
			}
			$this->{$this->db_group_name2}->query($hob);
			if(!$this->{$this->db_group_name2}->table_exists("manpower")){
			
			$this->{$this->db_group_name2}->query($mp);
			}
			if(!$this->{$this->db_group_name2}->table_exists("org")){
			
			$this->{$this->db_group_name2}->query($org);
			}
			if(!$this->{$this->db_group_name2}->table_exists("appliances")){
			
			$this->{$this->db_group_name2}->query($app);
			}
			if(!$this->{$this->db_group_name2}->table_exists("othersourcesincome")){
			
			$this->{$this->db_group_name2}->query($others);
			}
			if(!$this->{$this->db_group_name2}->table_exists("payment")){
			
			$this->{$this->db_group_name2}->query($pay);
			}
			if(!$this->{$this->db_group_name2}->table_exists("previousaccountables")){
			
			$this->{$this->db_group_name2}->query($prevacc);
			}
			if(!$this->{$this->db_group_name2}->table_exists("reservation")){
			
			$this->{$this->db_group_name2}->query($reserve);
			}
			if(!$this->{$this->db_group_name2}->table_exists("violation")){
			
			$this->{$this->db_group_name2}->query($violation);
			}
			if(!$this->{$this->db_group_name2}->table_exists("workload")){
			
			$this->{$this->db_group_name2}->query($workload);
			}
			if(!$this->{$this->db_group_name2}->table_exists("dormappliance")){
			
			$this->{$this->db_group_name2}->query($dormapp);
			}
			if(!$this->{$this->db_group_name2}->table_exists("transient")){
			
			$this->{$this->db_group_name2}->query($transient);
			}
			//}
				}else{
					
				redirect("c=home&m=nodatabase&dname=".$dbname);		
			}
			$this->{$this->db_group_name2}->close();
				
			return $dbname;
					
	}
	
	function logoutUser(){
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		
		session_destroy();
		redirect('');
	}
	
	function paymentOpt($_GET,$appFee,$resFee,$term){
	session_start();
	$_GET["dormfee"] = $resFee;
	$_GET["appfee"] = $appFee;
	$_GET["tarnsfee"] =0 ;	
		$_GET["term"]=$term;
	$this->{$this->db_group_name2}->where('FirstName', $_SESSION["fNamePay"]); 
	$this->{$this->db_group_name2}->where('LastName', $_SESSION["lNamePay"]); 
	$this->{$this->db_group_name2}->where('MidName', $_SESSION["mNamePay"]); 
	$pay= $this->{$this->db_group_name2}->get('payment');
	
		for($i=0;$i<8;$i++){
					
						$concat[$i]="";
		}	
				
	
	//if(isset($_GET["t"])){
	
	
	//$num  = $_GET["t"];
	//if(true){
			if(isset($_SESSION["fNamePay"]) &&isset($_SESSION["mNamePay"]) &&isset($_SESSION["lNamePay"]) ){
				$iArr =  Array('term','periodcovered', 'ornum', 'dormfee','appfee','transfee','datepaid','remarks');
				 $this->load->library("MyClasses/OptionClass");
				 $opt = new OptionClass;
				 $fArr= $opt->returnFieldsArray("payment");
			if(count($pay->result())<1){
				 $data["LastName"] = $_SESSION["lNamePay"];
				 $data["MidName"] = $_SESSION["mNamePay"];
				 $data["FirstName"] = $_SESSION["fNamePay"];
				}else{
					for($i=0;$i<8;$i++){
					
					foreach($pay->result() as $r){
						$concat[$i]=$r->$fArr[$i+3]."@";
					}
				}
				}
			 for($cnt = 3,$cnt1=0; $cnt<11;$cnt++,$cnt1++){
				 
				 $data["$fArr[$cnt]"] = $concat[$cnt1]."".$_GET["$iArr[$cnt1]"];
				}
				if($data["PeriodCovered"]!=""){
				if(count($pay->result())<1){
				 
				$this->{$this->db_group_name2}->insert('payment', $data); 
				}else{
				$this->{$this->db_group_name2}->where('LastName',$_SESSION["lNamePay"]);
				$this->{$this->db_group_name2}->where('FirstName',$_SESSION["fNamePay"]);
				$this->{$this->db_group_name2}->where('MidName',$_SESSION["mNamePay"]);
				$this->{$this->db_group_name2}->update('payment', $data); 
					
				} 
				}
			}
	
	//}
//}
		
	} 
	
	function getPaidPeriods($fname,$lname,$mname,$date){
		$periodPaid ="";
		$datePaid ="";
		$cnt =0;
		
	$this->{$this->db_group_name2}->select('PeriodCovered,DatePaid');
	$this->{$this->db_group_name2}->where('FirstName',$fname); 
	$this->{$this->db_group_name2}->where('LastName', $lname); 
	$this->{$this->db_group_name2}->where('MidName',$mname); 
	$this->{$this->db_group_name2}->from('payment');
		$pay = $this->{$this->db_group_name2}->get();
		$cnt=0;
		$paid = "";
		 
		foreach ($pay->result() as $row2)
		 {		$datePaid[$cnt] = $row2->DatePaid;
				$periodPaid[$cnt++] = $row2->PeriodCovered;
		 		
		 }
		 
		 
		 
		 if($periodPaid!=""){ 
		 $periodPaid = explode("@",$periodPaid[0]);
		 //$periodPaid  = explode("-",$periodPaid[count($periodPaid)-1]);
 		 
		 $datePaid = explode("@",$datePaid[0]);
		 $do = new DateTime($date);
			
		 //$pp = periodPaid
		 $cnt = 0;
		 $ppstr ="";
		 $cnt1 = 0;
		 foreach($datePaid as $pp){
		 	$dp = new DateTime($pp);
			
		 	if($dp<$do){
		 		$ppstr[$cnt1++]=$periodPaid[$cnt];		
		 		
		 	}$cnt++;
		 }
		 if($ppstr!=""){
		 $periodPaid  = explode("-",$ppstr[count($ppstr)-1]);
		 
		 $arr =$this->getCluster();
		 $cnt=0;
		 foreach($arr as $a){
		 	 $period= explode("-",$a);
		 	$e = new DateTime($period[1]);
			$d = new DateTime($periodPaid[1]);
			if($d>=$e){
				$paid[$cnt++] = $a;
			}  
		 	
		 	/*$e=explode("/",$period[1]);
		 	$d=explode("/",$periodPaid[1]); 
		 	if($d[2]>=$e[2]){//para sa taon
				if($d[2]>$e[2]){
					$paid[$cnt++] = $a; //ilagay na agad sa kasama pag mas malaki ang taon ngayon kesa sa taon ng cluster
					}else{
						if($d[0]>=$e[0]){// para sa buwan
						 if(strcasecmp($d[0],$e[0])>0){
							$paid[$cnt++] = $a;//ilagay kung mas malaki(mas matagal?) ang buwan ngayon kesa sa buwan ng cluster
							}else{
								if($d[1]>=$e[1]){//para sa araw
									$paid[$cnt++] = $a;
							
								}
							}		
						}		
					}
				}*/
		 	
		 }
		 }
		 }
		 	 return $paid;
	}
	
	function getMissedPeriods($periodsPaid,$periodsArr){
		$cnt=0;
		$periodsMissed ="";
		if($periodsPaid!=""){
							//print_r($periodsPaid);
						foreach ($periodsArr as $p)
						{		
							$in = 0;
							foreach($periodsPaid as $pp){
									
								if(trim($p)==trim($pp)){
									$in = 1;
									break;
								}
							}	
							if($in==0){
							$periodsMissed[$cnt++] = $p;
							}
						}
						}else{
							
							$periodsMissed =$periodsArr; 
						}
						
		return $periodsMissed;
	}
 	
	function getPaymentPeriods($periodsArr,$date){
	$bigArray="";
					
	$this->{$this->db_group_name2}->select('FirstName,LastName,MidName,StudentNumber, Course, College, RoomNumber');
	$this->{$this->db_group_name2}->from('resident');
	$this->{$this->db_group_name2}->order_by("LastName", "asc");
	$this->{$this->db_group_name2}->order_by("FirstName", "asc"); 
	$this->{$this->db_group_name2}->order_by("MidName", "asc"); 
	$res = $this->{$this->db_group_name2}->get();
		foreach ($res->result() as $row)
		{	
				$cnt = 0;
				$bcnt = 0;
				$periodsPaid = "";
				$periodsMissed = "";
					
				$periodsPaid=$this->getPaidPeriods($row->FirstName,$row->LastName,$row->MidName,$date);
    			$periodsMissed = $this->getMissedPeriods($periodsPaid,$periodsArr);
						
						
					if($periodsMissed!=""){
						$str = "";
						$str .= $row->LastName."@".$row->FirstName."@".$row->MidName."/".$row->StudentNumber."/".$row->Course."/".$row->College."/".$row->RoomNumber;
						$periodsNotPaid = "";
						foreach($periodsMissed as $p){
							$periodsNotPaid .=$p."*";
						}
						$periodsNotPaid = substr($periodsNotPaid,0,strlen($periodsNotPaid)-1);
						$bigArray[$str] = $periodsNotPaid;	
						
					}
						
	
	}

	return $bigArray ;
}
	
	function getTransientPaymentPeriods($date){
		
		$this->{$this->db_group_name2}->select('FirstName,LastName,MidName,CheckIn,CheckOut,Type,Rates,AmountPaid');
		$this->{$this->db_group_name2}->order_by("LastName", "asc");
		$this->{$this->db_group_name2}->order_by("FirstName", "asc"); 
		$this->{$this->db_group_name2}->order_by("MidName", "asc"); 
		$this->{$this->db_group_name2}->from('transient');
		
		
		$res = $this->{$this->db_group_name2}->get();
		$arr ="";
		$cnt = 0;
		$currDate = new DateTime($date);
		$currMonth = $currDate->format('m');
		foreach ($res->result() as $row){ 
			$date2 = new DateTime($row->CheckIn);
			$month = $date2->format('m');
		
			if($currMonth==$month){
			$arr[$row->LastName."@".$row->FirstName."@".$row->MidName]= $row->CheckIn."@".$row->CheckOut."@".$row->Type."@".$row->Rates."@".$row->AmountPaid;
			}		
		}
		
		return $arr;
	}
	
	function getCluster(){
		
		
		$clusters = "";
						$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
	$this->{$this->db_group_name2}->select('Clusters,NumCluster');
	$this->{$this->db_group_name2}->from('dorm');
						$dorm= $this->{$this->db_group_name2}->get(); 
		
						if(count($dorm->result())>0){
							
							foreach ($dorm->result() as $row){
								$numCluster = $row->NumCluster;
								$clusters = $row->Clusters;
							}
						}
			$arr = "";
			if($clusters!=""){
			$arr = explode("*",$clusters);//to be recode mamaya
			}
			return $arr;
	
	}
	
	function update_workload($_POST){
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
		
		$this->{$this->db_group_name2}->select('*');
		$this->{$this->db_group_name2}->from('workload');
		$work = $this->{$this->db_group_name2}->get();
		
		$cnt = 0;
		foreach($work->result() as $w){
			$start = $_POST["startMonth$cnt"]."/".$_POST["startDay$cnt"]."/".$_POST["startYear$cnt"];
			
			if ($_POST["compMonth$cnt"] == "0") $comp = "";
			else $comp = $_POST["compMonth$cnt"]."/".$_POST["compDay$cnt"]."/".$_POST["compYear$cnt"];
			
			$data = array(
          		'Nature' => strtoupper($_POST["workNature$cnt"]),
				'SpecificWork' => strtoupper($_POST["specWork$cnt"]),
				'Manpower' => strtoupper($_POST["manpower$cnt"]),
				'Status' => strtoupper($_POST["status$cnt"]),
				'DateStarted' => "$start",
				'DateCompleted' => "$comp",
				'Remarks' => strtoupper($_POST["remarks$cnt"]),							
			);
					
			$this->{$this->db_group_name2}->where('ID', $w->ID);
			$this->{$this->db_group_name2}->update('workload', $data); 
			$cnt++;		
		}
				
		
	}
	
	function remove_workload($id){
		/*$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
		
		$this->{$this->db_group_name2}->select('*');
		$this->{$this->db_group_name2}->from('workload');
		$work = $this->{$this->db_group_name2}->get();
		

		foreach($work->result() as $w){
		
			
			if ($_POST["deleteWork"] == $w->ID)
				
		}*/
		
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
        $this->{$this->db_group_name2}->query("DELETE FROM workload WHERE ID= '$id'");
				
		
	}
	
	function clearRecords(){
		$sql = "Delete from balance";
		$sql1 = "Delete from payment";
		$this->{$this->db_group_name2}->query($sql);
		$this->{$this->db_group_name2}->query($sql1);
		
		
	}
	function add_workload($_POST){
		$str="";
		$arrayKeys = array_keys($_POST);
		$arrayValues = array_values($_POST);
		for($i=0;$i<count($arrayValues);$i++){
			if($arrayValues[$i]!=""){
			$val = strtoupper($arrayValues[$i]);
			$val = str_replace("'","",$val);
			$val = str_replace("\"","",$val);
			$_POST["$arrayKeys[$i]"]=$val;
			
			}else{
				$_POST["$arrayKeys[$i]"]="";
			
			}
		}
		
			
		$startDate = $_POST["startMonth"]."/".$_POST["startDay"]."/".$_POST["startYear"];	
		$endDate = $_POST["compMonth"]."/".$_POST["compDay"]."/".$_POST["compYear"];	
		
		if ($endDate == "0//") $endDate = "";
		
		$nature = $_POST["workNature"];
		$status = $_POST["status"];
		$sWork = $_POST["specWork"];
		$manpower = $_POST["manpower"];
		$remarks = $_POST["remarks"];
		
		$q = "INSERT INTO workload(`Nature`,`SpecificWork`,`Manpower`,`Status`,`DateStarted`,`DateCompleted`,`Remarks`) values
			 (
			 '$nature',
			 '$sWork',
			 '$manpower',
			 '$status',
			 '$startDate',
			 '$endDate',
			 '$remarks')";
		
		$query = $this->{$this->db_group_name2}->query($q);
		
	}
	
	function view_workload($month){
	 	$q = "SELECT * from workload order by nature";
			
		$query = $this->{$this->db_group_name2}->query($q);
		$result = "<table border>
					<tr><th>Nature</th><th>Specific Work</th><th>Manpower</th><th>Status</th><th>Start Date</th><th>Completion Date</th><th>Remarks</th></tr>";
		$_SESSION['report_value'][5] = "Nature\tSpecific Work\tManpower\tStatus\tStart Dat\tCompletion Date\tRemarks\t\n\n";
		
	 	foreach($query->result() as $row){
	 			$d0 = explode("/",$row->DateStarted);
	 			$d0 = $d0[0];
	 			
	 			if($d0==$month){
				$result.="<tr>";
				$result.="<td>".ucwords(strtolower($row->Nature))."</td>";
				$result.="<td>".ucwords(strtolower($row->SpecificWork))."</td>";
				$result.="<td>".ucwords(strtolower($row->Manpower))."</td>";
				$result.="<td>".ucwords(strtolower($row->Status))."</td>";
				$result.="<td>".ucwords(strtolower($row->DateStarted))."</td>";
				$result.="<td>".ucwords(strtolower($row->DateCompleted))."</td>";
				$result.="<td>".ucwords(strtolower($row->Remarks))."</td>";
				$result.="</tr>";	
				$_SESSION['report_value'][5] .=ucwords(strtolower($row->Nature))."\t";
				$_SESSION['report_value'][5] .=ucwords(strtolower($row->SpecificWork))."\t";
				$_SESSION['report_value'][5] .=ucwords(strtolower($row->Manpower))."\t";
				$_SESSION['report_value'][5] .=ucwords(strtolower($row->Status))."\t";
				$_SESSION['report_value'][5] .=ucwords(strtolower($row->DateStarted))."\t";
				$_SESSION['report_value'][5] .=ucwords(strtolower($row->DateCompleted))."\t";
				$_SESSION['report_value'][5] .=ucwords(strtolower($row->Remarks));
		
				$_SESSION['report_value'][5] .="\n";
	 			}
	 	}
		
		
		
		$result.="</table>";
		
		
		
		return $result;
 }
 
	function delete_workload(){
	 	$q = "SELECT * from workload order by nature";
			
		$query = $this->{$this->db_group_name2}->query($q);
		$result = " <form name=\"deleteWorkloadForm\" method=\"POST\" action=\"index.php?c=dorm&m=removeWorkload\">
					<table border>
					<tr><th></th>
						<th>Nature</th>
						<th>Specific Work</th>
						<th>Manpower</th>
						<th>Status</th>
						<th>Start Date</th>
						<th>Completion Date</th>
						<th>Remarks</th>
						</tr>";
		
	 	foreach($query->result() as $row){
				$result.="<tr>";
				$result.="<td><input type=\"radio\" name=\"deleteWork\" value=\"$row->ID\"/></td>";
				$result.="<td>".ucwords(strtolower($row->Nature))."</td>";
				$result.="<td>".ucwords(strtolower($row->SpecificWork))."</td>";
				$result.="<td>".ucwords(strtolower($row->Manpower))."</td>";
				$result.="<td>".ucwords(strtolower($row->Status))."</td>";
				$result.="<td>".ucwords(strtolower($row->DateStarted))."</td>";
				$result.="<td>".ucwords(strtolower($row->DateCompleted))."</td>";
				$result.="<td>".ucwords(strtolower($row->Remarks))."</td>";
		
				$result.="</tr>";	
		}
		
		
		
		$result.="</table><br/>
					<input type=\"Submit\" Value=\"Delete\" name=\"delWorkload\"/>
				</form>";
		
		
		
		return $result;
	 }
 
 	function edit_workload(){
	 	$q = "SELECT * from workload order by nature";
			
		$query = $this->{$this->db_group_name2}->query($q);
		$result = "	<form action=\"index.php?c=dorm&m=updateWorkload\" method=\"POST\" name=\"editProjectForm\"  onsubmit=\"return(validateEditWorkloadForm(this))\">
					<table border id=\"workList\">
					<tr>
						<th>Nature</th>
						<th>Specific Work</th>
						<th>Manpower</th>
						<th>Status</th>
						<th>Start Date</th>
						<th>Completion Date</th>
						<th>Remarks</th>
						</tr>";
		$cnt = 0;
	 	foreach($query->result() as $row){
	 			$nature = ucwords(strtolower($row->Nature));
	 			$sWork = ucwords(strtolower($row->SpecificWork));
	 			$manpower = ucwords(strtolower($row->Manpower));
	 			$status = ucwords(strtolower($row->Status));
	 			$startArray = explode("/", ucwords(strtolower($row->DateStarted)));
	 			$remarks = ucwords(strtolower($row->Remarks)); 			
	 			
	 			if (ucwords(strtolower($row->DateCompleted)) == ""){
	 				$compArray[0] = "0";
	 				$compArray[1] = "1";
	 				$compArray[2] = "1950";
	 			}
	 			else $compArray = explode("/", ucwords(strtolower($row->DateCompleted)));
	 			
	 			$bool = "";
	 			for ($i = 0; $i < 3; $i++)
	 				$bool[$i] = "";
	 			
	 			if($nature == "Repairs") $bool[0] = "selected=\"selected\"";
				if($nature == "Maintenance Works") $bool[1] = "selected=\"selected\"";
	 			if($nature == "Projects") $bool[2] = "selected=\"selected\"";
	 			
	 			$wnat = "<select name=\"workNature$cnt\" id=\"workNature$cnt\">
						<option value=\"Repairs\" $bool[0]>Repairs</option>
						<option value=\"Maintenance Works\" $bool[1]>Maintenance</option>
						<option value=\"Projects\" $bool[2]>Projects</option>";
	 			
	 			$bool = "";
	 			for ($i = 0; $i < 12; $i++)
	 				$bool[$i] = "";
	 			
	 			if(trim(strtoupper($startArray[0])) == "JAN") $bool[0] = "selected=\"selected\"";
				if(trim(strtoupper($startArray[0])) == "FEB") $bool[1] = "selected=\"selected\"";
	 			if(trim(strtoupper($startArray[0])) == "MAR") $bool[2] = "selected=\"selected\"";
	 			if(trim(strtoupper($startArray[0])) == "APR") $bool[3] = "selected=\"selected\"";
	 			if(trim(strtoupper($startArray[0])) == "MAY") $bool[4] = "selected=\"selected\"";
	 			if(trim(strtoupper($startArray[0])) == "JUN") $bool[5] = "selected=\"selected\"";
	 			if(trim(strtoupper($startArray[0])) == "JUL") $bool[6] = "selected=\"selected\"";
	 			if(trim(strtoupper($startArray[0])) == "AUG") $bool[7] = "selected=\"selected\"";
	 			if(trim(strtoupper($startArray[0])) == "SEP") $bool[8] = "selected=\"selected\"";
	 			if(trim(strtoupper($startArray[0])) == "OCT") $bool[9] = "selected=\"selected\"";
	 			if(trim(strtoupper($startArray[0])) == "NOV") $bool[10] = "selected=\"selected\"";
	 			if(trim(strtoupper($startArray[0])) == "DEC") $bool[11] = "selected=\"selected\"";
	 			
	 			$sm = "<select name=\"startMonth$cnt\" id=\"startMonth$cnt\" onchange=\"getMonth(this.options[this.selectedIndex].value,'startDay$cnt','startYear$cnt')\">
						<option value=\"0\" >M</option>
						<option value=\"Jan\" $bool[0]>1</option>
						<option value=\"Feb\" $bool[1]>2</option>
						<option value=\"Mar\" $bool[2]>3</option>
						<option value=\"Apr\" $bool[3]>4</option>
						<option value=\"May\" $bool[4]>5</option>
						<option value=\"Jun\" $bool[5] >6</option>
						<option value=\"Jul\" $bool[6]>7</option>
						<option value=\"Aug\" $bool[7]>8</option>
						<option value=\"Sep\" $bool[8]>9</option>
						<option value=\"Oct\" $bool[9]>10</option>
						<option value=\"Nov\" $bool[10]>11</option>
						<option value=\"Dec\" $bool[11]>12</option>
					</select>
					<div style=\"display:inline;\" id = \"startDay$cnt\">
						<select name=\"startDay$cnt\">
							<option value=\"$startArray[1]\">$startArray[1]</option>
						</select>
					</div>
					<div style=\"display:inline;\" id = \"startYear$cnt\">
						<select name=\"startYear$cnt\" >
							<option value=\"$startArray[2]\">$startArray[2]</option>
						</select>
					</div>";
	 			
	 			
	 			$bool = "";
	 			for ($i = 0; $i < 12; $i++)
	 				$bool[$i] = "";
	 			
	 			if(trim(strtoupper($compArray[0])) == "JAN") $bool[0] = "selected=\"selected\"";
				if(trim(strtoupper($compArray[0])) == "FEB") $bool[1] = "selected=\"selected\"";
	 			if(trim(strtoupper($compArray[0])) == "MAR") $bool[2] = "selected=\"selected\"";
	 			if(trim(strtoupper($compArray[0])) == "APR") $bool[3] = "selected=\"selected\"";
	 			if(trim(strtoupper($compArray[0])) == "MAY") $bool[4] = "selected=\"selected\"";
	 			if(trim(strtoupper($compArray[0])) == "JUN") $bool[5] = "selected=\"selected\"";
	 			if(trim(strtoupper($compArray[0])) == "JUL") $bool[6] = "selected=\"selected\"";
	 			if(trim(strtoupper($compArray[0])) == "AUG") $bool[7] = "selected=\"selected\"";
	 			if(trim(strtoupper($compArray[0])) == "SEP") $bool[8] = "selected=\"selected\"";
	 			if(trim(strtoupper($compArray[0])) == "OCT") $bool[9] = "selected=\"selected\"";
	 			if(trim(strtoupper($compArray[0])) == "NOV") $bool[10] = "selected=\"selected\"";
	 			if(trim(strtoupper($compArray[0])) == "DEC") $bool[11] = "selected=\"selected\"";
	 			
	 			$cm = "<select name=\"compMonth$cnt\" id=\"compMonth$cnt\" onchange=\"getMonth(this.options[this.selectedIndex].value,'compDay$cnt','compYear$cnt')\">
						<option value=\"0\" >M</option>
						<option value=\"Jan\" $bool[0]>1</option>
						<option value=\"Feb\" $bool[1]>2</option>
						<option value=\"Mar\" $bool[2]>3</option>
						<option value=\"Apr\" $bool[3]>4</option>
						<option value=\"May\" $bool[4]>5</option>
						<option value=\"Jun\" $bool[5] >6</option>
						<option value=\"Jul\" $bool[6]>7</option>
						<option value=\"Aug\" $bool[7]>8</option>
						<option value=\"Sep\" $bool[8]>9</option>
						<option value=\"Oct\" $bool[9]>10</option>
						<option value=\"Nov\" $bool[10]>11</option>
						<option value=\"Dec\" $bool[11]>12</option>
					</select>
					<div style=\"display:inline;\" id = \"compDay$cnt\">
						<select name=\"compDay$cnt\">
							<option value=\"$compArray[1]\">$compArray[1]</option>
						</select>
					</div>
					<div style=\"display:inline;\" id = \"compYear$cnt\">
						<select name=\"compYear$cnt\" >
							<option value=\"$compArray[2]\">$compArray[2]</option>
						</select>
					</div>";
	 			
				$result.="<tr>";
				//$result.="<td><input type=\"radio\" name=\"editWork\" value=\"$row->ID\" onclick=\"enableRow($row->ID)\"></td>";
				$result.="<td>$wnat</td>";
				$result.="<td><input type=\"text\" name=\"specWork$cnt\" id=\"specWork$cnt\" value=\"$sWork\" size=\"10\"/></td>";
				$result.="<td><input type=\"text\" name=\"manpower$cnt\" id=\"manpower$cnt\" value=\"$manpower\"  size=\"15\"/></td>";
				$result.="<td><input type=\"text\" name=\"status$cnt\" id=\"status$cnt\" value=\"$status\"/></td>";
				$result.="<td>$sm</td>";
				$result.="<td>$cm</td>";
				$result.="<td><input type=\"text\" name=\"remarks$cnt\" id=\"remarks$cnt\" value=\"$remarks\" size=\"5\"/></td>";
		
				$result.="</tr>";	
				$cnt++;
		}
		
		
		
		$result.="	
				</table><br/><input type=\"submit\" value=\"Submit\" name=\"editWorkload\"></form>";
		
		
		
		return $result;
	 }
 
 	function getAccountReceivable(){
 	$this->{$this->db_group_name2}->select('StudentNumber,Name,College,ResidentFee, AppFee, TransFee, PeriodCovered');
 	$this->{$this->db_group_name2}->from('previousaccountables');
 	$this->{$this->db_group_name2}->order_by('Name');
			$res = $this->{$this->db_group_name2}->get();
		 $arr= $res->result();
		if(current($arr)!=""){
			$result = "<table border>
				<tr><th>Name</th>
					<th>College</th>
					<th>RF</th>
					<th>AF</th>
					<th>TF</th>
					<th>TOTAL</th>
					<th>PERIOD COVERED</th><th>&nbsp</th>";
	$cnt = 0;
 	foreach($res->result() as $row){
			$result.="<tr>";
			$result.="<td>".ucwords(strtolower($row->Name))."</td>";
			$result.="<td>".$row->College."</td>";
			$result.="<td>".$row->ResidentFee."</td>";
			$result.="<td>".$row-> AppFee."</td>";
			$result.="<td>".$row-> TransFee."</td>";
			$result.="<td>".($row->ResidentFee+$row-> AppFee+$row-> TransFee)."</td>";
			$result.="<td>".$row->PeriodCovered."</td>";
			$result.="</tr>";	
			//$result.="<tr>";
			$_SESSION['report_values'][$cnt][0]=ucwords(strtolower($row->Name));
			$_SESSION['report_values'][$cnt][1]=$row->College;
			$_SESSION['report_values'][$cnt][2]=$row->ResidentFee;
			$_SESSION['report_values'][$cnt][3]=$row-> AppFee;
			$_SESSION['report_values'][$cnt][4]=$row-> TransFee;
			$_SESSION['report_values'][$cnt][5]=($row->ResidentFee+$row-> AppFee+$row-> TransFee);
			$_SESSION['report_values'][$cnt][6]=$row->PeriodCovered;
				
	
 	$cnt++;
 	}
	
	$result.="</table>";
	
		}else{
			$result = "No Records Found";
		}
 	return $result;
 }
 
	function setTransTable($month){//set transient table
 		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
 		$result="";
		$sql = "Select Count(*) from transient where TYPE='INDIVIDUAL' and RATES='UP' and MONTH='$month'" ;
		$result[0] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		$sql = "Select Count(*) from transient where TYPE='INDIVIDUAL' and RATES='NON-UP' and MONTH='$month'" ;
		$result[1] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		$sql = "Select Count(*) from transient where TYPE='GROUP' and RATES='UP' and MONTH='$month'" ;
		$result[2] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		$sql = "Select Count(*) from transient where TYPE='GROUP' and RATES='NON-UP' and MONTH='$month'" ;
		$result[3] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "SELECT SUM(AmountPaid) from transient where TYPE='INDIVIDUAL' and MONTH='$month'" ;
		$result[4] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$sql = "SELECT SUM(AmountPaid) from transient where TYPE='GROUP' and MONTH='$month'" ;
		$result[5] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		
		//$sql = "SELECT SUM(AmountPaid) FROM transient" ;
		//$result[4] = $this->{$this->db_group_name2}->query($sql) or die("tally".$this->{$this->db_group_name2}->error());
		
		$arr ="";
		
 	for($i = 0; $i < count($result); $i++){
			$ar = $result[$i]->result();
			
    		 $ar = (array)$ar[0];
    		 $ar = array_values($ar);
    		$arr[$i] = $ar[0];
		}
		return $arr;
 }
	/* itatanong pa ito sa kanila
	 function getTransientInfo(){
	 	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
	 	
	 	$this->{$this->db_group_name2}->select('FirstName,LastName,MidName');
		$this->{$this->db_group_name2}->from('transient');
		$info = $this->{$this->db_group_name2}->get();
		$arr = "";
		$cnt=0;	
			foreach ($info->result() as $row)
					{
							
					 $arr[$row->FirstName."*".$row->MidName."*".$row->LastName] = $this->getIndiTransientInfo($row->FirstName,$row->MidName,$row->LastName); 
					}
	 return $arr;
	 }
	function getIndiTransientInfo($fname,$mname,$lname){
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
	 
		$this->{$this->db_group_name2}->select('CheckIn,CheckOut');
		$this->{$this->db_group_name2}->where('FirstName',$fname); 
		$this->{$this->db_group_name2}->where('LastName', $lname); 
		$this->{$this->db_group_name2}->where('MidName',$mname); 
		$this->{$this->db_group_name2}->from('transient');
		$info = $this->{$this->db_group_name2}->get();
			foreach ($info->result() as $row)
					{
							
						return $row->CheckIn."*".$row->CheckOut."*".$row->Type."*".$row->Rates; 
					}
	}*/
 
	function getDormData($data){
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
 
		$this->{$this->db_group_name2}->select($data);
		$info = $this->{$this->db_group_name2}->get('dorm');
			foreach ($info->result() as $row)
				{
						
					return $row->$data;
				}
				return "";
	}

	function getDormAppData($appName,$data){
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
 
		$this->{$this->db_group_name2}->select($data);
		$this->{$this->db_group_name2}->where('ApplianceName',$appName); 
		
		$info = $this->{$this->db_group_name2}->get('dormappliance');
		foreach ($info->result() as $row)
				{
						
					return $row->$data;
				}
		return -1;
	}

	function getChangeAppClus($_POST,$num){
		$pay = "";
		for($i=0;$i<$num;$i++){
			if(isset($_POST["appClus$i"])&&is_numeric($_POST["appClus$i"])){
				$pay.=$_POST["appClus$i"]."*";		
			}else{
				$_SESSION["Settings"] = "Error in Value";
				redirect('');
			}
		}
	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
 
	$pay = substr($pay,0,strlen($pay)-1);
	$appName = $_SESSION["appNameClus"];
		$sql = "UPDATE dormappliance
				SET payment='$pay'
				WHERE ApplianceName	='$appName'";
	
	$this->{$this->db_group_name2}->query($sql);
	}

	function getAppPay($appName){
		
		$sql = "Select Payment from dormappliance where ApplianceName='$appName'";
		 $query= $this->{$this->db_group_name2}->query($sql);
		foreach($query->result() as $row){
			return $row->Payment;
		}
	
	}
}














?>