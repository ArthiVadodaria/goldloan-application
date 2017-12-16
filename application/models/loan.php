<?php 
   class Loan extends CI_Model {
		//insert a new loan
		public function insertLoanDetails($data) {
				if ($this->db->insert("customer_loan", $data)) { 
					return true;
			}
		} 
		
		//for selecting a customer using select2
		public function showLoanNos($loanstatus){
			if(!empty($this->input->get("q"))){
				$this->db->like('loan_no ', $this->input->get("q"));
				$this->db->select('loan_no as id');
				$this->db->select('loan_no as text');
				$this->db->where('loan_status ', $loanstatus);
				//$this->db->where('loan_totalamt > loan_paidamt');
				//$this->db->where('loan_totalamt <> loan_paidamt');
				$query = $this->db->get('customer_loan');
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return false;
				}
			}
		}
		//for selecting a customer using select2
		public function showAllLoanNos(){
			if(!empty($this->input->get("q"))){
				$this->db->like('loan_no ', $this->input->get("q"));
				$this->db->select('loan_no as id');
				$this->db->select('loan_no as text');
				$query = $this->db->get('customer_loan');
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return false;
				}
			}
		}
		
		//delete a particular loan
        public function deleteLoan($loan_no) { 
			if ($this->db->delete("customer_loan", "loan_no = ".$loan_no)) { 
				return true; 
			} 
		}
		
		//
        public function showLoanDetails($from,$to) { 
			//$sql = "SELECT * FROM `customer_loan` WHERE loan_applieddate >= '".$from."' AND loan_applieddate <= '".$to."'";
			$this->db->select('*');
			$this->db->where('loan_applieddate>=',$from);
			$this->db->where('loan_applieddate<=',$to);
			$query = $this->db->get('customer_loan');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		//display all loan details
		/* public function showAllLoans(){
			$query = $this->db->get("customer_loan");
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		} */
		
		//return the no of loans
		public function loanCount() {
			
			$this->db->select('*');
			$this->db->from('customer_loan');
						
			$query = $this->db->get();
			$count = $query->num_rows();
			if ($count > 0) {
				return $count;
			} else {
				return 0;
			}
		}
		
		//return the no of loans
		/* public function loanCount() {
			
			$this->db->select('*');
			$this->db->from('customer_loan');
						
			$query = $this->db->get();
			$count = $query->num_rows();
			if ($count > 0) {
				return $count;
			} else {
				return 0;
			}
		} */
		
		//return the total sum of loan amts
		public function loanAmtSum() {
			
			$this->db->select_sum('loan_amt');
			$this->db->from('customer_loan');
						
			$query = $this->db->get();
			
			return $query->row()->loan_amt;
		}
		
		public function loanPaymentDetails($loan_no){
			
			$this->db->select('loan_no,loan_amt,loan_paidamt,loan_applieddate');
			$this->db->from('customer_loan');
			$this->db->where("loan_no = '".$loan_no."'");
			
			$query=$this->db->get();
			
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function showLoans($loan_no) { 
			
			$this->db->select('*');
			$this->db->where('loan_no',$loan_no);
			
			$query = $this->db->get('customer_loan');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		public function updatenoticedate($loan_no,$data){
			
			$this->db->where('loan_no',$loan_no);
				$this->db->update('customer_loan', $update);
		}
		
		
		//return the no of loan nos
		 public function info() {
			$sql= "SELECT loan_no FROM customer_loan ";
			$query=$this->db->query($sql);
			return $query->result();
		} 

   }