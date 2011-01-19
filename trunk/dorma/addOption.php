<?php
	$ao = new AddOption;
		
	if(isset($_GET["month"])){
		
		$month = $_GET["month"];
		$str = "";	
			$str0= "<select name=\"Day\" > <option value=\"Day\">Day</option>";
			$str1= "<select name=\"Day\" >";
 
			

			if($month=="Jan"||$month=="Mar"||$month=="May"||$month=="Jul"||$month=="Aug"||$month=="Oct"||$month=="Dec"){
				
				$str = $ao-> returnOpt(1,31);
			}
			
			if($month=="Apr"||$month=="Jun"||$month=="Sep"||$month=="Nov"){
				
				$str = $ao-> returnOpt(1,30);
			}
			if($month=="Feb"){
				
				$str = $ao-> returnOpt(1,28);
			}
	echo $str==""?$str0:$str1;		
	echo $str."</select>";
	
	}

	if(isset($_GET["y"])){
		
		$y = $_GET["y"];
		
		$str0 = $y=="1"?"<select name=\"Year\">":"<select name=\"Year\"> <option value=\"Year\">Year</option>";
		$str = $ao->returnOpt(1950,2011);
		$str1 = "</select>";
		echo $str0.$str.$str1;

		
	}
 
	
?>




<?php 

class AddOption {
	
	function returnOpt($sNum,$num){
			$dt = "";
			for($i = $sNum;$i<=$num;$i++){
						
					$dt.="<option value= \"".$i."\">".$i."</option>";
				}
				return $dt;
	}
	
}

?>