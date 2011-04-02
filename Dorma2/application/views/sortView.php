<?php 
echo "<h2 class=\"sort_category\">".ucfirst($maincategory)."</h2>";
sort($category);

foreach ($category as $subCategory){
	$subCategory = trim($subCategory);
	echo "<input type = \"button\" class=\"sorted_item\" value =\"$subCategory+\" id=\"$subCategory\" onclick=\"viewSortList('$maincategory','$subCategory')\" /><br/>";	
	echo "<div class=\"div$subCategory\" id=\"div$subCategory\" ></div><br/>";

}

?>