<?php 
session_start();
class House extends CI_Controller{
	
	function __construct(){
		
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper("url");
		$this->load->model("Startmodel");
		$this->load->helper(array('form', 'url'));
	}

	function index(){
		$_SESSION["housingMode"] = "true";	
		 $this->load->view("houseIndex");
	}
	
	function options(){
		 $data["dormArr"]= $this->Startmodel->getDormData2();
		 $this->load->view("houseView",$data);
		
		
	}
	
	function setDb(){
		if(isset($_GET["db"])){
			$_SESSION["db"] = $_GET["db"];
		}
		
	}
	
	function saveChanges(){
		
		$this->Startmodel->saveChanges($_POST);
		
	}
	
	function search(){
		 $data["select"]= $this->Startmodel->getAllAlias2();
		 if($data["select"]!=""){
		 $this->load->view("houseSearch",$data);
		 }else{
		 	redirect('');
		 }
		}
	
	function logout(){
		unset($_SESSION["housingMode"]);
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		session_destroy();
		redirect('');
	}
	
	function setNumDorm(){
		
		$_SESSION["numdorm"] = $_GET["numdorm"];
		
	}

	function upload(){
		 $_SESSION["select"]= $this->Startmodel->getAllAlias();
		$this->load->view('upload_form', array('error' => ' ' ));
	}
	
	function do_upload()
	{	
		$config['upload_path'] = './IMG/uploads';
		$config['allowed_types'] = 'png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['file_name']  =$_POST["filename"]."bit";
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
	}
	
	function loadSuggestionBox(){
		
		
	}

}
	
?>	