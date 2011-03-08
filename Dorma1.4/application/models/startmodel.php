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
	function getDormNames(){
		
		$_SESSION["dormdatabase"] = "dormdatabase";
		
		 $this->{$this->db_group_name} = $this->load->database($this->db_group_name, TRUE);
		 $this->{$this->db_group_name}->select('Alias');
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
	function start1(){
		$_SESSION["dormdatabase"] = "dormdatabase";
		$this->load->dbutil();
		if(!$this->dbutil->database_exists('dormdatabase')){
		$this->load->dbforge();
		$this->dbforge->create_database('dormdatabase');
		
		
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
                                          )
                       );
            $this->dbforge->add_field($fields); 
			$this->dbforge->add_key('DormName', TRUE);
			$this->dbforge->create_table('dormtable',TRUE);
			
			$data = array(
               'DormName' => 'New Dorm Residence Hall' ,
               'Alias' => 'NewDorm' ,
               'Location' => 'UPLB',
				'Manager' => "Cory Mariano",
				'password' => "dorma"
            );
		
	$this->{$this->db_group_name}->insert('dormtable', $data); 
		
			$data = array(
               'DormName' => 'Mens Residence Hall' ,
               'Alias' => 'MensDorm' ,
               'Location' => 'UPLB',
			   'Manager' => "Peter Cruz",
			    'password' => "dorma"
            );
		
		$this->{$this->db_group_name}->insert('dormtable', $data); 
		
			$data = array(
               'DormName' => 'Vet Med Residence Hall' ,
               'Alias' => 'VetMed' ,
               'Location' => 'UPLB',
			   'Manager' => "Gilbert dela Cruz",
			    'password' => "dorma"
               
            );
		
		$this->{$this->db_group_name}->insert('dormtable', $data); 
			
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
		
	
		$this->{$this->db_group_name}->close();
		
		}
		
	
	
	
	
		
	}
function getDormPassword($pswd){

		$sql = "SELECT Password from dormtable WHERE Password='$pswd'";
		
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
}
	
	?>