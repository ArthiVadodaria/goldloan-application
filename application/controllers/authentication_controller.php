<?php
	class authentication_controller extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->library(array('form_validation','session'));
			$this->load->database();
 		}
		
		public function index(){
			//session variable check 
			if(!$this->session->userdata('logged_in')){
			$this->load->view('admin/login/login_form');}
			else{
				redirect('authentication_controller/home');
				}
		}

		// Check for login validation and login to the application
		public function user_login_process() {

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/login/login_form');
		} 
		else {
			$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
			$this->load->model('login_model');
			$result = $this->login_model->login($data);
			if ($result == TRUE) {
				$this->load->view('includes/header');
				$username = $this->input->post('username');
				$result = $this->login_model->read_user_information($username);
				if ($result != false) {
					$session_data = array(
					'username' => $result[0]->username
				);
				// Add user data to session variable
				$this->session->set_userdata('logged_in', $result[0]->username);
						
				$this->load->model('customer');
				$result1['cc'] = $this->customer->custcount();
			
				$this->load->model('loan');
				$result1['lc'] = $this->loan->loancount();
			
				$this->load->view('admin/login/home', $result1 ); 
				$this->load->view('includes/footer');
				}
			}
			else {
				$data = array(
					'error_message' => 'Invalid Username or Password'
				);
					$this->load->view('admin/login/login_form',$data);
				}
			}
		}

		//load home page
		public function home(){
			$this->load->view('includes/header');
			$this->load->helper('string');//load string helper
			$this->load->model('customer');
			
			$result1['cc'] = $this->customer->custCount();
			
			$this->load->model('loan');
			$result1['lc'] = $this->loan->loanCount();
			
			/* $this->load->model('loan');
			$result1['las'] = $this->loan->loanAmtSum(); */
			$this->load->view('admin/login/home', $result1 );
			$this->load->view('includes/footer');
		}

		//logout of the application
		public function logout(){
			$this->session->unset_userdata('logged_in');
			if(!$this->session->userdata('logged_in')){
				$this->load->view('admin/login/login_form');
				//echo json_encode($this->session->userdata('logged_in'));
				echo 'Login Again';
			}else{
				//echo json_encode($this->session->userdata('logged_in'));
				$this->load->view('includes/header');
				$this->load->view('admin/login/home');}
		}
	}
?>