<?php
	class loan_controller extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->library(array('form_validation','session','pdf'));
			$this->load->helper(array('url','form'));
			$this->load->database();
			
			$this->load->model(array('loan','ornaments'));
			//session variable check 
			if(!$this->session->userdata('logged_in')){
				header("location: http://localhost/gl/authentication_controller");
			}else{
				
			}
		}
		
		public function index(){
			$this->load->view('includes/header');
			$query=$this->db->get("customer_loan");
			$data['records'] = $query->result();
			$this->load->view('admin/loan/view',$data);
			$this->load->view('includes/footer');
		}
		
		//add a new loan
		public function add1(){
			$this->load->view('includes/header');
			$this->load->helper('form'); 
			$query = $this->db->get("customer_loan");
			$data['records'] = $query->result();
			$this->load->view('admin/loan/add1',$data);
			$this->load->view('includes/footer');
		}
		
		//interact with the model to add loan details
		public function add_details(){
			$this->load->view('includes/header');
			//$this->form_validation->set_rules('cust_no', 'customer no', 'required');
			$this->form_validation->set_rules('loan_no', 'loan no', 'required');
            $this->form_validation->set_rules('ornaments_bag', 'loan lf', 'required');
            $this->form_validation->set_rules('loan_repaymentdate', 'repaymentdate', 'required');
            $this->form_validation->set_rules('loan_rate', 'rate', 'required');
			/* $this->form_validation->set_rules('item_description', 'loan description', 'required');
            $this->form_validation->set_rules('item_wt', 'loan wt', 'required');
            $this->form_validation->set_rules('item_netwt', 'loan netwt', 'required');   */
			if($this->form_validation->run()==FALSE){
				$query = $this->db->get("customer_loan");
				$data['records'] = $query->result();
				$this->load->view('admin/loan/add1',$data);
				$this->load->view('includes/footer');
			}
			else{
				$data= array(
				'cust_no'=>$this->input->post('cust_no'),
				'loan_no'=>$this->input->post('loan_no'),
				'ornaments_bag'=>$this->input->post('ornaments_bag'),
				'item_wttotal'=>$this->input->post('item_wttotal'),
				'item_netwttotal'=>$this->input->post('item_netwttotal'),
				'loan_amteligible'=>$this->input->post('loan_amteligible'),
				'loan_amt'=>$this->input->post('loan_amt'),
				'loan_repaymentdate'=>$this->input->post('loan_repaymentdate'),
				'gold_amt'=>$this->input->post('gold_amt'),
				'loan_rate'=>$this->input->post('loan_rate'),
				'loan_paidamt'=>0,
				'loan_applieddate'=>$this->input->post('date'),
				'loan_status'=>'pending'
				);
				
				$this->loan->insertLoanDetails($data); 

				$item_description_arr = $this->input->post('item_description[]');
				$item_wt_arr = $this->input->post('item_wt[]');
				$item_netwt_arr = $this->input->post('item_netwt[]');
				for( $i = 0 ; $i < count($item_description_arr) ;$i++)
				{
					$data1=array(
					'loan_no' =>$this->input->post('loan_no'),
					'item_description' => $this->input->post('item_description')[$i],
					'item_wt' => $this->input->post('item_wt')[$i], 
					'item_netwt' => $this->input->post('item_netwt')[$i]
					);
				
					$this->ornaments->insertOrnamentDetails($data1);
				}
				$query=$this->db->get("customer_loan");
				$data2['records'] = $query->result();
				$this->load->view('admin/loan/view',$data2);
				
				redirect('loan_controller');
			} 
		}
		
		public function get_details(){
			$this->load->view('includes/header');
			$from = $this->input->post('from');
			$to = $this->input->post('to');
			$data['records'] = $this->loan->showLoanDetails($from,$to);
			if($data['records']==true){
				$this->load->view('admin/loan/view',$data);
			}
			else{
				echo 'select appropriate date';
			}
		}
		
		//view ornament details i.e. description,wt and netwt
		public function loan_ornament_details(){
			$loan_no = $this->uri->segment('3'); 
			$data['records'] = $this->ornaments->showOrnamentDetails($loan_no);
			$data['record'] = $this->loan->loanPaymentDetails($loan_no);
			$this->load->view('admin/loan/loandetails',$data);	
		}
		
		
		//delete a particular loan 
		public function delete_loan(){
			$this->load->view('includes/header');
			$loan_no = $this->uri->segment('3'); 
			$this->loan->deleteLoan($loan_no); 
			$this->ornaments->deleteOrnaments($loan_no);
   
			$query=$this->db->get("customer_loan");
			$data['records'] = $query->result();
			$this->load->view('admin/loan/view',$data);
		}
		
		//to test API_controller===select2
		public function search(){
			$this->load->view('admin/loan/search');
		}
		
		//reports--generate pdf 
		public function reports(){
			$loan_no=$this->uri->segment('3');
			$query=$this->db->get('company');
			$data['record']=$query->result();
			$data['records']=$this->loan->showLoans($loan_no);
			$this->load->view('admin/loan/report',$data);
			$this->db->get('customer_loan');
			$data= array(
			'loan_no'=>$loan_no
			);
			$this->db->set('loan_noticedate','NOW()',FALSE);
			$this->loan->updatenoticedate($loan_no,$data);
		}
		
	}
?>