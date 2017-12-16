<?php 
	class Payment extends CI_Model{
		//select the previously paid amount of a particular loan
		public function paidamount($loan_no){
			$this->db->select('loan_paidamt');
			$this->db->from('customer_loan');
			$this->db->where('loan_no',$loan_no);
			$query = $this->db->get();
				if($query->num_rows() >0 ){
					//return $query->result();		
					foreach($query->result_array() as $row){
						return $row['loan_paidamt'];
					}
				}else{
					return false;
				}
		}
		
		//select the loan details
		public function info($loan_no){
			$this->db->select('*');
			$this->db->from('customer_loan');
			$this->db->where('loan_no',$loan_no);
			$query = $this->db->get();
				if($query->num_rows() >0 ){
					return array('records'=>$query->result(),
					'loan_no'=>$query->row('loan_no'));
				}else{
					return false;
				}					
		}
		
		public function newloan($data){
			echo "<br>";
			echo $data->loan_applieddate;
			$this->db->insert("customer_loan",$data);
			return true;
		}
		
		public function updateoldloan($loan_no,$newloanno,$loan_rate,$interest, $payment_date,$newloanamt,$status){
			
			$sql1 = "UPDATE customer_loan SET subsequentloanno=".$newloanno.", loan_interest=".$interest.", loan_rate= ".$loan_rate.",loan_status = '".$status."',dateofpayment='".$payment_date."'"." WHERE loan_no = ".$loan_no;
			
			//$sql2 = "UPDATE loan SET loan_no = " .$newloanno." WHERE loan_no = " .$loan_no;
			
			$sql3 = "UPDATE customer_loan SET loan_amt = ".$newloanamt." , loan_applieddate= '".$payment_date."'"."WHERE loan_no = '".$newloanno."'";
			
			$query=$this->db->query($sql1);
			//$query=$this->db->query($sql2);
			$query=$this->db->query($sql3);
			$affected_rows=$this->db->affected_rows();

			if($affected_rows>0){
				return true;
			}else{
				return false;
			}
		}
		
		public function paymentdetails($loan_no,$loan_rate,$interest,$loan_paidamt,$payment_date){
			$sql = "INSERT payment SET loan_no = ".$loan_no." , loan_paidamt=".$loan_paidamt.",dateofpayment='".$payment_date."'";
			$query = $this->db->query($sql);
			$affected_rows=$this->db->affected_rows();

			if($affected_rows>0){
				return true;
			}else{
				return false;
			}
		}
		
		public function updatestatus($loan_no,$loan_rate,$interest,$status){
			$sql3 = "UPDATE customer_loan SET loan_rate= ".$loan_rate.",loan_interest=".$interest.",laon_status=".$status." WHERE loan_no = '".$loan_no."'";
		}
		
		

		public function paymnet($loan_no,$paidamt,$loan_paidamt,$data){
			$sql= "UPDATE customer_loan SET loan_paidamt = " .$paidamt. "+" .$loan_paidamt.  " WHERE loan_no = '".$loan_no."'";
			$query=$this->db->query($sql);
			$affected_rows=$this->db->affected_rows();
			if($affected_rows>0){
				$this->db->insert("payment", $data);
				return true;
			}
			else{
				return false;
			} 
		}
		
	}
?>