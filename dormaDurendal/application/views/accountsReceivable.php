<?php 
$_SESSION['report_header']=array("NAME","COLLEGE","RF","TF","AF","TOTAL","PERIOD COVERED"); 
$_SESSION['report_upper'] ="Previous Accounts";
echo $table;
if($table !="No Records Found"){

echo "<br/><a class=\"genRepTxt\" href=\"index.php?c=option&m=excel&fn=accountsReceivablePastTerm\">Click here to generate report</a>";
}
?>
