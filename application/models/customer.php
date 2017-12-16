<?php
	class Customer extends CI_Model {
	
		public function insert($data){
			if ($this->db->insert("customer", $data)) { 
				return true; 
			} 
		}
		
		//for selecting a customer using select2
		public function showCustomersName(){
			if(!empty($this->input->get("q"))){
				$this->db->like('cust_name ', $this->input->get("q"));
				$this->db->select('cust_no as id');
				$this->db->select('cust_name as text');
				$query = $this->db->get('customer');
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return false;
				}
			}
		}
		//delete a particular customer
		public function deleteCust($cust_no) { 
			if ($this->db->delete("customer", "cust_no = '".$cust_no."'")) { 
				return true; 
			} 
		}
		
		//get details of a particular customer
		public function showCustomer($cust_no) {
			$sql= "SELECT * FROM customer WHERE cust_no = '".$cust_no."'";
			$query=$this->db->query($sql);
			return $query->result();
			//echo json_encode($query->result());
		}
		
		//update the details of a particular customer
		public function updateCustomer($cust_no,$update){
				$this->db->where('cust_no',$cust_no);
				$this->db->update('customer', $update);
		}
		
		//get the count of customer == display on dashboard
		public function custCount() {
			
			$this->db->select('*');
			$this->db->from('customer');
						
			$query = $this->db->get();
			$count = $query->num_rows();
			if ($count > 0) {
				return $count;
			} else {
				return 0;
			}
		}
			
		public function showCustomerLoans($cust_no){
			$this->db->select('*');
			$this->db->from('customer_loan');
			$this->db->where('cust_no',$cust_no);
			$query = $this->db->get();
			if($query->num_rows() > 0 ){
				return array('records' => $query->result(),
				'count' => $query->num_rows(),
				'cust_no' => $query->row('cust_no'));
			}else{
				return false;
			}
		}
	}
?>