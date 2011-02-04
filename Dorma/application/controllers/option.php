<?php
session_start();		
class Option extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper("url");
		$this->load->library('MyClasses/OptionClass');
	
	}
	function index(){
			
	}
	
	
	function loadSuggestionBox(){
	$con = mysql_connect("localhost","DORMA","dorm");
		
		if(isset($_GET["strSearch"])){
			$opt = new OptionClass();
				
			$strSearch = $_GET["strSearch"];
	
			$length = 200;

			if (!$con){

				die('Could not connect: ' . mysql_error());
			}
		
			mysql_select_db("dormdatabase",$con);
			if(trim($strSearch)!=""){
			
				$strSearchArr = explode(" ",$strSearch);
			
				$fieldArr = $opt->returnFieldsArray("resident");
			
				$mainQuery = $opt->returnStrQuery($fieldArr,$strSearchArr,"SELECT * FROM RESIDENT WHERE");
			
				$table  = $opt->returnTable(mysql_query($mainQuery),$fieldArr,$length,$strSearchArr);
				echo $table;//for the suggest table
				$_SESSION["query"] = $mainQuery;
			
		 	}else{
				echo "";
			
			}
		}
	}
	
	
	function loadLinkTable (){
		
		if(isset($_GET["link"])&&isset($_SESSION["query"])&&trim($_SESSION["query"])!=""){
		
		$page = $_GET["link"];
		$opt = new OptionClass();
				
		$con = mysql_connect("localhost","DORMA","dorm");
	
		$length = 200;

		if (!$con){

			die('Could not connect: ' . mysql_error());
		}
		
		mysql_select_db("dormdatabase",$con);
		
		$mainQuery = $_SESSION["query"] ;
		$fieldArr = $opt->returnFieldsArray("resident");
			
		$table  = $opt->returnTableLink(mysql_query($mainQuery),$length,$page);
		
		echo $table;

	}
	}
}



?>