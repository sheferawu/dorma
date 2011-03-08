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
			
				$mainQuery = $this->Optionmodel->returnStrQuery($fieldArr,$strSearchArr,"SELECT * FROM RESIDENT WHERE");
			
				$table  = $this->Optionmodel->returnTable($this->{$this->db_group_name2}->query($mainQuery),$fieldArr,$length,$strSearchArr);
				
				//$fieldArr2 = $this->Optionmodel->returnFieldsArray("transient");
				$fieldArr2[0]="LastName";
				$fieldArr2[1]="FirstName";
				$fieldArr2[2]="MidName";
				
				$mainQuery2 = $this->Optionmodel->returnStrQuery($fieldArr2,$strSearchArr,"SELECT * FROM TRANSIENT WHERE");
			
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