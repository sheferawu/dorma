<?php 
session_start();
class Dorm extends CI_Controller{
	//note: every 30 days ang bayad
	
	function __construct(){
		
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper("url");
		$this->load->model('Residentmodel');
		$this->load->model('Dormmodel');
		
	}
	
	function index(){
		
		$this->load->view("homeView");
	}
	
	function logout(){
		$this->Dormmodel->logoutUser();
	}	
	
	function setting(){
		$data["dorm"]= $this->Dormmodel->edit_settings();
		$data["dormApp"]= $this->Dormmodel->getDormApp();
		$this->load->view('dormSetting',$data);
			
	}
	function saveSettings(){
		$this->Dormmodel->saveSettings($_POST);
		redirect('');
	}
	function setNumApp(){
  		
  		if(isset($_GET["numapp"])){
  			
  			$_SESSION["numAppSet"] = $_GET["numapp"];
  			
  		}
  	}
  	function checkUser(){
	
		$enteredUserName = $_POST['username'];
		$enteredPassword = $_POST['password'];
		$loginMode = $_POST['loginMode'];
		$dormName= $_POST['dormname'];
		$_SESSION["username"] = $enteredUserName;
		$_SESSION["dormname"] =$dormName;
		
		//$dorma = $this->getDorma();
		//echo $dormName;
		if($loginMode == "dormManager"){
			if($this->getManager($enteredUserName,$dormName)){
				//$realPassword = $this->getPassword($dorma); 
				if($this->getPassword($enteredPassword)){
					$this->load->model('Startmodel');
					if($this->Startmodel->getDatabaseReady($dormName)==0){
					$_SESSION["DATABASE"] = $this->Dormmodel->createDb($dormName);
					}
					$_SESSION['username'] = $enteredUserName;
					$_SESSION['password'] = $enteredPassword;
					$_SESSION["DormNameHome"] =  $this->Startmodel->getDormData($dormName,'DormName');
					$this->load->model('Dormmodel');
					$this->Startmodel->setDatabaseReady($dormName);
					
					
					redirect('');
				}else{
					unset($_SESSION['username']);
				unset($_SESSION['password']);
				
					$_SESSION['message'] = "Passwords does not match. Try Again";
					redirect('');
				}
			}else{
				unset($_SESSION['username']);
				unset($_SESSION['password']);
				echo $enteredUserName;
				$_SESSION['message'] = "Username does not exist. Try Again".$dormName;
				redirect('');
			}
		}else if($loginMode == "houseStaff"){
			if($this->getHousing($enteredUserName)){
				//$realPassword = $this->getPassword($dorma); 
			
				if($this->getHousePassword($enteredUserName,$enteredPassword)){
					$_SESSION['username'] = $enteredUserName;
					$_SESSION['password'] = $enteredPassword;
					
					redirect('house');
				}else{
					unset($_SESSION['username']);
				unset($_SESSION['password']);
				
					$_SESSION['message'] = "Passwords does not match. Try Again";
					redirect('');
				}
			}else{
				unset($_SESSION['username']);
				unset($_SESSION['password']);
					
				$_SESSION['message'] = "Username does not exist. Try Again".$dormName;
				echo $enteredUserName;
				redirect('');
			}
		}

		
	}
	
	function getPassword($pwd){
		
		$this->load->model('Startmodel');
		return $this->Startmodel->getDormPassword($pwd);
	}
	
	function getHousePassword($userName,$pwd){
		
		$this->load->model('Startmodel');
		return $this->Startmodel->getHousingPassword($userName,$pwd);
	}
	
	// returns 1 or 0
	function getManager($uname,$dname){
		$this->load->model('Startmodel');
		return $this->Startmodel->getDormManager($uname,$dname);
	}
	
	// returns 1 or 0
	function getHousing($uname){
		$this->load->model('Startmodel');
		return $this->Startmodel->getHousingStaff($uname);
	}
	
	
	function getOccupancy(){
		return $this->Dormmodel->getDormData('Occupancy');
	}
	
	function getHousingHead(){
		$this->load->model('Startmodel');
		return $this->Startmodel->getHousingData('HousingHead');
	
	}
	
	function getHousingChief(){
		$this->load->model('Startmodel');
		return $this->Startmodel->getHousingData('HousingChief');
	
	}
	
	function getDorma(){
		$this->load->model('Startmodel');
		return $this->Startmodel->getDormData($this->Dormmodel->getDormData('Alias'),'Manager');
	}
	
	function getDormName(){
			return $this->Dormmodel->getDormData('DormName');
	}
	
	function getSY(){
			return $this->Dormmodel->getDormData('SchoolYear');
	}
	
	function getTerm(){
			return $this->Dormmodel->getDormData('Term');
	}

	function getNumberOfRooms(){
			return $this->Dormmodel->getDormData('NumberOfRooms');
	}
	
	function getMaxResidentPerRoom(){
		return $this->Dormmodel->getDormData('MaxResidentPerRoom');
		
	}
	
	function testGetCluster(){//unit testing for the function getCluster of class Dorm
				$this->load->library('unit_test');
				
				$testCluster= $this->getCluster(1);
				
				$arrTestCluster = explode("-",$testCluster);//divide the two period
				$this->unit->run($arrTestCluster,'is_array','Dorm Class test function: getCluster1; test if array');
				$this->unit->run(count($arrTestCluster),2,'Dorm Class test function: getCluster2; test if count(array)==2');
				echo $this->unit->report();
	}
	
	function getCluster($num){//papainput sa kila dorma
		$c="";	
		$arr =$this->Dormmodel->getCluster();
		if($arr!=""){
			$cnt = 1;
			foreach($arr as $ar){
			if($num==$cnt){
			$c = $ar;
			}
			
			$cnt++;
			}
		
		}
		
	return $c;
	}
	
	function getAllClusters(){
			return  $this->Dormmodel->getCluster();
		
	}
	
	function testCheckIfItsTimeToPay(){
			$this->load->library('unit_test');
			$arrPeriodTopay=$this->checkIfItsTimeToPay("02/02/2011");
			$this->unit->run($arrPeriodTopay,'is_array','Dorm Class test function: checkIfItTimeTopay1; test if array');
			echo $this->unit->report();
	}
	
	function checkIfItsTimeToPay($date){
		
		$dateNow =  $date;
		//$dateNow = "02/02/1999";
		$d = explode("/",$dateNow);//ginagawang array
		//$sumD = $d[0]+$d[1]+$d[2];
		$includedClusters="";
		$cnt = 0;
		$numClus = $this->Dormmodel->getDormData("NumCluster");
		/* assumption na may limang cluster*/
		
		for($i= 1;$i<=$numClus;$i++){ //loop para malaman kung anong mga included na cluster ang dapat bayaran
				$cluster= explode("-",$this->getCluster($i));//gawing array yung cluster na may format na mm1/dd1/yy1-mm2/dd2/yy2
	if($cluster[0]!=""){
				$e = explode("/",$cluster[1]); //kuhanin yung pangalawang bahagi ng cluster -> mm2/dd2/yy2
			//ang mga if na ito ay tinitignan lang kung kasama si cluster sa dapat ng bayaran
			if($d[2]>=$e[2]){//para sa taon
				if($d[2]>$e[2]){
					$includedClusters[$cnt++] = $i; //ilagay na agad sa kasama pag mas malaki ang taon ngayon kesa sa taon ng cluster
					}else{
						if($d[0]>=$e[0]){// para sa buwan
						 if(strcasecmp($d[0],$e[0])>0){
							$includedClusters[$cnt++] = $i;//ilagay kung mas malaki(mas matagal?) ang buwan ngayon kesa sa buwan ng cluster
							}else{
								if($d[1]>=$e[1]){//para sa araw
									$includedClusters[$cnt++] = $i;
							
								}
							}		
						}		
					}
				}
		}else{break;}
			}
	return $includedClusters;
	}
	
	function getMonthlyRent($dormname){
		
		//magkakaif sa future
		return $this->Dormmodel->getDormData('MonthlyRent');
	
	}
	
	function getDailyRent($dormname){
		
		return $this->Dormmodel->getDormData('DailyRent');
		
	}
	
	function getTFUPRent($dormname){
		
		return $this->Dormmodel->getDormData('TFUP');
		
	}
	
	function getTFNUPRent($dormname){
		
		return $this->Dormmodel->getDormData('TFNUP');
		
	}
	
	function getMonthlyApplianceFee($dormname,$appName){ //will make a database table for this in the future
		$appName = trim(strtoupper($appName));
		return $this->Dormmodel->getDormAppData($appName,'MonthlyRent');
	}
	
	function getDailyApplianceFee($dormname,$appName){ //will make a database table for this in the future
		$appName = trim(strtoupper($appName));
		return $this->Dormmodel->getDormAppData($appName,'DailyRent');
		
	}
	
	function getStartDate(){
			return $this->Dormmodel->getDormData('StartDate');
			
	}
	
	function getEndDate(){
			
			return $this->Dormmodel->getDormData('EndDate');
	}
	
	function deletepay(){
			if(isset($_GET["lname"])&&isset($_GET["fname"])&&isset($_GET["mname"])){//this is the primary key of the table resident
				$lname = $_GET["lname"] ;
				$fname = $_GET["fname"] ;
				$mname = $_GET["mname"] ;
				$this->Dormmodel->delete_resident_pay($fname,$lname,$mname);
		
			}	
		
	}
	
	function updateBalance(){
		$this->listResidentsWithAccount("",3,date('m/d/Y'));
		echo "Balance Updated";
	}
	
	function pay(){
		if(isset($_SESSION["lNamePay"])&&isset($_SESSION["fNamePay"])&&isset($_SESSION["mNamePay"])){
			 $data["checkIn"]= $this->Residentmodel->getDateCheckIn($_SESSION["fNamePay"],$_SESSION["mNamePay"],$_SESSION["lNamePay"]);
			if($data["checkIn"]!=""){
			$clusters=$this->getAllClusters();
			//$date =   strftime("%m/%d/%Y");
			$date = "12/31/3000";
			$paid = $this->Dormmodel->getPaidPeriods($_SESSION["fNamePay"],$_SESSION["lNamePay"],$_SESSION["mNamePay"],$date);
			$data["arrClus"] = $this->Dormmodel->getMissedPeriods($paid,$clusters);
			//$data["paid"] = $paid; 
			
			$data["sy"] = $this->getSY();
			$this->load->view("recordOfPayment",$data);
			}else{
			echo "<br/>Resident Has no Log-in Information<br/>";
			}
		}
	}
	
	function getpay(){
		if(isset($_SESSION["lNamePay"])&&isset($_SESSION["fNamePay"])&&isset($_SESSION["mNamePay"])){
		 	
		 	$pc = explode("-",$_GET["periodcovered"]);
			$start = $pc[0];
			$end = $pc[1];
			$term = $_SESSION["term"];
			$name =$_SESSION["lNamePay"]."@".$_SESSION["fNamePay"]."@".$_SESSION["mNamePay"];
			$appFee = $this->getApplianceFee($name,$start,$end);
			$resFee =$this->getResidentFee($name,$start,$end) ;
			$this->Dormmodel->paymentOpt($_GET,$appFee,$resFee,$term);
			
		
		}	
	}
	
	/*function listWantedResidents(){
		$numPeriodsArr= $this->checkIfItsTimeToPay();
		$cnt = 0;
		$periodsArr ="" ;
		foreach($numPeriodsArr as $a){$periodsArr[$cnt++]  =$this-> getCluster($a);}
		$recordOfPayment= $this->Dormmodel->getPaymentPeriods($periodsArr);
		$data['wList'] = $recordOfPayment;
		$data['pList'] =$periodsArr;
		$this->load->view('wantedlist',$data);	 
		
	
	}*/
	
	function testGetResidentFee(){
		$this->load->library('unit_test');
		$start ="11/03/2010";
		$fullName = "ABELLA@PAULA BIANCA@SAMANIEGO ";
		$end ="03/04/2011";
		$price=$this->getResidentFee($fullName,$start,$end);
		$day= $price;
		echo "$price<br/>";
		$this->unit->run($day,"is_string",'Dorm Class test function: getResidentFee;');
		echo $this->unit->report();
	}
	
	function getResidentFee($name,$start,$end){
			$dorm = $this->Dormmodel->getDormData('Alias');
			$fullName = explode("@",$name);
			$checkin = $this->Residentmodel->getDateCheckIn($fullName[1],$fullName[2],$fullName[0]);
			
			if($checkin!=""){
			
			$ci=explode("/",str_replace("@","",$checkin));
			$st=explode("/",str_replace("@","",$start));
			$en=explode("/",str_replace("@","", $end));
			
			$residentFee = 0;
			$dt = date_create($ci[2]."-".$ci[0]."-".$ci[1]);
			$datetime1 = date_create($st[2]."-".$st[0]."-".$st[1]);
			$datetime2 = date_create($en[2]."-".$en[0]."-".$en[1]);
		$here = 0;
		if($dt<=$datetime2){
			if($dt>$datetime1){$datetime1 = $dt; $here =1; }
		$dayFee= "0";
			$datetime2->add(new DateInterval('P1D'));
			$interval = date_diff($datetime2, $datetime1);
			$l =$this->getDailyRent($dorm);
			bcscale(2);
			
			$m = $interval->format('%m');
			$l1 = ($this->getMonthlyRent($dorm));
			$d = $interval->format('%d');
			
			if($here==1||($d>15&&$d<29)){
			$d = $interval->format('%d');
			$dayFee=bcmul($l ,(string)($d));
			}
			if($d>=29){
				$m++;
			}
			$monthFee= bcmul($m ,(string)$l1);
			$residentFee =bcadd($dayFee,$monthFee);
			
 		return	$residentFee;
		}
		}
		return "0";
		
 	}
 	
	function getTransientFee($name,$start,$end){
			$dorm = $this->Dormmodel->getDormData('Alias');
			$fullName = explode("@",$name);
			$checkin = $this->Residentmodel->getDateCheckIn($fullName[1],$fullName[2],$fullName[0]);
			$rate = $this->Residentmodel->getTransientRate($fullName[1],$fullName[2],$fullName[0]);
			if($checkin!=""){
			
			$ci=explode("/",str_replace("@","",$checkin));
			$st=explode("/",str_replace("@","",$start));
			$en=explode("/",str_replace("@","", $end));
			
			$transientFee = 0;
			$dt = date_create($ci[2]."-".$ci[0]."-".$ci[1]);
			$datetime1 = date_create($st[2]."-".$st[0]."-".$st[1]);
			$datetime2 = date_create($en[2]."-".$en[0]."-".$en[1]);
		
		if($dt<=$datetime2){
			if($dt>$datetime1){$datetime1 = $dt;}
		
			$datetime2->add(new DateInterval('P1D'));
			$interval = date_diff($datetime2, $datetime1);
			
			if (trim(strtoupper($rate)) == "UP")
				$l1 = ($this->getTFUPRent($dorm));
			else if (trim(strtoupper($rate)) == "NON-UP")
				$l1 = ($this->getTFNUPRent($dorm));
			
			bcscale(2);
			$d = $interval->format('%d');
			$dayFee=bcmul($l ,(string)($d));
		
			
			$transientFee = $dayFee;
			
 		return	$transientFee;
		}
		}
		return "0";
		
 	}
	
 	function testGetApplianceFee(){
 			$this->load->library('unit_test');
 			$fullName = "L@L@LAWLIET";
 			$start ="03/06/2011";
			$end ="04/01/2011";
 			
			$test= $this->getApplianceFee($fullName,$start,$end);
 			$this->unit->run($test,"16.2",'Dorm Class test function: getApplianceFee;');
			echo $test;
 			
 			$start ="11/03/2010";
			$end ="12/02/2010";
			$price=$this->getApplianceFee($fullName,$start,$end);
			$this->unit->run($price,"18",'Dorm Class test function: getResidentFee;');
		
 		echo $test;
 		//echo $_SESSION["lol"];		
 			echo $this->unit->report();
			
 	}
 	
 	function getApplianceFee($name,$start,$end){
			$fullName = explode("@",$name);
			$arr=$this->Residentmodel->getApp($fullName[1],$fullName[2],$fullName[0]);
			$dorm = $this->Dormmodel->getDormData('Alias');
			
			$appFee = "0";
			if($arr!=""){
				$st=explode("/",str_replace("@","", $start));
				$en=explode("/",str_replace("@","", $end));
				
 				$datetime1 = date_create($st[2]."-".$st[0]."-".$st[1]);
				$datetime2 = date_create($en[2]."-".$en[0]."-".$en[1]);
				
				
			for($i =0;$i<count($arr);$i++){
				
				$eArr=explode("@",$arr[$i]);
				
				$l =($this->getDailyApplianceFee($dorm,$eArr[0]));
				$in=explode("/",str_replace("@","", $eArr[1]));
				
				$dt = date_create($in[2]."-".$in[0]."-".$in[1]);
			if($dt<=$datetime2){
				$here = 0;
			if($dt>$datetime1){$datetime1 = $dt; $here = 1;}
				$datetime2->add(new DateInterval('P1D'));
				
				$interval = date_diff($datetime1, $datetime2);
				
				$d = ($interval->format('%d'));
				
				bcscale(2);
				$dayAppFee ="0";
				if($here==1||($d>15&&$d<29)){
				$dayAppFee =bcmul((string)$d,$l);
				}
				$l1 = $interval->format('%m');
				
				$m =($this->getMonthlyApplianceFee($dorm,$eArr[0]));
				if($d>=29){
				$l1++;
				}
				$monthAppFee= bcmul($m,(string)$l1);
				$temp = bcadd($dayAppFee,$monthAppFee);
				$appFee = bcadd((string)$appFee,$temp);
			}
			}
			}
		
	return $appFee;
	}
	
	function residentsWithAccount(){
		
		if($_GET["m2"]!=0){
		$dorm = ucwords($this->getDormName());
		$header=  "<center>$dorm<br/>";
		$header.= "Student Housing Division<br/>";
		$header.= "UPLB Housing Division<br/>";
		$header.= "Student College, Laguna<br/>";
		$header.= "List of Residents with account for ";
		$this->listResidentsWithAccount($header,0,$_GET["date"]);
		}
		else{
				
			 $clusters= $this->Dormmodel-> getDormData("Clusters");
			
			 $clustersArr = explode("*",$clusters);
			 if(count($clustersArr)>1){
			 	 echo "<h2>Resident Report</h2><br/>";
			echo "<select name=\"month\" onchange=\"getResReport(this.options[this.selectedIndex].value,'1')\">";
				echo "<option value=\"0\">Select Report</option>";
			 foreach($clustersArr as $ca){
			 	$explodedCa = explode("-",$ca);
			 	echo "<option value=\"$explodedCa[1]\">Report for: $ca</option>";
			 }
			echo "</select>";
			 }else{
			 echo "No record";
			 }
		
		}
	}
	
	function transientsWithAccount(){
		if($_GET["m2"]!=0){
		$dorm = ucwords($this->getDormName());
		$header=  "<center>$dorm<br/>";
		$header.= "Student Housing Division<br/>";
		$header.= "UPLB Housing Division<br/>";
		$header.= "Student College, Laguna<br/>";
		$header.= "List of Transients with account for ";
		$this->listTransientsWithAccount($header,$_GET["date"]);
	
		}else{
				
			 $clusters= $this->Dormmodel-> getDormData("Clusters");
			
			 $clustersArr = explode("*",$clusters);
			 if(count($clustersArr)>1){
			 echo "<h2>Transient Report</h2><br/>";
			
			echo "<select name=\"month\" onchange=\"getResReport(this.options[this.selectedIndex].value,'2')\">";
				echo "<option value=\"0\">Select Report</option>";
			 foreach($clustersArr as $ca){
			 	$explodedCa = explode("-",$ca);
			 	echo "<option value=\"$explodedCa[0]\">Report for: $ca</option>";
			 }
			echo "</select>";
			 }else{
			 echo "No record";
			 }
		
		}
	}
	function applianceReport(){
	
		if($_GET["m2"]!=0){
		 $arrOfAppRec= $this->Residentmodel->getAppRecords($_GET["date"]);
		 $data["appRec"] = $arrOfAppRec;
		 
		 $data["sy"] = $this->getSY();
		 $data["term"] = $this->getTerm();
		 $data["dormName"] = $this->getDormName();
		 $data["dorma"] = $this->getDorma();
		 $data["housingChief"] = $this->getHousingChief();
		 $data["housingHead"] = $this->getHousingHead();
		  
		 $this->load->view("applianceReport",$data);
	}else{
				
			 $clusters= $this->Dormmodel-> getDormData("Clusters");
			
			 $clustersArr = explode("*",$clusters);
			 if(count($clustersArr)>1){
			echo "<h2>Appliance Report</h2><br/>";
			 echo "<select name=\"month\" onchange=\"getResReport(this.options[this.selectedIndex].value,'3')\">";
				echo "<option value=\"0\">Select Report</option>";
			 foreach($clustersArr as $ca){
			 	$explodedCa = explode("-",$ca);
			 	echo "<option value=\"$explodedCa[0]\">Report for: $ca</option>";
			 }
			echo "</select>";
			 }else{
			 echo "No record";
			 }
		
		}
	}
	
	function accountsReceivable(){
		unset($_SESSION['report_upper']);
		unset($_SESSION['apt']);
		unset($_SESSION['report_header']);
		unset($_SESSION['report_values']);
		$header = "<center>ACCOUNTS RECEIVABLE FROM PREVIOUS RESIDENTS</center></br>";	
		$data["header"] = $header; 
		$data["table"] = $this->Dormmodel->getAccountReceivable();

		$this->load->view("accountsReceivable",$data);
	}
	
	function editPrev(){
		if(isset($_POST["saveChanges"])){
			$this->Dormmodel->saveEditPrev($_POST);
			$_SESSION["Settings"] = "Dorm settings saved!";
		redirect('');
		}
		$this->Dormmodel->editPrev();
    		
	}
	
	function newTerm(){
		if(isset($_POST["saveChanges"])){
		if(isset($_POST["check"])){
    	$selected = $_POST["check"];
    	$numSelected = count($selected);
    	//print_r($_POST['check']);
    	for($i = 0; $i < $numSelected; $i++){
    		$arr = explode("@",$selected[$i]);
    		$this->Residentmodel->delete_resident($arr[0],$arr[2],$arr[1]);
    	}
    	}
		if(isset($_POST["balcheck"])){
    	$selected = $_POST['balcheck'];
    	$numSelected = count($selected);
    	for($i = 0; $i < $numSelected; $i++){
    		$arr = explode("@",$selected[$i]);
    		
    		$col =$this->Dormmodel->getCollegeStudNum($arr[0],$arr[1],$arr[2]);
    		$name = "";
    		$cnt = 0;
    		$name= $arr[0]." ".$arr[1]." ".$arr[2];
    		$this->Dormmodel->setPrevAccounts($name,$arr,$col);
    		
    		
    		$this->Residentmodel->delete_resident($arr[0],$arr[2],$arr[1]);
    		
    	}
    	
    	}
		$_SESSION["Settings"] = "Dorm settings saved!";
		redirect('');
		}else{
		$table = $this->Dormmodel->newTerm();
		}
	}
	
	function listResidentsWithAccount($header,$mode,$date){
		
		$numPeriodsArr= $this->checkIfItsTimeToPay($date);//get the number of included cluster for this month
		
		$cnt = 0;
		$periodsArr ="" ;
		if($numPeriodsArr!=""){
		foreach($numPeriodsArr as $a){$periodsArr[$cnt++] =$this-> getCluster($a);} //get all of the clusters
		$recordOfPayment= $this->Dormmodel->getPaymentPeriods($periodsArr,$date);
		
		if($recordOfPayment!=""){
		ksort($recordOfPayment);
		
		$kList= array_keys($recordOfPayment);
		$cnt = 0;
		$residentWithAccounts="";
		$endperiod = "0/0/0";
		foreach($recordOfPayment as $r){
				$residentFee = 0;
				$appFee = 0;
				$qList = explode("/",$kList[$cnt]);
				$rp = explode("*",$r);
			
				
				$start = explode("-",$rp[0]);
				$end = explode("-",$rp[count($rp)-1]);
			    $residentFee=$this->getResidentFee($qList[0],$start[0],$end[1]);
			
			    $appFee=$this->getApplianceFee($qList[0],$start[0],$end[1]);
				
				bcscale(2);
				$total = bcadd($appFee , $residentFee);
				
				 $fullName = explode("@",$qList[0]);
			     if($mode==3){
				 $arr=$this->Residentmodel->setBalance($fullName[1],$fullName[2],$fullName[0],$start[0]."-".$end[1],$residentFee,$appFee,$total);
			     }
				$residentWithAccounts[$kList[$cnt]] = $start[0]."-".$end[1]."&".$residentFee."&".$appFee."&".$total;
				$cnt++;
			$endperiod = $end[1];
				
						
		}
		if($mode==3){ return;}
		if($mode==4){return $residentWithAccounts;}
		if($mode!=3){
		if($mode==0){
		$data['time'] =$endperiod;
		$data['header'] =$header;
		
		}else{
		$data['header1'] =$header;
		
		}	
		$data['residentWithAccounts'] =$residentWithAccounts;
	
		$this->load->view('residentWithAccounts',$data);
		}
	}else{
		$data['residentWithAccounts'] ="NO RECORDS FOUND!";
	
		$this->load->view('residentWithAccounts',$data);
		}
	}else{echo "No record!";}
	}
	
	function listTransientsWithAccount($header,$date){
		
		$data["header"] = $header;
		
		$data["transRec"]= $this->Dormmodel->getTransientPaymentPeriods($date);
		
		$data['time'] = date("m/d/Y");
		$this->load->view("transientWithAccounts",$data);
		
		
	}
	
	
	
	function currentAccomplishReport(){
			
			if($_GET["m2"]!=0){
			$dateNow = $_GET["date"];
			$d = explode("/",$dateNow);
			$this->accomplishReport($d[0],$d[2]);
			}else{
				 $clusters= $this->Dormmodel-> getDormData("Clusters");
		
			 $clustersArr = explode("*",$clusters);
			 if(count($clustersArr)>1){
			 echo "<h2>Accomplishment Monthly Report</h2><br/>";
			echo "<select name=\"month\" onchange=\"getAccReport(this.options[this.selectedIndex].value,'Day','Year')\">";
				echo "<option value=\"0\">Select Report</option>";
			 foreach($clustersArr as $ca){
			 	$explodedCa1 = explode("-",$ca);
			 	$explodedCa = explode("/",$explodedCa1[0]);
				$month =$explodedCa[0]; 
			 	switch($month){
				case 1 : $month = "January"; break;
				case 2 : $month = "Febuary"; break;
				case 3 : $month = "March"; break;
				case 4 : $month = "April"; break;
				case 5 : $month = "May"; break;
				case 6 : $month = "June"; break;
				case 7 : $month = "July"; break;
				case 8 : $month = "August"; break;
				case 9 : $month = "September"; break;
				case 10 : $month = "October"; break;
				case 11 : $month = "November"; break;
				case 12 : $month = "December"; break;
				}
			 	
			 	echo "<option value=\"$explodedCa1[0]\">Report for:$month </option>";
			 }
			echo "</select>";
			 }else{
			 echo "No record";
			 }
		
			}
	}
	
	function accomplishReport($month,$year){
			
		 $part1Table1= $this->Residentmodel->tally_resident(0);
		 $part2Table1 = $this->Residentmodel->getNumberOutIn($month);
		 $data["part1Table1"] = $part1Table1;
		 $data["part2Table1"] = $part2Table1;
		 $data["occ"] = $this->getOccupancy();
		 $appData = $this->Residentmodel->getUnitsOfAppliances($month); 
		 $accCol = $this->Residentmodel->getActualCollection($month);
		 $data["appData"] = $appData;
		 $data["accCol"] = $accCol;
		 $data["accRe"]  = $this->Residentmodel->getAccountReceivable($month);
		 $data["prevAccRe"] = $this->Residentmodel->getPrevAccountReceivable($month);
		 $data["table6"] 	 = $this->Dormmodel->view_workload($month);
		 $data["month"] = $month;
		 $data["year"] = $year;
		
		 $data["transData"]=$this->Dormmodel->setTransTable($month);
		 $this->load->view("accomplishReport",$data);
	}
	
	function addProject(){
		$this->load->view('NewWorkload');
	}
	
	function getWorkload(){
		if(isset($_POST['workload'])){
			$str=$this->Dormmodel->add_workload($_POST);
			$str = "New workload added!<br/>";
			$_SESSION["newResidentInfo"].=$str; 
			redirect("home");
		}
	}
	
	function updateWorkload(){
		if(isset($_POST['editWorkload'])){
			$str=$this->Dormmodel->update_workload($_POST);
			$str = "Workload successfully edited!<br/>";
			$_SESSION["newResidentInfo"].=$str; 
			redirect("home");
		}
	}
	
	function removeWorkload(){
		if(isset($_POST['delWorkload'])){
			$str=$this->Dormmodel->remove_workload($_POST["deleteWork"]);
			$str = "Workload successfully deleted!<br/>";
			$_SESSION["newResidentInfo"].=$str; 
			redirect("home");
		}
	}
	
	function editWorkload(){
		$data["projects"] = $this->Dormmodel->edit_workload();
		$this->load->view("EditWorkload", $data);
	}
	
	function deleteWorkload(){
		$data["projects"] = $this->Dormmodel->delete_workload();
		$this->load->view("EditWorkload", $data);
	}
	
	function viewWorkload(){
		$this->Dormmodel->view_workload();
	}

	function about(){
		$this->load->view("aboutUs");
	}
}