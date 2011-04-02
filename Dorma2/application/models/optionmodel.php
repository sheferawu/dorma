<?php 
class OptionModel extends CI_Model {
	 var $db_group_name2 = "dorm";
	
	
	function returnTableLink($ret,$len,$page,$mode){
			$tableStr = "";
			//$totalCnt = $this->returnTotalCnt($ret);
			//$totalCnt=mysql_num_rows($ret);
			$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
			$totalCnt = 0;
			//if(count($ret)>1){
			$totalCnt=$ret->num_rows();
			//$totalCnt+=$tret->num_rows();
			
			//}
			//if($totalCnt>0){
			if($totalCnt ==0){return "";}
			if($mode==1){
			$tableStr.="<div id=\"resident\"><table width= \"$len\" >";
			}else{
			$tableStr.="<table width= \"$len\" >";
				
			}
			$allowed = 10;
			$inPage =$allowed*$page ;
			$start = $inPage - $allowed;
			$numOfPage =($allowed>=$totalCnt)?1:(ceil($totalCnt/$allowed));
			//$numOfPage = 2;
			$pcnt = 0;
			$cnt1 = $start;
			//print_r($ret);
			//echo "lol";
			if($totalCnt>0){	
		foreach($ret->result_array() as $row){
			$fname = ($row["FirstName"]);
			$lname = ($row["LastName"]);
			$mname = ($row["MidName"]);
					
			if($pcnt==$start){
				$tableStr.= "<tr length = \"$len\"><td width=\".$len.\">".ucwords(strtolower($row["FirstName"]))." &nbsp ".ucwords(strtolower($row["LastName"]))."</td></tr>";
				if($mode==1){
				$tableStr.="<tr ><td ><input type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \" onclick=\"loadXMLDoc('index.php?c=resident&m=view&fname=$fname&lname=$lname&mname=$mname')\" value=\"View\">
					&nbsp<input type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \" onclick=\"loadXMLDoc('index.php?c=resident&m=edit&fname=$fname&lname=$lname&mname=$mname')\" value=\"Edit\">
					&nbsp<input type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \" onclick=\"deleteResident('$fname','$mname','$lname')\" value=\"Delete\">
					</td></tr>";			
				}else{
				if($mode==4){
				$tableStr.="<tr ><td ><input type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \" onclick=\"loadXMLDoc('index.php?c=resident&m=viewH&fname=$fname&lname=$lname&mname=$mname')\" value=\"View Payment\">
					</td></tr>";			
					
				}else{
				$tableStr.="<tr ><td ><input type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \" onclick=\"loadXMLDoc('index.php?c=resident&m=viewT&fname=$fname&lname=$lname&mname=$mname')\" value=\"View\">
					&nbsp<input type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \" onclick=\"loadXMLDoc('index.php?c=resident&m=editT&fname=$fname&lname=$lname&mname=$mname')\" value=\"Edit\">
					&nbsp<input type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \" onclick=\"deleteTransient('$fname','$mname','$lname')\" value=\"Delete\">
					</td></tr>";			
				}
					
				}
				$cnt1++;	
				if($cnt1==$inPage){ break;}	
				}else{$pcnt++;}
			}
			
		
			}


			
			
		$tableStr.="</table>";
		if($totalCnt>0){	
	if($numOfPage>1){
			$cnt1 = 1;	
	
			
			$tableStr.="<div style=\" background: none; border: 0; color: rgb(0, 0, 0); font-size: 17px \"  ><table><tr>";
			while($cnt1<=($numOfPage)){
				if($cnt1!=$page){
					if($mode ==1){
					$tableStr.="<td><input  type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \"  onclick=\"changePage($cnt1)\" value=\"$cnt1\"></td>";
					}else{
						
						if($mode==4){
						$tableStr.="<td><input  type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \"  onclick=\"changePage4($cnt1)\" value=\"$cnt1\"></td>";
							
						}else{
						$tableStr.="<td><input  type=\"button\" style=\" background: none; border: 0; color: rgb(43, 182, 211); font-size: 17px \"  onclick=\"changePage2($cnt1)\" value=\"$cnt1\"></td>";
						}
					}
					if($cnt1!=0&&$cnt1%11==0){
						$tableStr.="</tr>";
						if($cnt1+1<$numOfPage){
						$tableStr.="<tr>";
							
						}
					}
					}else{
					$tableStr.="<td>$cnt1</td>";
					
				}
			$cnt1++;
			}
		$tableStr.="</table></div>";	
		}
			//}
		}
		
		
			return $tableStr;
				
		
	}
	
	function returnTable($ret, $fa,$len,$stra){//table for autcomplete
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
			
		$cnt1 = 0;
		$tableStr = "";
		$facnt = count($fa);
		$stracnt = count($stra);
		$arr = "";
			$tableStr.="<table width= \"$len\" bgcolor=\"white\" id =\"auto\" class =\"auto\" >";
			
			if($ret->num_rows()>0){
			foreach($ret->result_array()as $row){
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
							
							}
							$cnt1++;
							if($cnt1>4){break;}
			}}			
						if($arr!=""){
							$ar = array_unique($arr);
							foreach($ar as $s ){
								$tableStr.= "<tr length = \"$len\"><td  onclick = 'setValue(this.innerText)' onkeydown='setValue(this.innerText)' width=\".$len.\">".ucwords(strtolower($s))."</td></tr>";
							}
						}else{
								$tableStr.= "<tr length = \"$len\"><td  onclick = 'setValue(this.innerText)' width=\".$len.\"> No Record Found</td></tr>";
								
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
	
	function returnFieldsArray($tableName){
	
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
 
		return $qFieldNames = $this->{$this->db_group_name2}->list_fields($tableName);
			
	}

	function returnStrQuery($fArray,$sArray,$rStr){

		$fCnt = count($fArray);
		$sCnt = count($sArray);
	 	$rStr.="(";
			for($cnt = 0; $cnt<$sCnt;$cnt++){
				$rStr.="(";		
					for($cnt2 = 0; $cnt2<$fCnt;$cnt2++){
						if($fArray[$cnt2] =="FirstName"||$fArray[$cnt2] =="LastName"||$fArray[$cnt2] =="MidName"){
							$rStr.="(".$fArray[$cnt2]." LIKE '%". $sArray[$cnt]."%')";
				
					}else{
						$rStr.="(".$fArray[$cnt2]." LIKE '". $sArray[$cnt]."%')";
					}
				if($cnt2+1<$fCnt)$rStr.=" OR "; 
			}	
			$rStr.=")";	
			if($cnt+1<$sCnt)$rStr.=" AND "; 
		
			}
	 	$rStr.=")";
	 		
	return $rStr;
	}

	function viewTable($table,$arrcol,$fname,$lname,$mname){
		$this->{$this->db_group_name2} = $this->load->database($this->db_group_name2, TRUE);
 	
		$table = strtolower($table);
		$query = "<table><tr><th colspan=\"2\">$table</th></tr>";
		$result =$this->{$this->db_group_name2}->query("SELECT * FROM $table	
		WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'");
	
		foreach($result->result_array() as $row)
  			{ 
 			foreach($arrcol as $q){
 				if(trim($row[$q])!=""){
	 				if(strtoupper(trim($q))!="FIRSTNAME"&&strtoupper(trim($q))!="MIDNAME"&&strtoupper(trim($q))!="LASTNAME"){
	 					$query.="<tr><td>".$q.":</td><td> ".$row[$q]."</td></tr>";
	 				}
 				}
 			} 
  		$query .= "<tr><td>&nbsp</td></tr>";
  		}	
		
		return $query."</table>";
	}
	
}

?>