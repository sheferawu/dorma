<?php
session_start();		
class Option extends CI_Controller{
 var $db_group_name2 = "dorm";
	function __construct(){
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper("url");
		//$this->load->library('MyClasses/OptionClass');
		$this->load->model("Optionmodel");
		
		
	}
	
	function index(){
			
	}
	function changeAppClus(){
		if(isset($_GET["appname"])){
			$data["appName"] = $_GET["appname"];
			$this->load->model("Dormmodel");
			$data["clusters"] = $this->Dormmodel->getDormData("Clusters");
			$data["clusters"] = explode("*",$data["clusters"]);
			$arrayOfClus = $this->Dormmodel->getAppPay($_GET["appname"]);
			unset($_GET["appname"]);
			if(trim($arrayOfClus)!=""){
			$data["arrayOfClus"] = explode("*",$arrayOfClus);	
			}		
			$this->load->view("appClus",$data);
				
		}else{
			
			if(isset($_POST["appClusSubmit"])&&isset($_SESSION["appNameClus"])){
				$this->load->model("Dormmodel");
				$this->Dormmodel->getChangeAppClus($_POST,$_SESSION["numClus"]);
				
				
				$_SESSION["Settings"] = "Appliance Data Changed";
				unset($_SESSION["appNameClus"]);
				unset($_SESSION["numClus"]);
				redirect('');
				
			}
		}
		
	}
	
	function savePassWord(){
		$this->load->model("Startmodel");
		
		$pswd = $_GET["password"];
		 $this->Startmodel->saveDormPassword($pswd);
		echo "Password Changed";
	
	
	}
	
	function checkPassWord(){
		$this->load->model("Startmodel");
		
		$pswd = $_GET["password"];
		$bool= $this->Startmodel->getDormPassword($pswd);
		if($bool ==1){
			echo "Password Correct";
			
		}else{
				echo "Invalid Password";
			
		
		}	
	
	}
	
	function testmakeCluster(){
		
		$_GET["start"] = "11/03/2010";
		
		$_GET["end"] = "04/01/2011";
		$this->makeCluster();
	}
	
	function makeCluster(){
		if(isset($_GET["start"])&&isset($_GET["end"])){
			if($_GET["start"]!="1//"&&$_GET["end"]!="1//"){
			$start = new DateTime($_GET["start"]);
			$end = new DateTime($_GET["end"]);
			$pay = $_GET["pay"];
			$temp = $start;
			$cnt = 0;
			$here = 0;
			for($temp = $start;$temp<=$end;$temp->add(new DateInterval('P30D'))){
				if($temp==$start&&$here==0){
					$here = 1;
					echo "<table><tr><th>Period</th><th>Payment</th></tr>";
				}
				$str = $temp->format("m/d/Y");
				$temp->add(new DateInterval('P30D'));
				$temp->sub(new DateInterval('P1D'));
				$str2 = $temp->format("m/d/Y");
				echo "<tr><td><input type=\"text\" value=\"$str-$str2\" name=\"cluster$cnt\"/></td>";
				echo "<td><input type=\"text\" value=\"$pay\" name=\"paycluster$cnt\"/></td></tr>";
				
				$temp->sub(new DateInterval('P30D'));
				$temp->add(new DateInterval('P1D'));
				$cnt++;
			}
			if($here==1){echo "</table>";}
		$_SESSION["clusterCnt"] = $cnt;
			}
		}
		
		
	}
	
	function excel(){
		ob_start();
		$this->load->library('ExportExcel');
		$fn=$_GET['fn'].".xls";
		$excel_obj=new ExportExcel();
		$excel_obj->fname("$fn");
		$excel_obj->setHeadersAndValues($_SESSION['report_header'],$_SESSION['report_values']); 
		$excel_obj->setUpper($_SESSION['report_upper']); 
		if(isset($_SESSION['apt'])){
		$excel_obj->setAppTable($_SESSION['apt']);	
		}
		$excel_obj->GenerateExcelFile();
	
	}
	
	function accomplishToExcel(){
		ob_start();
		$this->load->library('ExportExcel');
		$fn=$_GET['fn'].".xls";
		$excel_obj=new ExportExcel();
		$excel_obj->fname("$fn");
		$str=$_SESSION["main_header"];
		for($i=1;$i<=5;$i++){
		if(isset($_SESSION["report_header"][$i])){
			$str.= $_SESSION["report_header"][$i]."\n";
		}
		if(isset($_SESSION["report_value"][$i])){
				$str.= $_SESSION["report_value"][$i]."\n";
	
		}
		}
		$excel_obj->setStr($str);
		$excel_obj->GenerateExcelFileAccomp();
		
	}
	
	function loadSuggestionBox(){
	//$con = mysql_connect("localhost","DORMA","dorm");
	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
 
		if(isset($_GET["strSearch"])){
			//$this->Optionmodel = new OptionClass();
				
			$strSearch = $_GET["strSearch"];
	
			$length = 200;

			/*if (!$con){

				die('Could not connect: ' . mysql_error());
			}*/
		
			//mysql_select_db("dormdatabase",$con);
			if(trim($strSearch)!=""){
			
				$strSearchArr = explode(" ",$strSearch);
			
				$fieldArr = $this->Optionmodel->returnFieldsArray("resident");
			
				$mainQuery = $this->Optionmodel->returnStrQuery($fieldArr,$strSearchArr,"SELECT * FROM resident WHERE");
			
				$table  = $this->Optionmodel->returnTable($this->{$this->db_group_name2}->query($mainQuery),$fieldArr,$length,$strSearchArr);
				
				//$fieldArr2 = $this->Optionmodel->returnFieldsArray("transient");
				$fieldArr2[0]="LastName";
				$fieldArr2[1]="FirstName";
				$fieldArr2[2]="MidName";
				
				$mainQuery2 = $this->Optionmodel->returnStrQuery($fieldArr2,$strSearchArr,"SELECT * FROM transient WHERE");
			
				$table2  = $this->Optionmodel->returnTable($this->{$this->db_group_name2}->query($mainQuery2),$fieldArr2,$length,$strSearchArr);
				
				
				if(strlen(stristr($table,"No Record Found"))==0){
				echo $table;//for the suggest table
				}
				
				if(strlen(stristr($table,"No Record Found"))!=0&&strlen(stristr($table2,"No Record Found"))!=0){
					echo $table;
				}
				$_SESSION["query"] = $mainQuery;
				$_SESSION["query2"] = $mainQuery2;
								
		 	}else{
				echo "";
			
			}
		}
	}
	
	function loadLinkTable (){
		
		if(isset($_GET["link"])&&isset($_SESSION["query"])&&trim($_SESSION["query"])!=""){
		
		$page = $_GET["link"];
	//	$this->Optionmodel = new OptionClass();
				
		//$con = mysql_connect("localhost","DORMA","dorm");
	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
		$length = 200;

		//if (!$con){

			//die('Could not connect: ' . mysql_error());
		//}
		
		//mysql_select_db("dormdatabase",$con);
		
		$mainQuery = $_SESSION["query"] ;
		$fieldArr = $this->Optionmodel->returnFieldsArray("resident");
	
			
		$table  = $this->Optionmodel->returnTableLink($this->{$this->db_group_name2}->query($mainQuery),$length,$page,1);
		if(trim($table)!=""){
		echo "<hr/>Resident<br/>";
		echo $table;
		}		
	}
	}
	
	function loadLinkTableHouse (){
		
		if(isset($_GET["link"])&&isset($_SESSION["query"])&&trim($_SESSION["query"])!=""){
		
		$page = $_GET["link"];
	//	$this->Optionmodel = new OptionClass();
				
		//$con = mysql_connect("localhost","DORMA","dorm");
	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
		$length = 200;

		//if (!$con){

			//die('Could not connect: ' . mysql_error());
		//}
		
		//mysql_select_db("dormdatabase",$con);
		
		$mainQuery = $_SESSION["query"] ;
		$fieldArr = $this->Optionmodel->returnFieldsArray("resident");
	
			
		$table = $this->Optionmodel->returnTableLink($this->{$this->db_group_name2}->query($mainQuery),$length,$page,4);
		if(trim($table)!=""){
		
		echo $table;
		}		
	}
	}
	
	function loadLinkTable2(){
		
		if(isset($_GET["link2"])&&isset($_SESSION["query2"])&&trim($_SESSION["query2"])!=""){
		
		$page = $_GET["link2"];
	
	$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
		$length = 200;

	
		$mainQuery = $_SESSION["query2"] ;
	
			
		$table  = $this->Optionmodel->returnTableLink($this->{$this->db_group_name2}->query($mainQuery),$length,$page,2);
		if(trim($table)!=""){
		echo "<hr/><br/>Transient<br/>";
		echo $table;
		
		echo "<hr />";
	
		}
		}
	}
}



?>