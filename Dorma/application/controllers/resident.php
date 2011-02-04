<?php
session_start();
class Resident extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper("url");
		$this->load->library('MyClasses/OptionClass');
		$this->load->model('Residentmodel');
		
	}
	function index(){
				
	
	}
	
	function add(){
		$this->load->view('addResident');
	}
	function getData(){
		if(isset($_POST['submitResident'])){
		$str=$this->Residentmodel->add_entry($_POST);
		//$data['q'] = $str;
		//$this->load->view('homeView',$data);
		$_SESSION["newResidentInfo"] =$str; 
		redirect("home");
		}
	
	}
	
	function addAppliance(){
		$this->load->view('addAppliance');
	}	
	function view(){
	

		if(isset($_GET["lname"])&&isset($_GET["fname"])&&isset($_GET["mname"])){

		$opt = new OptionClass;
		$lname = $_GET["lname"] ;
		$fname = $_GET["fname"] ;
		$mname = $_GET["mname"] ;

		$arrcol = $opt->returnFieldsArray("resident");
		$str =  "RESIDENT INFO: <br/>";
		$str.= $this->Residentmodel->view_entry("resident",$arrcol,$fname,$lname,$mname);
		
		$data['q'] = $str;
		$this->load->view('residentView',$data);
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
	
	
}

?>