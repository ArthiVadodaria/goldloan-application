<?php
	class information_controller extends CI_Controller{
		public function __construct(){
			parent :: __construct();
			$this->load->library(array('form_validation','session'));
			$this->load->helpers(array('url','form'));
			$this->load->database();
			if(!$this->session->userdata('logged_in')){
				header('location:http://localhost/gl/authentication_controller/');
			}
		}
		public function index(){
			$this->load->view('includes/header');
			$query=$this->db->get("payment");
			$data['records'] = $query->result();
			$this->load->view('admin/login/info',$data);
		}
		
		public function info(){
			$this->load->view('includes/header');
			$this->load->model('payment');
			$loan_no = $this->input->post('loan_no');
			$data['records']=$this->payment->info($loan_no);
			$this->load->view('admin/login/info',$data);
			
		}
	}
?>