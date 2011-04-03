<?php 
class Startmodel extends CI_Model {
		 var $db_group_name = "default";
	function __construct()
    {
        parent::__construct();
 
        $this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
 
    }
 	
    function get_database_group() {
        return $this->db_group_name;
    }
    
    function getDormData($dorm,$data){
    	$this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
 		$this->{$this->db_group_name}->select($data);
 		$this->{$this->db_group_name}->where('Alias',$dorm); 
		$this->{$this->db_group_name}->from('dormtable');
		$info = $this->{$this->db_group_name}->get();
   		 foreach ($info->result() as $row)
				{
						
					return $row->$data;
				}
	    
    }
    function setDatabaseReady($dormname){
    	$sql = "UPDATE dormtable set DatabaseReady='1' where Alias='$dormname'";
    $this->{$this->db_group_name}->query($sql);
    }
	function getDatabaseReady($dormname){
    	$sql = "Select DatabaseReady from dormtable where Alias='$dormname'";
     $query =$this->{$this->db_group_name}->query($sql);
		foreach($query->result as $row){
			return $row->DatabaseReady; 
		}    
    }
 	function getHousingData($data){
    	$this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
 		$this->{$this->db_group_name}->select($data);
 		$this->{$this->db_group_name}->from('housingtable');
		$info = $this->{$this->db_group_name}->get();
   		 foreach ($info->result() as $row)
				{
						
					return $row->$data;
				}
	    
    }
	
    function getDormAlias(){
		$_SESSION["dormdatabase"] = "dorma";
		$this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
		 $this->{$this->db_group_name}->select('Alias');
		 $this->{$this->db_group_name}->order_by("Alias", "asc"); 
	 	$this->{$this->db_group_name}->from('dormtable');
		$dorma =  $this->{$this->db_group_name}->get();
		$dn = "";
		$cnt = 0;
		foreach ($dorma->result() as $row)
		 {
				$dn[$cnt++] = $row->Alias;
		 }
	 $this->{$this->db_group_name}->close();
	
		return $dn;
	}
	
	function getDormName(){
		$_SESSION["dormdatabase"] = "dorma";
		$this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
		 $this->{$this->db_group_name}->select('DormName');
		 $this->{$this->db_group_name}->order_by("Alias", "asc");
	 	$this->{$this->db_group_name}->from('dormtable');
		$dorma =  $this->{$this->db_group_name}->get();
		$dn = "";
		$cnt = 0;
		foreach ($dorma->result() as $row)
		 {
				$dn[$cnt++] = $row->DormName;
		 }
	 $this->{$this->db_group_name}->close();
	
		return $dn;
	}
	
	function start1(){
		$_SESSION["dormdatabase"] = "dorma";
		$this->load->dbutil();
		if($this->dbutil->database_exists('dorma')){
		$this->load->dbforge();
		//$this->dbforge->create_database('dorma');
		
		
		 $this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
		
			$fields = array(
                        'DormName' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '120'
                                          ),
                         
                        'Alias' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '50',
                                          		  'null' => TRUE
                                          ),
                        'Location' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '260',
                                          		  'null' => TRUE
                                          ),
                                          
                         'Manager' => array(
                                           		 'type' => 'VARCHAR',
                                                 'constraint' => '100',
                                          		 'null' => TRUE
                                          ),
                         
                		'password' => array(
                                           		 'type' => 'VARCHAR',
                                                 'constraint' => '100',
                                          		 'null' => TRUE
                                          ),
                                          
                          
                		'info' => array(
                                           		 'type' => 'VARCHAR',
                                                 'constraint' => '500',
                                          		 'null' => TRUE
                                          ),
                          
                       
                		'DatabaseReady' => array(
                                           		 'type' => 'INT',
                                                 'constraint' => '1',
                                          		  'default' => '0'
                                          )
                          
                                          
                         );
		if(! $this->{$this->db_group_name}->table_exists("dormtable")){
            $this->dbforge->add_field($fields); 
			$this->dbforge->add_key('DormName', TRUE);
			$this->dbforge->create_table('dormtable',TRUE);
		
		$sql = "INSERT INTO `dormtable` (`DormName`, `Alias`, `Location`, `Manager`, `password`, `info`) VALUES
('Mens Residence Hall', 'MensDorm', 'UPLB', 'Peter Cruz', 'dorma', 'Dorm for Freshmen'),
('Vet Med Residence Hall', 'VetMed', 'UPLB', 'Gilbert dela Cruz', 'dorma', 'Dorm for old people'),
('Womens Residence Hall', 'Womens', 'UPLB', 'Patricia Javier', 'dorma', 'Dorm for women'),
('ACCI Residence Hall', 'Acci', 'UPLB', 'Kuya Boy', 'dorma', 'Dorm for me and you'),
('New Dorm Residence Hall', 'NewDorm', 'UPLB', 'Cory Mariano', 'dorma', 'the best dorm');";
		$this->{$this->db_group_name}->query($sql); 
		}
		if(! $this->{$this->db_group_name}->table_exists("housingtable")){
            
		$fields = array(
                        'HousingChief' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '60'
                                          ),
                         
                        'HousingHead' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '60'
                                          )
                       );
                       
            $this->dbforge->add_field($fields); 
			$this->dbforge->create_table('housingtable',TRUE);
			$data = array(
               'HousingChief' => 'MARGARET M. CALDERON' ,
               'HousingHead' => 'ROWENA C. CARDENAS' 
               
               
            );
            $this->{$this->db_group_name}->insert('housingtable', $data); 
		}
		if(! $this->{$this->db_group_name}->table_exists("housingstaff")){
	$fields = array(
                        'UserName' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '60'
                                          ),
                         
                        'Password' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '60'
                                          )
                       );
            $this->dbforge->add_field($fields); 
			$this->dbforge->create_table('housingstaff',TRUE);
			$data = array(
               'UserName' => 'HOUSEMAN' ,
               'Password' => 'houseman' 
               
               
            );
            $this->{$this->db_group_name}->insert('housingstaff', $data); 
		}
	
		$this->{$this->db_group_name}->close();
		
		}
		
	
	
	$_SESSION["housingOk"] = true;
	
		
	}
	
	function saveDormPassword($pswd){
	$user = ucwords(strtolower($_SESSION['username']));	
	$sql = "UPDATE dormtable
	SET password = '$pswd'
	WHERE Manager = '$user';";

		$this->{$this->db_group_name}->query($sql);
	
}
	
	function getDormPassword($pswd){
		
		$user = ucwords(strtolower($_SESSION['username']));	
		$sql = "SELECT Password from dormtable WHERE Password='$pswd' AND Manager = '$user'";
		
		$query = $this->{$this->db_group_name}->query($sql);
		$this->{$this->db_group_name}->close();
		foreach($query->result() as $row){
			if ($row->Password == $pswd)
				return 1;
			else
				return  0;
		}
			return  0;
	}
	
	function getHousingPassword($userName,$pswd){

		$sql = "SELECT Password from housingstaff WHERE Password='$pswd' And UserName = '$userName'";
		
		$query = $this->{$this->db_group_name}->query($sql);
		$this->{$this->db_group_name}->close();
		foreach($query->result() as $row){
			if ($row->Password == $pswd)
				return 1;
			else
				return  0;
		}
			return  0;
	}	
	
	function getDormManager($uname,$dname){
	
		$uname = strtolower($uname);
		
		$sql = "SELECT Manager from dormtable WHERE Manager='$uname' and Alias = '$dname'";
		
		$query = $this->{$this->db_group_name}->query($sql);
		$this->{$this->db_group_name}->close();
			
		foreach($query->result() as $row){
			if (strtolower($row->Manager) == $uname)
			return 1;
			else
				return  0;
		}
			return  0;
	}
	
	function getHousingStaff($uname){
	
		$uname = strtolower($uname);
		
		$sql = "SELECT username from housingstaff WHERE Username='$uname'";
		
		$query = $this->{$this->db_group_name}->query($sql);
		$this->{$this->db_group_name}->close();
			
		foreach($query->result() as $row){
			if (strtolower($row->username) == $uname)
			return 1;
			else
				return  0;
		}
			return  0;
	}

	function getDormData2(){
		$this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
 		
		$sql = "SELECT * from dormtable ";
		
		$query = $this->{$this->db_group_name}->query($sql);
		$this->{$this->db_group_name}->close();
		$arr = "";	
		$cnt =0;
		foreach($query->result() as $row){
			$arr[$cnt++] = $row->DormName."@".$row->Alias."@".$row->Location."@".$row->Manager."@".$row->password."@".$row->info;
	
		}
	
		return $arr;
	}
	
	function saveChanges($_POST){
		$fields= array ("DormName","Alias","Location","Manager","Password","Info");
	
		$this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);

		$this->{$this->db_group_name}->query("Delete from dormtable");

		$arrayKeys = array_keys($_POST);
		$arrayValues = array_values($_POST);
		for($i=0;$i<count($arrayValues);$i++){
			if($arrayValues[$i]!=""){
			$val =$arrayValues[$i];
			$val = str_replace("'","",$val);
			$val = str_replace("\"","",$val);
			$_POST["$arrayKeys[$i]"]=$val;
			
			}else{
				$_POST["$arrayKeys[$i]"]="";
			
			}
		}	

		$numdorm = $_SESSION["numdorm"];

			for($i = 0;$i<$numdorm;$i++){
			
			
			if(isset($_POST[$fields[0]."".$i])){
			
			if(trim($_POST[$fields[0]."".$i])!=""
			&&trim($_POST[$fields[1]."".$i])!=""
			&&trim($_POST[$fields[2]."".$i])!=""
			&&trim($_POST[$fields[3]."".$i])!=""
			&&trim($_POST[$fields[4]."".$i])!=""
			&&trim($_POST[$fields[5]."".$i])!=""){	
					
					$sql = "Insert into dormtable values(
						'".$_POST[$fields[0]."".$i]."',
						'".$_POST[$fields[1]."".$i]."',
						'".$_POST[$fields[2]."".$i]."',
						'".$_POST[$fields[3]."".$i]."',
						'".$_POST[$fields[4]."".$i]."',
						'".$_POST[$fields[5]."".$i]."'
						)";
			
				$this->{$this->db_group_name}->query($sql);
					
		}
	}
	
}
				//drop
				if(isset($_POST["check"])){	
					$selected = $_POST["check"];
					$num = count($selected);
					if($num>0){
						$this->load->dbutil();
						
						foreach($selected as $opt){
							$alias = str_replace("database","",$opt);
							if($this->dbutil->database_exists($opt)){
								$this->load->dbforge();
								$this->dbforge->drop_database($opt);
								
							}
							$this->{$this->db_group_name}->query("Delete from dormtable where alias ='$alias'");
						}
					}
					}
				redirect('');

}
	
	function setInfoTable($dorm){
		$this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
 		$sql = "Select Location,info from dormtable where DormName = '$dorm'"; 
		$query = $this->{$this->db_group_name}->query($sql);
		$this->{$this->db_group_name}->close();
	
		foreach($query->result() as $row){
			echo "Location: ".$row->Location."<br/>";
			echo "<p>$row->info</p>";	
			
		}
		
	}
	
	function getAllAlias(){
		$this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
 		$sql = "Select Alias from dormtable" ; 
		$query = $this->{$this->db_group_name}->query($sql);
		$this->{$this->db_group_name}->close();
		$select = "<select name=\"filename\">";
		foreach($query->result() as $row){
				$select.="<option value=\"$row->Alias\">$row->Alias</option>";
			
		}
		$select.="</select>";
		return $select;
	}
	
	function getAllAlias2(){
			$this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
	 		$sql = "Select Alias from dormtable" ; 
			$query = $this->{$this->db_group_name}->query($sql);
			$this->{$this->db_group_name}->close();
			$select = "<select name=\"filename\" onchange=\"setDormSelect(this.options[this.selectedIndex].value)\"> ";
			$select.="<option value=\"0\">Select Below</option>";
			$bool = false;	
			$this->load->dbutil();
			$first = false;
			foreach($query->result() as $row){
				$temp = strtolower($row->Alias);
				$temp = $temp."db";	
			if($this->dbutil->database_exists($temp)){
				if($first==false){
				$_SESSION["db"] = $temp;
				$first = true;
				}
				$bool = true;
				$select.="<option value=\"$temp\">$row->Alias</option>";
			}	
			}
				$select.="</select>";
			if($bool){
				return $select;
			}
				return "";
			}
}
	
	?>