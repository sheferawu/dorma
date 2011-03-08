<?php 
session_start();
class Home extends CI_Controller{
	function __construct(){
		
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper("url");
		
	}
	function index(){
		$this->load->dbutil();
		if(!$this->dbutil->database_exists('dormdatabase')){
			redirect("c=home&m=begin");
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
		$data["dn"] = $this->Startmodel->getDormNames();	
		$this->load->view("login",$data);
			
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
	
}


?>