<?php
session_start();
class Resident extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper("url");
		//$this->load->library('MyClasses/OptionClass');
		$this->load->model('Residentmodel');
		
		$this->load->model('Optionmodel');
	}
	
	function index(){
				
	
	}
	
	function addViolation(){
		$this->load->view('addViolation');
	}
	
	function deleteViolation(){
		$data["violations"] = $this->Residentmodel->getViolationList();
		$this->load->view("deleteViolation", $data);
	}
	
	function removeViolation(){
		if(isset($_POST['delViolation'])){
			$str=$this->Residentmodel->remove_violation($_POST["deleteViolation"]);
			$str = "Violation successfully deleted!<br/>";
			$_SESSION["newResidentInfo"].=$str; 
			redirect("home");
		}
	}
	
	function getViolation(){
		if(isset($_POST['addViolation'])){
			$str=$this->Residentmodel->add_violation($_POST);
			$str = "New violation added!<br/>";
			$_SESSION["newResidentInfo"].=$str; 
			redirect("home");
		}
	}
	
	function editT(){
   		$_SESSION["FirstNameT"] = $_GET["fname"];
		$_SESSION["LastNameT"] = $_GET["lname"];
		$_SESSION["MidNameT"] =$_GET["mname"];
		
   		$this->load->model("Optionmodel");
		$data["arrTrans"] = $this->Residentmodel->editT($this->Optionmodel->returnFieldsArray("transient"),$_GET);
		$this->load->view('editTransient',$data);
		
	}

	function updateTransient(){
   		$this->Residentmodel->updateTransient($_POST,$_SESSION["FirstNameT"],$_SESSION["MidNameT"],$_SESSION["LastNameT"]);
   		$_SESSION["trans"] = "Transient Updated!";
   		redirect('');
   }
   
	
	function addStudent(){
		$this->load->model('Dormmodel');
		$data["app"] = $this->Dormmodel->getDormAppNames();
		$this->load->view('addResident',$data);
	}
	
	function addTransient(){
		
		$this->load->view('addTransient');
	}
	
	function searchGuarantor(){
		
		if(isset($_GET["str"])){
			 $table= $this->Residentmodel->searchGuarantor($_GET["str"]);			
			echo $table;		
		}
	}
	
	function searchViolator(){
	
		if(isset($_GET["fname"])&&isset($_GET["mname"])&&isset($_GET["lname"])){
			 $table= $this->Residentmodel->searchViolator($_GET["fname"],$_GET["mname"],$_GET["lname"]);			
			echo $table;		
		}
		
	}
	
	function testEdit(){
		$this->load->library('unit_test');
		$this->unit->run($this->edit("CARLO LUIS","MARTINEZ","BATION"),"is_array",'Resident test 2 function: edit');//tama kasi ang sagot ay 27 at 27!=3
		echo $this->unit->report();
	}
	
	function edit(){
		if(isset($_GET["fname"]) && isset($_GET["lname"]) && isset($_GET["mname"])){
		$data["numApp"]= $this->Residentmodel->getNumApp($_GET["fname"],$_GET["mname"],$_GET["lname"]);
		$data["resident"]= $this->Residentmodel->edit_resident($_GET["fname"],$_GET["lname"],$_GET["mname"]);
		//print_r($result["Course	"]);
		$this->load->model('Dormmodel');	
		$data["appData"] =str_replace("'","",$this->Dormmodel-> getDormAppNames());
		//print_r($data["appData"]);
		$this->load->view('editResident',$data);
		}
		// return $result;
		//$this->load->view('editResident');
	}

	function updateApp(){
		
		
		if(isset($_SESSION["fname"]) && isset($_SESSION["lname"]) && isset($_SESSION["mname"])){
			
			if(isset($_POST['checkOutApp'])){
				$str = $this->Residentmodel->updateAppliance($_POST, $_SESSION["fname"],$_SESSION["lname"],$_SESSION["mname"]);
				$_SESSION["appCheckedOut"] = "Appliance has been checked out!"; 
			}
			
		}
		redirect("home");
	}
	
	function updateData(){
		
		if(isset($_SESSION["fname"]) && isset($_SESSION["lname"]) && isset($_SESSION["mname"])){
			
			if(isset($_POST['editResident'])){
				
				$str = $this->Residentmodel->updateResident($_POST, $_SESSION["fname"],$_SESSION["lname"],$_SESSION["mname"],$this->getNumApp());
				 $cnt= $this->getNumApp();
				$_SESSION["newResidentInfo"].= "Resident successfully edited!";
			}
			
		}
		redirect("home");
	}
	
	function getData(){
		//print_r($_POST);
		if(isset($_POST['submitResident'])){
		//$this->testGetData($_POST);
		$str=$this->Residentmodel->add_entry($_POST);
		$data['q'] = $str;
		$this->load->view('homeView',$data);
		$_SESSION["newResidentInfo"] =$str; 
		redirect("home");
		}
	
	}
	/*
	function testGetData($_POST){
		
	if(isset($_SESSION["numApp"])){
	$numApp= $_SESSION["numApp"]-1;
	if($numApp>0){
		$cnt = 0;
	
		for($cnt=0;$cnt<$numApp;$cnt++){
			
			
		$appName = $_POST["ApplianceName".$cnt];
		
		$_POST["dateInstalled".$cnt] = $_POST["dateInstalledMonth".$cnt]."/".$_POST["dateInstalledDay".$cnt]."/".$_POST["dateInstalledYear".$cnt];
		
		echo $_POST["dateInstalled".$cnt]."<br/>";
		
		}
	}
}
	}*/
	function getTransientData(){
		//print_r($_POST);
		if(isset($_POST['submitTransient'])){
		$str=$this->Residentmodel->add_transientEntry($_POST);
		//$data['q'] = $str;
		//$this->load->view('homeView',$data);
		$_SESSION["newResidentInfo"] =$str; 
		redirect("home");
		}
	
	}
	
	function addAppliance(){
		$this->load->view('addAppliance');
	}

	function bal(){
		
		echo $this->Residentmodel->createBalanceTable($_SESSION["fNamePay"],$_SESSION["lNamePay"],$_SESSION["mNamePay"]);
	}

	function viewH(){//view payment of resident on houseman
		
		if(isset($_GET["lname"])&&isset($_GET["fname"])&&isset($_GET["mname"])){
		
		$_SESSION["lNamePay"]=$lname = $_GET["lname"] ;
		$_SESSION["fNamePay"]=$fname = $_GET["fname"] ;
		$_SESSION["mNamePay"]=$mname = $_GET["mname"] ;
		$this->load->view('viewpayment');
		}
	}
	
	function view(){
	

		if(isset($_GET["lname"])&&isset($_GET["fname"])&&isset($_GET["mname"])){
		
		//$this->Optionmodel = new OptionClass;
		$_SESSION["lNamePay"]=$lname = $_GET["lname"] ;
		$_SESSION["fNamePay"]=$fname = $_GET["fname"] ;
		$_SESSION["mNamePay"]=$mname = $_GET["mname"] ;

		$arrcol = $this->Optionmodel->returnFieldsArray("resident");
		$arrcol2 = $this->Optionmodel->returnFieldsArray("custodian");
		
		$arrcol3 = $this->Optionmodel->returnFieldsArray("scholarship");
		$arrcol4 = $this->Optionmodel->returnFieldsArray("honorsreceived");
		$arrcol5 = $this->Optionmodel->returnFieldsArray("hobbies");
		$arrcol6 = $this->Optionmodel->returnFieldsArray("othersourcesincome");
		$arrcol7 = $this->Optionmodel->returnFieldsArray("org");
		$arrcol8 = $this->Optionmodel->returnFieldsArray("violation");
		
		$str =  "";
		$str.= $this->Residentmodel->view_entry("resident",$arrcol,$fname,$lname,$mname);
		$data['table'] = $this->Residentmodel->createBalanceTable($fname,$lname,$mname);
		$data['q'] = $str;
		$data['custodian'] = $this->Residentmodel->viewCustodian($arrcol2,$fname,$lname,$mname);
		$data['other'] = $this->Residentmodel->viewOtherInfo($arrcol3,$arrcol4,$arrcol5,$arrcol6,$arrcol7,$fname,$lname,$mname);
		$data['app'] = $this->Residentmodel->viewAppliances($fname,$lname,$mname);
		$data['violation'] = $this->Residentmodel->viewViolation($arrcol8,$fname,$lname,$mname);
		$this->load->view('residentView',$data);
	
	}
}
	
	function viewT(){//view transient
	

		if(isset($_GET["lname"])&&isset($_GET["fname"])&&isset($_GET["mname"])){

		//$this->Optionmodel = new OptionClass;
		$_SESSION["lNamePay"]=$lname = $_GET["lname"] ;
		$_SESSION["fNamePay"]=$fname = $_GET["fname"] ;
		$_SESSION["mNamePay"]=$mname = $_GET["mname"] ;

		$arrcol = $this->Optionmodel->returnFieldsArray("transient");
		
		$data["transInfo"] = $this->Residentmodel->view_entryT($arrcol,$fname,$lname,$mname); ;
		
		$this->load->view('transientView',$data);
	
	}
}
	
	function delete(){
	if(isset($_GET["lname"])&&isset($_GET["fname"])&&isset($_GET["mname"])){//this is the primary key of the table resident
		$lname = $_GET["lname"] ;
		$fname = $_GET["fname"] ;
		$mname = $_GET["mname"] ;
		$this->Residentmodel->delete_resident($fname,$lname,$mname);

	}	
		
	}
	
	function deleteT(){
		if(isset($_GET["lname"])&&isset($_GET["fname"])&&isset($_GET["mname"])){//this is the primary key of the table resident
			$lname = $_GET["lname"] ;
			$fname = $_GET["fname"] ;
			$mname = $_GET["mname"] ;
			$this->Residentmodel->delete_transient($fname,$lname,$mname);
	
		}	
		
	}	
  	
	function setNumApp(){
  		
  		if(isset($_GET["numapp"])){
  			
  			$_SESSION["numApp"] = $_GET["numapp"];
  			
  		}
  	}
	
  	function getNumApp(){
  		
  		if(isset($_SESSION["numApp"])){
  			
  			return $_SESSION["numApp"];
  			
  		}
  		return 0;
  	}
  	
  	function tally(){
		$_SESSION['tally'] = 1;
		
		$data['q'] = $this->Residentmodel->tally_resident("1");
		$this->load->view('residentView',$data);
	}
  	
	function testSortCategory(){
		$this->load->library('unit_test');
		$this->unit->run($this->sortCategory("Gender"),'is_array','Resident Class test function:sort');
		//$this->unit->run($this->sort("College"),'is_array','Resident Class test function:sort');
		//$this->unit->run($this->sort("Region"),'is_array','Resident Class test function:sort');
		//$this->unit->run($this->sort("Classification"),'is_array','Resident Class test function:sort');
		
		echo $this->unit->report();
	
		
	}
	
	function sort(){
		if(isset($_GET["category"])){
			$this->sortCategory($_GET["category"]);
		}
	}
	
	function sortCategory($byWhat){
		
		$qOfWhat = "SELECT DISTINCT $byWhat FROM resident";
		$arrofDistinctWhat=$this->Residentmodel->queryThis($qOfWhat,$byWhat);
		if($arrofDistinctWhat!=""){
			//echo $byWhat;
			//print_r($arrofDistinctWhat);
			//echo "<br/>";
			
			//foreach($arrofDistinctWhat as $un){
				//$query = "SELECT FirstName,MidName,LastName FROM Resident ";
				//$query.="Where $byWhat = '$un' ORDER BY LastName";
				
				//$arrofWhat=$this->Residentmodel->queryThis($query,"ALL");
				
				//ksort($arrofWhat);
				//echo "<br/>";print_r($arrofWhat);
			
			//}	
			$data["category"] = $arrofDistinctWhat;	
		
			$data["maincategory"] = $byWhat;	
			$this->load->view('sortView',$data);
		}
	//	}
//	return 	$arrofDistinctWhat;
	}
	
	function sortContent(){
		if(isset($_GET["cat"])&&isset($_GET["sub"])){
			
			$category=$_GET["cat"];
			$subCategory=$_GET["sub"];
			
			$query = "SELECT FirstName,MidName,LastName FROM resident ";
				$query.="Where $category = \"$subCategory\" ORDER BY LastName";
				$subcat = $_GET["sub"]; 
				$arrofElement=$this->Residentmodel->queryThis($query,"ALL");
				$cnt = count($arrofElement);
				 
				 $pageNum = $cnt/10;
				 
				 $table = "<table>";
				 for($i=0;$i<$cnt;$i++){
				 	if($i==10){break;}
				 	$name= ucwords(strtolower($arrofElement[$i]));
				 	$table.="<tr><td>$name</td></tr>";	
				 	
				 }
				$table.= "</table>";
				
				echo $table;
				if($pageNum>1){
				$page ="";

				for($i=1;$i<$pageNum+1;$i++){
					if($i>1){
					$subcat = trim($subcat);
					$category = trim($category);
					$page.="<input type=\"button\" value =\"$i\" onclick=\"changeSortPage('$category','$subcat','$i')\" />&nbsp";	
					}else{
					$page.="$i&nbsp";	
						
					}
				}
				echo $page;
				}
		}
		
	}
	
	function pageSortContent(){
		if(isset($_GET["cat"])&&isset($_GET["subcat"])){
			$category=$_GET["cat"];
			$subcat = $_GET["subcat"]; 
			
			$query = "SELECT FirstName,MidName,LastName FROM resident ";
			$query.="Where $category = \"$subcat\" ORDER BY LastName";
				
			
			$arrofElement=$this->Residentmodel->queryThis($query,"ALL");
			
			$cnt = count($arrofElement);
			$page = $_GET["page"];	 
				 $pageNum = $cnt/10;
				 $current;
				 $limit = $page*10;
				 $current = $limit -10;
				
				 $table = "<table>";
				 
				 for($i=$current;$i<$cnt;$i++){
				 	if($i==$limit){break;}
				 	$name= ucwords(strtolower($arrofElement[$i]));
				 	$table.="<tr><td>$name</td></tr>";	
				 	
				 }
				$table.= "</table>";
			
				echo $table;
				if($pageNum>1){
				$page1 ="";
				for($i=1;$i<$pageNum+1;$i++){
					if($i!=$page){
					$page1.="<input type=\"button\" value =\"$i\" onclick=\"changeSortPage('$category','$subcat','$i')\" />&nbsp";	
					}else{
					$page1.="$i&nbsp";	
						
					}
				}
				echo $page1;
				}
			
		}
		
	}
	
	
	

}
?>