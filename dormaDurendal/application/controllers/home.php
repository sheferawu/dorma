<?php 
session_start();
class Home extends CI_Controller{
	
	function __construct(){
		
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper("url");
		
	}
	
	function index(){
		
		if(isset($_SESSION["housingMode"])){
			redirect('house');
		}
		$this->load->dbutil();
		if($this->dbutil->database_exists('dorma')){
			if(!isset($_SESSION["housingOk"])){
			redirect("c=home&m=begin");}
		}
		if(isset($_SESSION['username'])){
			$this->load->model('Dormmodel');
			if($this->Dormmodel->checkSettings()<=0){
				$_SESSION["setSettings"] = "Please fill up the settings form!"; 
			}else{
				if(isset($_SESSION["setSettings"])){
					unset($_SESSION["setSettings"]);
				}	
				
			}
			
					$this->load->view("homeView");
		
			
		}else{
		
		$this->load->model("Startmodel");
		$data["alias"] = $this->Startmodel->getDormAlias();	
		$data["dormName"] = $this->Startmodel->getDormName();
		$this->load->view("login",$data);
			
		}
	
	}
	
	function setInfoTable(){
		
		if(isset($_GET["dorm"])){
		$this->load->model("Startmodel");
		$this->Startmodel->setInfoTable($_GET["dorm"]);
		
		}
	}
	
	function begin(){
		$this->load->model("Startmodel");
		
		$this->Startmodel->start1();
		redirect(''); 
	}
	
	function home(){
		$this->load->view("homeView");
	}
	
	function loadCss(){
		echo "<style>";
		$this->load->view("CSS/style.css");
		echo "</style>";
	}
	
	function loadJs(){
		echo"<script type=\"text/javascript\">";
		$this->load->view("JS/addJS.js");
		echo "</script>";
		echo"<script type=\"text/javascript\">";
	    $this->load->view("JS/searchJS.js");
		echo "</script>";
		
	}
	
	function loadImg($str,$prop){
		echo"<img $prop src=\"";
		$this->read->view("IMG/$str".".png");
		echo"\" />";
		
	}
	function nodatabase(){
		
		if(isset($_GET["dname"])){
			echo "Selected Dorm has no database!<br/>Please go to Mr. Jac Hermocilla in ICS so that he can make a database for your dorm<br/>Database name should be:".$_GET["dname"]."Thank you..<br/><a href=\"index.php?c=home&m=logout\">Go Home</a>";
			
		}
		
	}

	function logout(){

			unset($_SESSION['username']);
		unset($_SESSION['password']);
		
		session_destroy();
		redirect('');
	
	}
function aboutUs(){
	$this->load->view("aboutUs");
}
	
}


?>