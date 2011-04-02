 <?php

#### Roshan's very simple code to export data to excel   
#### Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
#### if you find any problem contact me at http://roshanbh.com.np
#### fell free to visit my blog http://php-ajax-guru.blogspot.com

class ExportExcel
{	
	//variable of the class
	var $titles=array();
	var $all_values=array();
	var $filename;
	var $upper_values = "";
	var $apptable_values = "";
	var $str = "";
	//functions of the class
	function fname($f_name) //constructor
	{
		$this->filename=$f_name;
	}
	
	function setHeadersAndValues($hdrs,$all_vals) //set headers and query
	{
		$this->titles=$hdrs;
		$this->all_values=$all_vals;
		
	}
	//added function for dorma
	function setUpper($upper){
		$this->upper_values=$upper;
		
	}
	function setStr($temp){
			$this->str=$temp;
		
		
	}
	function setAppTable($at){
			$temp = "";
			$temp.="\t\tAPPLIANCES\n"	;
			foreach($at as $a){
				$temp.="\t\t$a[0]\t$a[1]\n";
				
			}
			$this->apptable_values = $temp;			
	}
	function GenerateExcelFile() //function to generate excel file
	{	$header ="";
		$data ="";
		
		foreach ($this->titles as $title_val) 
 		{ 	
 			$header.= $title_val."\t"; 
 		} 
 		for($i=0;$i<sizeof($this->all_values);$i++) 
 		{ 
 			$line = ''; 
 			foreach($this->all_values[$i] as $value) 
			{ 
 				if ((!isset($value)) OR ($value == "")) 
				{ 
 					$value = "\t"; 
 				} //end of if
				else 
				{ 
 					$value = str_replace('"', '""', $value); 
 					$value = '"' . $value . '"' . "\t"; 
 				} //end of else
 				$line .= $value; 
 			} //end of foreach
 			$data .= trim($line)."\n"; 
 		}//end of the while 
 		$data = str_replace("\r", "", $data); 
		if ($data == "") 
 		{ 
 			$data = "\n(0) Records Found!\n"; 
 		} 
		//echo $data;
		header("Content-type: application/vnd.ms-excel"); 
		header("Content-Disposition: attachment; filename=$this->filename"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		//additional code for dorma
		if($this->upper_values!=""){
			$this->upper_values = str_replace("<br/>","\n",$this->upper_values);
			$this->upper_values = str_replace("<center>","",$this->upper_values);
			$this->upper_values = str_replace("</center>","",$this->upper_values);
					
		
		}
		//$this->titles
		
		
		print "\t$this->upper_values\n$header\n$data\n\n$this->apptable_values";  
	
	
	}

	function GenerateExcelFileAccomp() //function to generate excel file
	{	
		//echo $data;
		header("Content-type: application/vnd.ms-excel"); 
		header("Content-Disposition: attachment; filename=$this->filename"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		//additional code for dorma
		if($this->str!=""){
			print "$this->str";  
	
		}
		//$this->titles
		
		
	
	
	}
	

}
?>