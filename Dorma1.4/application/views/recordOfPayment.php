<?php 			
			 $numClus= count($arrClus);
			 $str="";
			foreach($arrClus as $a){
		 	
		 		$str.=$a."*";
		 	}
		 	$iteration= 0;
			$str = substr($str,0,strlen($str)-1);
			$fNamePay=$_SESSION["fNamePay"];
			$mNamePay=$_SESSION["mNamePay"];
			$lNamePay=$_SESSION["lNamePay"];
			
			echo "NAME :<u>". $_SESSION["fNamePay"]." ".$_SESSION["mNamePay"]." ".$_SESSION["lNamePay"]."</u><br/><br/>";
			
			echo "<center>RECORD OF PAYMENTS FOR SCHOOL YEAR $sy</center>";
			?>
		
		<center><table class="recordOfP" border="1" id="recordOfP">
				<tr>
					<!--<th rowspan="2">Term</th> -->
					<th >Paid?</th>
					<th >Period Covered</th>
					<th >OR #</th>
					<!--  <th colspan="3">Amount</th>-->
					<th >Date Paid</th>
					<th >Remarks</th>
				</tr>
			
				<?php 	$x=0;
				$tr = "";
						$this->load->database();
						$this->db->where('FirstName', $_SESSION["fNamePay"]); 
						$this->db->where('LastName', $_SESSION["lNamePay"]); 
						$this->db->where('MidName', $_SESSION["mNamePay"]); 
						$pay= $this->db->get('payment'); 
					if(count($pay->result())>0){
						$iArr =  Array('term','periodcovered', 'ornum', 'dormfee','appfee','transfee','datepaid','remarks');
						
						$cnt=0;
							
							foreach ($pay->result() as $row){
    						$cnt=0;
							
    							//$term=explode("@",$row->Term);
								$pc=explode("@",$row->PeriodCovered);
								$or=explode("@",$row->Ornum);
								//$df=explode("@",$row->DormFee);
								//$af=explode("@",$row->AppFee);
								//$tf=explode("@",$row->TransFee);
								$dp=explode("@",$row->DatePaid);
								$rem=explode("@",$row->Remarks);
								$iteration= count($pc);
								
								for($x=0;$x<$iteration;$x++){
								$tr .= "<tr>";
								$tr.="<td >OK</td>";
								
								//$tr.="<td >$term[$x]</td>";
								$tr.="<td >$pc[$x]</td>";
								$tr.="<td >$or[$x]</td>";
								//$tr.="<td >$df[$x]</td>";
								//$tr.="<td >$af[$x]</td>";
								//$tr.="<td >$tf[$x]</td>";
								$tr.="<td >$dp[$x]</td>";
								$tr.="<td >$rem[$x]</td>";
								$tr .= "<tr/>";
							
								}
							$x-=$iteration;
								
							}
							
							
					
						
				}

							if(($x+1)!=$numClus){
								$ni=$numClus+$iteration;
								for($x;$x<$numClus;$x++){
								$tr .= "<tr>";
								$tr.="<td ><input type=\"checkbox\" name=\"paid$x\" id=\"paid$x\" value=\"$arrClus[$x]\" onclick=\"submitThis('$ni','paid$x','ornum$x','datepaid$x','remarks$x')\"/></td>";
								$tr.="<td >$arrClus[$x]</td>";	
							    $tr.="<td ><input type=\"text\" name=\"ornum$x\" id=\"ornum$x\" size=\"10\"/></td>";
								$tr.="<td ><input type=\"text\" name=\"datepaid$x\" id=\"datepaid$x\" size=\"10\" /></td>";
								$tr.="<td ><input type=\"text\" name=\"remarks$x\" id=\"remarks$x\" size=\"10\" /></td>";
								$tr .= "<tr/>";
							
								}
									
								}
								echo $tr;
				
				?>
			</table>
			
			<br/>
		<input type="button" value="Refresh" onclick ="loadPayment()"/>
		<input type="button" value="Delete All" onclick="deleteAll('<?php echo $_SESSION["fNamePay"]?>','<?php echo $_SESSION["mNamePay"]?>','<?php echo$_SESSION["lNamePay"] ?>')" />
	
		</center>



