<?php
	class payment_controller extends CI_Controller{
		public function __construct(){
			parent ::__construct();
			$this->load->library(array('form_validation','session'));
			$this->load->helper(array('url','form'));
			$this->load->database();
			//session variable check
			if(!$this->session->userdata('logged_in')){
				header("location: http://localhost/gl/authentication_controller");
			}else{
				//echo json_encode($this->session->userdata('logged_in'));
			}
		}

		public function index(){
			$this->load->view('includes/header');
			$this->load->view('admin/loan/payment');
 			$this->load->view('includes/footer');
		}
		
		public function payment(){
			$loan_no = $this->input->post('loan_no');
			redirect('payment_controller/pay/'.$loan_no.'');
		}
		
		public function pay(){
			$this->load->view('includes/header');
			$this->load->model(array('company','payment','loan'));
			$query = $this->db->get("company");
			$a = $query->result_array();
			$data['it'] = $a[0]['interest_type'];
			$loan_no = $this->uri->segment('3'); 
			$data['records']  = $this->loan->loanPaymentDetails($loan_no);
			$query = $this->db->get("customer_loan");
			$data['record'] = $query->result();
			
			$this->load->view('admin/loan/payment',$data);
			$this->load->view('includes/footer'); 
		}
		
		public function payment2(){
			$this->load->model(array('payment','ornaments'));

			$loan_no = $this->uri->segment('3');
			$loan_rate = $this->input->post('loan_rate');
			$interest = $this->input->post('interest');
			$loan_paidamt = $this->input->post('loan_paidamt');
			$payment_date =  $this->input->post('paymentdate');
			$newloanamt = $this->input->post('balance');
			$status='cleared';
			//echo $payment_date;
			$newloanno = $loan_no + 1;
			$this->load->model('loan');
						
			$query1 = $this->payment->info($loan_no);
			$query = $this->ornaments->showOrnamentDetails($loan_no);
				
			$data1['records'] = $query1['records'];
			$data1['records'][0]->loan_applieddate = " ".$payment_date." ";
			$data1['records'][0]->loan_no = $loan_no+1;
			$data1['records'][0]->loan_status = 'pending';
			
			$data2 = $query;
			foreach($data2 as $a){
				$a['loan_no']=$loan_no+1;
				$this->ornaments->insertOrnamentDetails($a);
			}
			echo $data1['records'][0]->loan_applieddate;
			$query2 = $this->payment->newloan($data1['records'][0]);
			$query3 = $this->payment->updateoldloan($loan_no,$newloanno, $loan_rate,$interest,$payment_date,$newloanamt,$status);
			$query4 = $this->payment->paymentdetails($loan_no,$loan_rate,$interest,$loan_paidamt,$payment_date);
			
			redirect('loan_controller'); 
		}
		
		public function list(){
			$this->load->view('includes/header');
			$query=$this->db->get("payment");
			$data['records'] = $query->result();
			$this->load->view('admin/login/info',$data);
		}
	}
?>