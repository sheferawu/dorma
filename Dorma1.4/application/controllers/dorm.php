<?php 
session_start();
class Dorm extends CI_Controller{
	//note: every 30 days ang bayad
	
	function __construct(){
		
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper("url");
		$dormName = "New Dorm"; //to be made dynamically in future releases 
		//$_SESSION["DORMNAME"] = $dormName; 
	//	$_SESSION["monthlyRent"] = "650"; //magiging array sa future
		//$_SESSION["dailyRent"] = "21.7"; //magiging array sa future
		//$_SESSION["startDate"] ="11/03/2010";	
		//$_SESSION["endDate"] ="04/01/2011";	
		//$_SESSION["numberOfRooms"] =50;	
	//	$_SESSION["maxResidentPerRoom"] =6;	
		$this->load->model('Residentmodel');
		$this->load->model('Dormmodel');
		
		//$_SESSION["term"] = "2";
		//$_SESSION["sy"] = "2010-2011";
		//$_SESSION["Dorma"] = "Cory M. Mariano";
		//$_SESSION["HousingHead"] = "ROWENA C. CARDENAS";
		//$_SESSION["HousingChief"] = "MARGARET M. CALDERON";
		//$_SESSION["Occupancy"] = 288;
		//$_SESSION["uname"] = "";
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
		 $dormName= $_POST['dormname'];
		$_SESSION["uname"] = $enteredUserName;
		$_SESSION["dormname"] =$dormName;
		
		//$dorma = $this->getDorma();
		//echo $dormName;
		if($this->getManager($enteredUserName,$dormName)){
			//$realPassword = $this->getPassword($dorma); 
			if($this->getPassword($enteredPassword)){
				$_SESSION["DATABASE"] = $this->Dormmodel->createDb($dormName);
				$_SESSION['username'] = $enteredUserName;
				$_SESSION['password'] = $enteredPassword;
				
				redirect('');
			}else{
				$_SESSION['message'] = "Passwords does not match. Try Again";
				redirect('');
			}
		}else{
			$_SESSION['message'] = "Username does not exist. Try Again";
			redirect('');
		}
		
		
		
		
	}
	function getPassword($pwd){
		//sa hinaharap ay mag iif
		$this->load->model('Startmodel');
		return $this->Startmodel->getDormPassword($pwd);
	}
	
	// returns 1 or 0
	function getManager($uname,$dname){
		$this->load->model('Startmodel');
		return $this->Startmodel->getDormManager($uname,$dname);
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
	
	function makeClusters(){//gagawin pa ba ito?
		
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
		$arr =$this->Dormmodel->getCluster("1",$num,$this->Dormmodel->getDormData('Alias'));
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
			return  $this->Dormmodel->getCluster("1",5,$this->Dormmodel->getDormData('Alias'));
		
	}
	
	function testCheckIfItsTimeToPay(){
			$this->load->library('unit_test');
			$arrPeriodTopay=$this->checkIfItsTimeToPay();
			$this->unit->run($arrPeriodTopay,'is_array','Dorm Class test function: checkIfItTimeTopay1; test if array');
			echo $this->unit->report();
	}
	function checkIfItsTimeToPay(){
		$dateNow =  date("m/d/Y");//kinukuha yung date ngayon
		$d = explode("/",$dateNow);//ginagawang array
		//$sumD = $d[0]+$d[1]+$d[2];
		$includedClusters="";
		$cnt = 0;
		/* assumption na may limang cluster*/
		for($i= 1;$i<=5;$i++){ //loop para malaman kung anong mga included na cluster ang dapat bayaran
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
	
	function pay(){
		if(isset($_SESSION["lNamePay"])&&isset($_SESSION["fNamePay"])&&isset($_SESSION["mNamePay"])){
			 $data["checkIn"]= $this->Residentmodel->getDateCheckIn($_SESSION["fNamePay"],$_SESSION["mNamePay"],$_SESSION["lNamePay"]);
			if($data["checkIn"]!=""){
			$clusters=$this->getAllClusters();
			$paid = $this->Dormmodel->getPaidPeriods($_SESSION["fNamePay"],$_SESSION["lNamePay"],$_SESSION["mNamePay"]);
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
			$bool=$this->Residentmodel->setBalanceFromPay($_SESSION["fNamePay"],$_SESSION["mNamePay"],$_SESSION["lNamePay"]);
			//if($bool){
			$this->listResidentsWithAccount("",3);
			//}
			
		
		}	
	}
	
	function listWantedResidents(){
		$numPeriodsArr= $this->checkIfItsTimeToPay();
		$cnt = 0;
		$periodsArr ="" ;
		foreach($numPeriodsArr as $a){$periodsArr[$cnt++]  =$this-> getCluster($a);}
		$recordOfPayment= $this->Dormmodel->getPaymentPeriods($periodsArr);
		$data['wList'] = $recordOfPayment;
		$data['pList'] =$periodsArr;
		$this->load->view('wantedlist',$data);	 
		
	
	}
	
	function testGetResidentFee(){
		$this->load->library('unit_test');
		$start ="03/06/2011";
		$fullName = "CARLO LUIS@MARTINEZ@BATION";
		$end ="04/01/2011";
		$price=$this->getResidentFee($fullName,$start,$end);
		$day= $price/21.7;
		echo "$price<br/>";
		$this->unit->run($day,0,'Dorm Class test function: getResidentFee;');
		
		$start ="11/03/2010";
		$end ="12/02/2010";
		$price=$this->getResidentFee($fullName,$start,$end);
		$this->unit->run($price,"0",'Dorm Class test function: getResidentFee;');
		echo "$price<br/>";
		echo $this->unit->report();
	}
	function getResidentFee($name,$start,$end){
			
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
		
		if($dt<=$datetime2){
			if($dt>$datetime1){$datetime1 = $dt;}
		
			$datetime2->add(new DateInterval('P1D'));
			$interval = date_diff($datetime2, $datetime1);
			$l =$this->getDailyRent("NewDorm");
			bcscale(2);
			$d = $interval->format('%d');
			$dayFee=bcmul($l ,(string)($d));
		
			$m = $interval->format('%m');
			$l1 = ($this->getMonthlyRent("NewDorm"));
			$monthFee= bcmul($m ,(string)$l1);
			$residentFee =bcadd($dayFee,$monthFee);
			
 		return	$residentFee;
		}
		}
		return "0";
		
 	}
 	
	function getTransientFee($name,$start,$end){
			
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
				$l1 = ($this->getTFUPRent("NewDorm"));
			else if (trim(strtoupper($rate)) == "NON-UP")
				$l1 = ($this->getTFNUPRent("NewDorm"));
			
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
			
			
			$appFee = "0";
			if($arr!=""){
				$st=explode("/",str_replace("@","", $start));
				$en=explode("/",str_replace("@","", $end));
				
 				$datetime1 = date_create($st[2]."-".$st[0]."-".$st[1]);
				$datetime2 = date_create($en[2]."-".$en[0]."-".$en[1]);
				
				
			for($i =0;$i<count($arr);$i++){
				
				$eArr=explode("@",$arr[$i]);
				
				$l =($this->getDailyApplianceFee("NewDorm",$eArr[0]));
				$in=explode("/",str_replace("@","", $eArr[1]));
				$_SESSION["lol"]=  $eArr[0]."lol";
				$dt = date_create($in[2]."-".$in[0]."-".$in[1]);
			if($dt<=$datetime2){
			if($dt>$datetime1){$datetime1 = $dt;}
				$datetime2->add(new DateInterval('P1D'));
				
				$interval = date_diff($datetime1, $datetime2);
				
				$d = ($interval->format('%d'));
				
				bcscale(2);
				
				$dayAppFee =bcmul((string)$d,$l);
				
				$l1 = $interval->format('%m');
				$m =($this->getMonthlyApplianceFee("NewDorm",$eArr[0]));
				$monthAppFee= bcmul($m,(string)$l1);
				$temp = bcadd($dayAppFee,$monthAppFee);
				$appFee = bcadd((string)$appFee,$temp);
			}
			}
			}
		
	return $appFee;
	}
	
	
	function residentsWithAccount(){
		$dorm = ucwords($this->getDormName());
		$header=  "<center>$dorm<br/>";
		$header.= "Student Housing Division<br/>";
		$header.= "UPLB Housing Division<br/>";
		$header.= "Student College, Laguna<br/>";
		$header.= "List of Residents with account for ";
		$this->listResidentsWithAccount($header,0);
	
	}
	
	function transientsWithAccount(){
		$dorm = ucwords($this->getDormName());
		$header=  "<center>$dorm<br/>";
		$header.= "Student Housing Division<br/>";
		$header.= "UPLB Housing Division<br/>";
		$header.= "Student College, Laguna<br/>";
		$header.= "List of Transients with account for ";
		$this->listTransientsWithAccount($header,0);
	
	}
	
	function accountsReceivable(){
	$header = "<center>ACCOUNTS RECEIVABLE FROM PREVIOUS RESIDENTS</center></br>";	
	$data["header"] = $header; 
	$data["table"] = $this->Dormmodel->getAccountReceivable();
		$this->load->view("accountsReceivable",$data);
	}
	function listResidentsWithAccount($header,$mode){
		
		$numPeriodsArr= $this->checkIfItsTimeToPay();//get the number of included cluster for this month
		
		$cnt = 0;
		$periodsArr ="" ;
		if($numPeriodsArr!=""){
		foreach($numPeriodsArr as $a){$periodsArr[$cnt++] =$this-> getCluster($a);} //get all of the clusters
		$recordOfPayment= $this->Dormmodel->getPaymentPeriods($periodsArr);
		
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
				$rp = explode(" ",$r);
			
				
				$start = explode("-",$rp[0]);
				$end = explode("-",$rp[count($rp)-1]);
			    $residentFee=$this->getResidentFee($qList[0],$start[0],$end[1]);
			
			    $appFee=$this->getApplianceFee($qList[0],$start[0],$end[1]);
				
				bcscale(2);
				$total = bcadd($appFee , $residentFee);
				
				 $fullName = explode("@",$qList[0]);
			     $arr=$this->Residentmodel->setBalance($fullName[1],$fullName[2],$fullName[0],$start[0]."-".$end[1],$residentFee,$appFee,$total);
			
				$residentWithAccounts[$kList[$cnt]] = $start[0]."-".$end[1]."&".$residentFee."&".$appFee."&".$total;
				$cnt++;
			$endperiod = $end[1];
				
						
		}
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
	
	function listTransientsWithAccount($header,$mode){
		
		$data["header"] = $header;
		
		$data["transRec"]= $this->Dormmodel->getTransientPaymentPeriods();
		$data['time'] = date("m/d/Y");
		$this->load->view("transientWithAccounts",$data);
		
		
	}
	
	function applianceReport(){
		 $arrOfAppRec= $this->Residentmodel->getAppRecords();
		 $data["appRec"] = $arrOfAppRec;
		 
		 $data["sy"] = $this->getSY();
		 $data["term"] = $this->getTerm();
		 $data["dormName"] = $this->getDormName();
		 $data["dorma"] = $this->getDorma();
		 $data["housingChief"] = $this->getHousingChief();
		 $data["housingHead"] = $this->getHousingHead();
		  
		 $this->load->view("applianceReport",$data);
	}
	function currentAccomplishReport(){
			$dateNow =  date("m/d/Y");
			$d = explode("/",$dateNow);
			$this->accomplishReport($d[0]);
			
	}
	function accomplishReport($month){
			
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
		 $data["table6"] 	 = $this->Dormmodel->view_workload();
		
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
	
	function editWorkload(){
		$data["projects"] = $this->Dormmodel->edit_workload();
		$this->load->view("EditWorkload", $data);
	}
	
	function viewWorkload(){
		$this->Dormmodel->view_workload();
	}
}