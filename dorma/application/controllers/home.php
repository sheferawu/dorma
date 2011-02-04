<?php 

class Home extends CI_Controller{
	function __construct(){
		
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper("url");
		
	}
	function index(){
		
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