<?php 

$wList;
$pList;
$table = "<table border =\"1\"><tr><th>Name</th><th>Student Number</th><th>Course</th><th>College</th><th>RoomNumber</th>";
foreach( $pList as $p){
	$table .="<th>".$p."</th>";
	
}
$table .="</tr>";
ksort($wList);
$fWList= array_keys($wList);
$cnt = 0;
$nlist ="";


$cnt =0;
foreach($wList as $w){
	$periodArr = explode(" ",$w);
	$table.="<tr>";
	$info = explode("/",$fWList[$cnt++]);
	$t = 0;
	foreach($info as $in){
		if($t==0){
		$table.= "<td>".str_replace("@"," ",$in)."</td>";
		}else{$table.= "<td>".$in."</td>";
		}
		$t++;
	}$bool = true;
	foreach( $pList as $pL){
			
				foreach($periodArr as $p){
						if(trim($p)!=""){
							if($pL==$p){
							$table.= "<td>X</td>";
								$bool = false;
								break;
							}
					}
				}
				if($bool){
					$table.= "<td>Ok</td>";
				}
			}
	$table.="</tr>";
}
$table.="</table>";
echo $table;
?>