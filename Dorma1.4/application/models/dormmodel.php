<?php 

class Dormmodel extends CI_Model {
	
	 function delete_resident_pay($fname,$lname,$mname){
		
		$con = mysql_connect("localhost","DORMA","dorm");
		
		mysql_select_db("dormdatabase", $con);
		mysql_query("DELETE FROM Payment WHERE FirstName= '$fname' AND LastName= '$lname' AND MidName= '$mname'")or die("Can't Delete ".mysql_error());
		
		mysql_close($con);
		
		
	}
	
	
	function paymentOpt($_GET,$appFee,$resFee,$term){
	session_start();
	$_GET["dormfee"] = $resFee;
	$_GET["appfee"] = $appFee;
	$_GET["tarnsfee"] =0 ;	
		$_GET["term"]=$term;
	$this->db->where('FirstName', $_SESSION["fNamePay"]); 
	$this->db->where('LastName', $_SESSION["lNamePay"]); 
	$this->db->where('MidName', $_SESSION["mNamePay"]); 
	$pay= $this->db->get('payment');
	
		for($i=0;$i<8;$i++){
					
						$concat[$i]="";
		}	
				
	
	//if(isset($_GET["t"])){
	
	
	//$num  = $_GET["t"];
	//if(true){
			if(isset($_SESSION["fNamePay"]) &&isset($_SESSION["mNamePay"]) &&isset($_SESSION["lNamePay"]) ){
				$iArr =  Array('term','periodcovered', 'ornum', 'dormfee','appfee','transfee','datepaid','remarks');
				 $this->load->library("MyClasses/OptionClass");
				 $opt = new OptionClass;
				 $fArr= $opt->returnFieldsArray("payment");
			if(count($pay->result())<1){
				 $data["LastName"] = $_SESSION["lNamePay"];
				 $data["MidName"] = $_SESSION["mNamePay"];
				 $data["FirstName"] = $_SESSION["fNamePay"];
				}else{
					for($i=0;$i<8;$i++){
					
					foreach($pay->result() as $r){
						$concat[$i]=$r->$fArr[$i+3]."@";
					}
				}
				}
			 for($cnt = 3,$cnt1=0; $cnt<11;$cnt++,$cnt1++){
				 
				 $data["$fArr[$cnt]"] = $concat[$cnt1]."".$_GET["$iArr[$cnt1]"];
				}
				if($data["PeriodCovered"]!=""){
				if(count($pay->result())<1){
				 
				 $this->db->insert('payment', $data); 
				}else{
					$this->db->where('LastName',$_SESSION["lNamePay"]);
					$this->db->where('FirstName',$_SESSION["fNamePay"]);
					$this->db->where('MidName',$_SESSION["mNamePay"]);
					$this->db->update('payment', $data); 
					
				} 
				}
			}
	
	//}
//}
		
	} 
	
	function getPaidPeriods($fname,$lname,$mname){
		$periodPaid ="";
		$cnt =0;
		$this->load->database();
		$this->db->select('PeriodCovered');
		$this->db->where('FirstName',$fname); 
		$this->db->where('LastName', $lname); 
		$this->db->where('MidName',$mname); 
		$this->db->from('payment');
		$pay = $this->db->get();
		$cnt=0;
		$paid = "";
		 
		foreach ($pay->result() as $row2)
		 {
				$periodPaid[$cnt++] = $row2->PeriodCovered;
		 }
		 if($periodPaid!=""){ 
		 $periodPaid = explode("@",$periodPaid[0]);
		$periodPaid  = explode("-",$periodPaid[count($periodPaid)-1]);
 		 
		 $arr =$this->getCluster("1","1","NewDorm");
		 $cnt=0;
		 foreach($arr as $a){
		 	 $period= explode("-",$a);
		 	$e=explode("/",$period[1]);
		 	$d=explode("/",$periodPaid[1]); 
		 	if($d[2]>=$e[2]){//para sa taon
				if($d[2]>$e[2]){
					$paid[$cnt++] = $a; //ilagay na agad sa kasama pag mas malaki ang taon ngayon kesa sa taon ng cluster
					}else{
						if($d[0]>=$e[0]){// para sa buwan
						 if(strcasecmp($d[0],$e[0])>0){
							$paid[$cnt++] = $a;//ilagay kung mas malaki(mas matagal?) ang buwan ngayon kesa sa buwan ng cluster
							}else{
								if($d[1]>=$e[1]){//para sa araw
									$paid[$cnt++] = $a;
							
								}
							}		
						}		
					}
				}
		 	
		 }
		 }
		 	 return $paid;
	}
	
	function getMissedPeriods($periodsPaid,$periodsArr){
		$cnt=0;
		$periodsMissed ="";
		if($periodsPaid!=""){
							//print_r($periodsPaid);
						foreach ($periodsArr as $p)
						{		
							$in = 0;
							foreach($periodsPaid as $pp){
									
								if(trim($p)==trim($pp)){
									$in = 1;
									break;
								}
							}	
							if($in==0){
							$periodsMissed[$cnt++] = $p;
							}
						}
						}else{
							
							$periodsMissed =$periodsArr; 
						}
						
		return $periodsMissed;
	}
 	
	function getPaymentPeriods($periodsArr){
					$bigArray="";
					$this->load->database();
					$this->db->select('FirstName,LastName,MidName,StudentNumber, Course, College, RoomNumber');
					$this->db->from('resident');
					$res = $this->db->get();
		foreach ($res->result() as $row)
		{	
				$cnt = 0;
				$bcnt = 0;
				$periodsPaid = "";
				$periodsMissed = "";
					
				$periodsPaid=$this->getPaidPeriods($row->FirstName,$row->LastName,$row->MidName);
    			$periodsMissed = $this->getMissedPeriods($periodsPaid,$periodsArr);
						
						
					if($periodsMissed!=""){
						$str = "";
						$str .= $row->LastName."@".$row->FirstName."@".$row->MidName."/".$row->StudentNumber."/".$row->Course."/".$row->College."/".$row->RoomNumber;
						$periodsNotPaid = "";
						foreach($periodsMissed as $p){
							$periodsNotPaid .=$p." ";
						}
						$periodsNotPaid = substr($periodsNotPaid,0,strlen($periodsNotPaid)-1);
						$bigArray[$str] = $periodsNotPaid;	
						
					}
						
	
	}

	return $bigArray ;
}
	
	
	function getCluster($term,$num,$dormName){
		
		switch($term){
			case "1": $t = 1; break;
			case "2": $t = 2; break;
			case "s": $t = 3; break;
		}
		
						$this->load->database();
						$this->db->select('Clusters,NumCluster');
						$this->db->where('Alias', $dormName); 
						$this->db->from('dorm');
						$dorm= $this->db->get(); 
		
						if(count($dorm->result())>0){
							
							foreach ($dorm->result() as $row){
								$numCluster = $row->NumCluster;
								$clusters = $row->Clusters;
							}
						}
			$arr = explode("*",$clusters);//to be recode mamaya
			return $arr;
	
	}

	function add_workload($_POST){
	$str="";
   		$arrayKeys = array_keys($_POST);
		$arrayValues = array_values($_POST);
		for($i=0;$i<count($arrayValues);$i++){
			if($arrayValues[$i]!=""){
		
			$_POST["$arrayKeys[$i]"]=strtoupper($arrayValues[$i]);
			
			}else{
				$_POST["$arrayKeys[$i]"]="";
			
			}
		}
			
		$startDate = $_POST["startMonth"]."/".$_POST["startDay"]."/".$_POST["startYear"];	
		$endDate = $_POST["compMonth"]."/".$_POST["compDay"]."/".$_POST["compYear"];	
		$nature = $_POST["workNature"];
		$status = $_POST["status"];
		$sWork = $_POST["specWork"];
		$manpower = $_POST["manpower"];
		$remarks = $_POST["remarks"];
		
		$q = "INSERT INTO workload values
			 (
			 '$nature',
			 '$sWork',
			 '$manpower',
			 '$status',
			 '$startDate',
			 '$endDate',
			 '$remarks')";
		
		$query = $this->db->query($q);
		
	}
function view_workload(){
 	$q = "SELECT * from workload order by nature";
		
	$query = $this->db->query($q);
	$result = "<table border>
				<tr><th>Nature of Work</th>
					<th>Manpower</th>
					<th>Status</th>
					<th>Start Date</th>
					<th>Completion Date</th>
					<th>Remarks</th>";
	
 	foreach($query->result() as $row){
			$result.="<tr>";
			$result.="<td>".ucwords(strtolower($row->SpecificWork))."</td>";
			$result.="<td>".ucwords(strtolower($row->Manpower))."</td>";
			$result.="<td>".ucwords(strtolower($row->Status))."</td>";
			$result.="<td>".ucwords(strtolower($row->DateStarted))."</td>";
			$result.="<td>".ucwords(strtolower($row->DateCompleted))."</td>";
			$result.="<td>".ucwords(strtolower($row->Remarks))."</td>";
			$result.="</tr>";	
	}
	
	$result.="</table>";
	
	
	
	return $result;
 }
 
 function getAccountReceivable(){
 			$this->db->select('StudentNumber,Name,College,ResidentFee, AppFee, TransFee, PeriodCovered');
			$this->db->from('previousaccountables');
			$this->db->order_by('Name');
			$res = $this->db->get();
		 $arr= $res->result();
		if(current($arr)!=""){
			$result = "<table border>
				<tr><th>Name</th>
					<th>College</th>
					<th>RF</th>
					<th>AF</th>
					<th>TF</th>
					<th>TOTAL</th>
					<th>PERIOD COVERED</th><th>&nbsp</th>";
	
 	foreach($res->result() as $row){
			$result.="<tr>";
			$result.="<td>".ucwords(strtolower($row->Name))."</td>";
			$result.="<td>".ucwords(strtolower($row->College))."</td>";
			$result.="<td>".$row->ResidentFee."</td>";
			$result.="<td>".$row-> AppFee."</td>";
			$result.="<td>".$row-> TransFee."</td>";
			$result.="<td>".($row->ResidentFee+$row-> AppFee+$row-> TransFee)."</td>";
			$result.="<td>".$row->PeriodCovered."</td>";
			$result.="</tr>";	
	}
	
	$result.="</table>";
	
		}else{
			$result = "No Records Found";
		}
 	return $result;
 }
}













?>