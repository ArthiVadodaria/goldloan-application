<?php
	class API_Controller extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			$this->load->helper('url','form');
			$this->load->database();
			//session variable check
			if(!$this->session->userdata('logged_in')){
				header("location: http://localhost/gl/authentication_controller");
			}else{
				//echo json_encode($this->session->userdata('logged_in'));
				}
		}
		public function index()
		{	}
		
		public function get_details(){
			$this->load->model('customer');
			$result = $this->customer->showCustomersName();
			echo json_encode($result);
		}
		
		public function get_loannos(){
			$this->load->model('loan');
			$loanstatus= 'pending';
			$result = $this->loan->showLoanNos($loanstatus);
			echo json_encode($result);
		}
		public function get_allloannos(){
			$this->load->model('loan');
			$result = $this->loan->showAllLoanNos();
			echo json_encode($result);
		}
		
		public function change_password(){
			$this->load->model('login_model');
			$username=$this->session->userdata('logged_in');
			$data = array('password' => $this->input->post('newpwd'));
			$result=$this->login_model->changePwd($username,$data);
			if($result==true){
				$a = array('message'=>'pwdchange','class'=>'password is changed');
				$this->session->flashdata('pwdchange',$a);
				redirect ('details_controller/change_Pwd');
				$this->session->keep_flashdata('pwdchange',$a);
				//$this->session->flashdata('pwdchange');
				//echo $alert;
			}
			else{
				$alert = $this->session->set_userdata('pwdchange','password changed');
				echo $alert;
			}
		}
	}
?>