<?php 
    class ornaments extends CI_Model {
		//insert ornaments details
		public function insertOrnamentDetails($data) {
			if ($this->db->insert("loan", $data)) { 
					return true;
			}
			else{
				return false;
			}
		}
		
		//show ornaments details
	  	public function showOrnamentDetails($loan_no){
			$this->db->select('*');
			$this->db->from('loan');
			$this->db->where("loan_no = '".$loan_no."'");
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result_array() as $row[]){
					//return $row;
					/* return array('records' => $query->result(),
					'count' => $query->num_rows()); */
				}
				return $row;
			}else{
				return false;
			}
		}
		
		//delete ornament details
		public function deleteOrnaments($loan_no) { 
			if ($this->db->delete("loan", "loan_no = ".$loan_no)) { 
				return true; 
			} 
		}
	}
?>