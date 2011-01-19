<?php
require_once('C:/Users/lenovo/Documents/Carlo/CMSC 128/simpletest/autorun.php');

include("option.php");
class OptionClassTest extends UnitTestCase{
	
	function testReturnFieldsArray(){
		$opt = new OptionClass;
		$this->assertNotEqual(3,count($opt->returnFieldsArray()));//tama kasi ang sagot ay 27 at 27!=3
		$this->assertEqual(27,count($opt->returnFieldsArray()));//tama kasi ang sagot ay 27 at 27!=3
		
	}
	
	
function testReturnStrQuery(){
		$opt = new OptionClass;
		$strSearchArr = explode(" ","Carlo luis");
		
		$strSearchArr2 = explode(" ","Carlo");
		
		
		$fieldArr = $opt->returnFieldsArray();
		$this->assertNotNull($fieldArr);	
		$this->assertNotNull($strSearchArr);
		$this->assertNotNull($opt->returnStrQuery($fieldArr,$strSearchArr,"SELECT * FROM RESIDENT"));
		$this->assertNotNull($opt->returnStrQuery($fieldArr,$strSearchArr2,"SELECT * FROM RESIDENT"));
		
		echo $opt->returnStrQuery($fieldArr,$strSearchArr2,"SELECT * FROM RESIDENT");
	}
	
}

?>