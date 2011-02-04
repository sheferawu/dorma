<?php
	require_once('C:/Users/lenovo/Documents/Carlo/CMSC 128/simpletest/autorun.php');
	class test1 extends UnitTestCase {
      function test_pass(){
        $x = 1;
        $y = 2;
        $total = $x + $y;
        $this->assertNotEqual(3,$total, "This should pass");
      }
    }
?>