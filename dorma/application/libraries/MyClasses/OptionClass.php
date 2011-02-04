<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class OptionClass {
	
	function returnTotalCnt($ret){
		$tcnt = 0;	
			while(($row = mysql_fetch_array($ret))){
					$tcnt++;
					if($tcnt>90) break;	
			}
		return $tcnt;
	}
	
	function returnTableLink($ret,$len,$page){
			$tableStr = "";
			//$totalCnt = $this->returnTotalCnt($ret);
			$totalCnt=mysql_num_rows($ret);
			//if($totalCnt>0){
			$tableStr.="<table width= \"$len\" >";
			$allowed = 5;
			$inPage =$allowed*$page ;
			$start = $inPage - $allowed;
			$numOfPage =($allowed>=$totalCnt)?1:(ceil($totalCnt/$allowed));
			//$numOfPage = 2;
			$pcnt = 0;
			$cnt1 = $start;
		while(($row = mysql_fetch_array($ret))){
			$fname = $row["FirstName"];
			$lname = $row["LastName"];
			$mname = $row["MidName"];
					
			if($pcnt==$start){
				$tableStr.= "<tr length = \"$len\"><td width=\".$len.\">".$row["FirstName"]."&nbsp".$row["LastName"]."</td></tr>";
				$tableStr.="<tr ><td ><input type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \" onclick=\"loadXMLDoc('index.php?c=resident&m=view&fname=$fname&lname=$lname&mname=$mname')\" value=\"View\">
					&nbsp<input type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \" onclick=\"loadXMLDoc('edit.php?fname=$fname&lname=$lname&mname=$mname')\" value=\"Edit\">
					&nbsp<input type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \" onclick=\"deleteResident('$fname','$mname','$lname')\" value=\"Delete\">
					</td></tr>";			
				
				$cnt1++;	
				if($cnt1==$inPage){ break;}	
				}else{$pcnt++;}
			}

		
			
		$tableStr.="</table>";
	if($numOfPage>1){
			$cnt1 = 1;	
	
			
			$tableStr.="<div style=\" background: none; border: 0; color: rgb(0, 0, 0); font-size: 17px \"  >";
			while($cnt1<=($numOfPage)){
				if($cnt1!=$page){
				$tableStr.="<input  type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \"  onclick=\"changePage($cnt1)\" value=\"$cnt1\">&nbsp";
				}else{
					$tableStr.="$cnt1";
					
				}
			$cnt1++;
			}
		$tableStr.="</div>";	
		}
			//}
	return $tableStr;
		
				
		
	}
	
	function returnTable($ret, $fa,$len,$stra){//table for autcomplete
		$cnt1 = 0;
		$tableStr = "";
		$facnt = count($fa);
		$stracnt = count($stra);
		$tableStr.="<table width= \"$len\" bgcolor=\"white\">";
			while(($row = mysql_fetch_array($ret))){
							$cnt4 =0;
							$arr = "";
							
								for($cnt = 0;$cnt<$stracnt;$cnt++){
									for($cnt2 = 0;$cnt2<$facnt;$cnt2++){
										if(trim($stra[$cnt])!=""){
										if( strpos(strtolower($row[$fa[$cnt2]]),strtolower($stra[$cnt]))!==false){
											$arr[$cnt4++] =$this->shorterString($row[$fa[$cnt2]])."&nbsp";
											$cnt1++;	
										}
										
										}
										
									if($cnt1>4){break;}
									}
								if($cnt1>4){break;}}
							if($cnt4>0){
							//$ar = array_unique($arr);
							//foreach($ar as $s ){
							//	$tableStr.= "<tr length = \"$len\"><td  onclick = 'setValue(this.innerText)' onkeydown='setValue(this.innerText)' width=\".$len.\">".$s."</td></tr>";
							//}
							}
							$cnt1++;
							if($cnt1>4){break;}
			}
							$ar = array_unique($arr);
							foreach($ar as $s ){
								$tableStr.= "<tr length = \"$len\"><td  onclick = 'setValue(this.innerText)' onkeydown='setValue(this.innerText)' width=\".$len.\">".$s."</td></tr>";
							}
		$tableStr.="</table>";
	return $tableStr;
	}

	function shorterString($str){
		
		if(strlen($str)>20){
			
			return substr($str,0,20);
		}
		return $str;
	}
	function returnFieldsArray($tableName){//not refactored 
	
		$con = mysql_connect("localhost","DORMA","dorm")or die("Can't connect");
		
		mysql_select_db("dormdatabase",$con) or die("Can't select database");
		

			$qFieldNames = mysql_query("SHOW COLUMNS FROM $tableName",$con) or die("Can't find fields' name"); //get the columns from the table resident Example : FirstName, MiddleName etc 
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
				$rStr.="(".$fArray[$cnt2]." LIKE '". $sArray[$cnt]."%')";
				
				if($cnt2+1<$fCnt)$rStr.=" OR "; 
			}	
		$rStr.=")";	
		if($cnt+1<$sCnt)$rStr.=" AND "; 
		
		}
	 $rStr.=")";
	 		
	return $rStr;
	}

function viewTable($table,$arrcol,$fname,$lname,$mname){
	$query = "<table>";
	$result = mysql_query("SELECT * FROM $table	
	WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
	
	while($row = mysql_fetch_array($result))
  		{ 
 		foreach($arrcol as $q){
 			if(trim($row[$q])!=""){
 			$query.="<tr><td>".$q.": ".$row[$q]."</td></tr>"; 
 			}
 		} 
  	$query .= "<tr><td>&nbsp</td></tr>";
  	}	
		
	return $query."</table>";
	}
	
}

?>