<?php

class Unittest extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('MyClasses/OptionClass');
		$this->load->library('unit_test');
	}
	
	function index(){
		
		
	}
function testReturnFieldsArray(){
		$opt = new OptionClass;
		$this->unit->run(count($opt->returnFieldsArray("resident")),'is_numeric','Option Class test function: returnFieldsArray');//tama kasi ang sagot ay 27 at 27!=3
		$this->unit->run(count($opt->returnFieldsArray("resident")),26,'Option Class test 2 function: returnFieldsArray');//tama kasi ang sagot ay 27 at 27!=3
		echo $this->unit->report();
	}
	
function testReturnStrQuery(){
		$opt = new OptionClass;
		$strSearchArr = explode(" ","Paula Bianca");
		
		$strSearchArr2 = explode(" ","Paula");
		
		
		$fieldArr = $opt->returnFieldsArray("resident");
		$this->unit->run($fieldArr,'is_array',"Test str query 1");	
		$this->unit->run($strSearchArr,'is_array',"Test str query 2");
		$this->unit->run($opt->returnStrQuery($fieldArr,$strSearchArr,"SELECT * FROM RESIDENT"),'is_string',"Test str query 3");
		$this->unit->run($opt->returnStrQuery($fieldArr,$strSearchArr2,"SELECT * FROM RESIDENT"),'is_string',"Test str query 4");
		echo $this->unit->report();
	//	echo $opt->returnStrQuery($fieldArr,$strSearchArr2,"SELECT * FROM RESIDENT");
	}
}


?>