 <?php 
class Our_chart_model extends CI_Model 
{ 
    function __construct() 
    { 
        parent::__construct(); 
    } 
	public function get_year() 
    { 
        /* $sql = "SELECT DISTINCT(RIGHT(`loan_applieddate`,4)) as year FROM customer_loan";*/
		$sql = "SELECT DISTINCT(RIGHT(`loan_applieddate`,4)) as year, COUNT(`loan_no`) as count FROM `customer_loan` GROUP BY year";
		$query2= $this->db->query($sql);
		
		return array("count"=>$query2->result_array()); 
	} 
	
	public function get_month() 
    { 
        
		$query1= $this->db->query($sql); 
		$sql = "SELECT DISTINCT(MID(`loan_applieddate`,4,2)) as month, COUNT(`loan_no`) as count FROM `customer_loan` GROUP BY month";
		$query2= $this->db->query($sql);
		
		return array("count"=>$query2->result_array()); 
    }  
} 