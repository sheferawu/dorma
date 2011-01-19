<?php
	if(isset($_GET["strSearch"])){
	$opt = new OptionClass();
				
	$con = mysql_connect("localhost","DORMA","dorm");
	
	$strSearch = $_GET["strSearch"];
	
	$length = 200;

	if (!$con){

			die('Could not connect: ' . mysql_error());
		}
		
		mysql_select_db("dormdatabase",$con);
		if(trim($strSearch)!=""){
			
			$strSearchArr = explode(" ",$strSearch);
			
			$fieldArr = $opt->returnFieldsArray();
			
			$mainQuery = $opt->returnStrQuery($fieldArr,$strSearchArr,"SELECT * FROM RESIDENT WHERE");
			//$mainQuery = mysql_query("SELECT FirstName, LastName from resident where LastName LIKE '$strSearch%'");;
			
			//$returnFName = mysql_query("SELECT FirstName, LastName from resident where FirstName LIKE '$strSearch%'");;
			$table  = $opt->returnTable(mysql_query($mainQuery),'FirstName','LastName',$length);
				//returnTD($returnFName,'FirstName','LastName');
			echo $table;

			
		 }else{
			echo "";
			
		}
	}
	

?>

<?php

class OptionClass {
	
	function returnTable($ret, $f1,$f2,$len){//table for autcomplete
		$cnt = 0;
		$tableStr = "";
		$tableStr.="<table width= \"$len\" bgcolor=\"gray\">";
			while(($row = mysql_fetch_array($ret))){
							$tableStr.= "<tr length = \"$len\">";
								$str = $row[$f1]." ".$row[$f2];
								$tableStr.= "<td  onclick = 'setValue(this.innerText)' onkeydown='setValue(this.innerText)' width=\".$len.\">".$str."</td>";
							$tableStr.= "</tr>";
							$cnt++;
							if($cnt>4){break;}
			}
		$tableStr.="</table>";
	return $tableStr;
	}


	function returnFieldsArray(){//not refactored yet
	
		$con = mysql_connect("localhost","DORMA","dorm")or die("Can't connect");
		
		mysql_select_db("dormdatabase",$con) or die("Can't select database");
		

			$qFieldNames = mysql_query("SHOW COLUMNS FROM resident",$con) or die("Can't find fields' name"); //get the columns from the table resident Example : FirstName, MiddleName etc 
			$numFields = mysql_num_rows($qFieldNames); 
			$cnt = 0; 
				while ($cnt < $numFields){ 
    					$fieldName = mysql_fetch_row($qFieldNames); 
    					$fields[$cnt++] = $fieldName[0]; 
    	
					} 
		
		return $fields;
	}

	function returnStrQuery($fArray,$sArray,$rStr){

	$fCnt = count($fArray);
	$sCnt = count($sArray);
	 $rStr.="(";
		for($cnt = 0; $cnt<$sCnt;$cnt++){
		$rStr.="(";		
			for($cnt2 = 0; $cnt2<$fCnt;$cnt2++){
			
				$rStr.="(".$fArray[$cnt2]." LIKE '%". $sArray[$cnt]."%')";
				if($cnt2+1<$fCnt)$rStr.=" OR "; 
			}	
		$rStr.=")";	
		if($cnt+1<$sCnt)$rStr.=" AND "; 
		
		}
	 $rStr.=")";
	 		
	return $rStr;
	}	
}
?>
