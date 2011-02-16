<?php 
echo "<h2 class=\"sort_category\">".ucfirst($maincategory)."</h2>";
foreach ($category as $subCategory){
	echo "<input type = \"button\" class=\"sorted_item\" value =\"$subCategory+\" id=\"$subCategory\" onclick=\"viewSortList('$maincategory','$subCategory')\" /><br/>";	
	echo "<div class=\"div$subCategory\" id=\"div$subCategory\" ></div><br/>";

}

?>