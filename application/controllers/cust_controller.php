<?php
	class cust_controller extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library(array('form_validation','session'));
			$this->load->database();
			if(!$this->session->userdata('logged_in')){
				header("location: http://localhost/gl/authentication_controller");
			}else{
				//echo json_encode($this->session->userdata('logged_in'));
					
			}
		}
		
		//display list of customers
		public function index()
		{
			$this->load->view('includes/header');
			$query=$this->db->get("customer");
			$data['records'] = $query->result();
			$this->load->view('admin/customer/view',$data);
			$this->load->view('includes/footer');
		}
		
		//load add customer view
		public function add(){
			$this->load->view('includes/header');
			$this->load->view('admin/customer/add');
			$this->load->view('includes/footer');
		}
		
		//check validations and add the details submited in the form 
		public function add_details(){
			
			$this->load->model('customer');
			$this->form_validation->set_rules('cust_no', 'cust_no', 'required|exact_length[12]|trim');
			$this->form_validation->set_rules('cust_name', 'cust_name', 'required|trim');
            $this->form_validation->set_rules('cust_age', 'cust_age', 'required|numeric|trim');
			$this->form_validation->set_rules('cust_addrs', 'cust_addrs', 'required|trim');
            $this->form_validation->set_rules('cust_phno', 'cust_phno', 'required|numeric|min_length[10]|max_length[12]|trim');
			
			$this->form_validation->set_rules('cust_email', 'cust_email', 'required|valid_email|trim');
			$this->form_validation->set_rules('cust_idproof', 'cust_idproof', 'required|trim');
			$this->form_validation->set_rules('cust_sbacc', 'cust_sbacc', 'required|trim');

			if($this->form_validation->run()==FALSE){
				//$this->session->set_flashdata('false','the data entered is not in correct format please try again');
				//$this->session->falshdata('item');
				//$errors = validation_errors();
				
				//echo json_encode($errors);
				//$this->form_validation->set_message('min_length', '');
				$this->load->view("admin/customer/add");
			}
			else{
			$data = array(
			'cust_no' => $this->input->post('cust_no'), 
            'cust_name' => $this->input->post('cust_name'),
			'cust_age' => $this->input->post('cust_age'), 
            'cust_addrs' => $this->input->post('cust_addrs'),
			'cust_phno' => $this->input->post('cust_phno'), 
			'cust_email' => $this->input->post('cust_email'),
			'cust_idproof' => $this->input->post('cust_idproof'), 
			'cust_sbacc' => $this->input->post('cust_sbacc')			
            );
			
			$this->customer->insert($data);
			$query = $this->db->get("customer"); 
			$data['records'] = $query->result();
			
			$this->load->view("admin/customer/view",$data);
			redirect(cust_controller);
			}
		}
		
		//load the selected customer data for editing
		public function edit_customer(){
			$this->load->view('includes/header');
			$this->load->helper('form'); 
			$this->load->model('customer');
			$cust_no = $this->uri->segment('3'); 
			$data['records']=$this->customer->showCustomer($cust_no);
			//echo json_encode($data);
			$this->load->view('admin/customer/edit',$data);
			$this->load->view('includes/footer');
		}
		
		//update the details of the customer 
		public function update_customer_details(){
			
			$this->load->model('customer');
			$this->form_validation->set_rules('cust_name', 'cust_name', 'required|trim');
            $this->form_validation->set_rules('cust_age', 'cust_age', 'required|numeric|trim');
			$this->form_validation->set_rules('cust_addrs', 'cust_addrs', 'required|trim');
            $this->form_validation->set_rules('cust_phno', 'cust_phno', 'required|numeric|min_length[10]|max_length[12]|trim');
			
			$this->form_validation->set_rules('cust_email', 'cust_email', 'required|valid_email|trim');
			$this->form_validation->set_rules('cust_idproof', 'cust_idproof', 'required|trim');
			$this->form_validation->set_rules('cust_sbacc', 'cust_sbacc', 'required|trim');

			if($this->form_validation->run()== FALSE){
				//load the same edit view in case of validation errors
				$cust_no =$this->input->post('cust_no') ; 
				$data['records']=$this->customer->showCustomer($cust_no);
				//$this->load->view("admin/customer/edit",$data);
				redirect(cust_controller);
				
			}
			else
			{
				//post the updated data submitted
				$cust_no= $this->input->post('cust_no');
				$update = array(
				'cust_name' => $this->input->post('cust_name'),
				'cust_age' => $this->input->post('cust_age'), 
				'cust_addrs' => $this->input->post('cust_addrs'),
				'cust_phno' => $this->input->post('cust_phno'), 
				'cust_email' => $this->input->post('cust_email'),
				'cust_idproof' => $this->input->post('cust_idproof'), 
				'cust_sbacc' => $this->input->post('cust_sbacc')			
				);
				
				$this->customer->updateCustomer($cust_no,$update); // call the method from the model
				echo "The details of the customer are updated";
				redirect(cust_controller);
			
				//$this->customer->insert($data);
				//$query = $this->customer->updateCustomer($cust_no,$update); 
			
				//$data['records'] = $query->result();
				
				//$this->load->view("admin/customer/view",$data); 
			}
		}
		
		//delete a particular customer
		public function delete_customer(){
			$this->load->view('includes/header');
			$this->load->model('customer'); 
			$cust_no = $this->uri->segment('3'); 
			$this->customer->deleteCust($cust_no); 
   
			$query = $this->db->get('customer'); 
			$data['records'] = $query->result(); 
			$this->load->view('admin/customer/view',$data); 
		}
		
		//to test API_controller===select2
		public function search(){
			$this->load->view('admin/customer/search');
		}
		
		/* //showAllCustomers == display the list of customers in select2
		public function get_details(){
			$this->load->model('customer');
			$result = $this->customer->showAllCustomers();
			return json_encode($result);
		} */
		
		//to view th loan details i.e. description wt and netwt
		public function customerloan_details(){
			$this->load->model('customer');
			$cust_no = $this->uri->segment('3'); 
			$query = $this->customer->showCustomerLoans($cust_no);
			$data['records'] = $query['records'];
			$data['customer'] = $query['cust_no'];
			$data['count'] = $query['count'];
			
			
			if($query == true){
				$this->load->view('admin/customer/customerloans',$data);
			}else{
				echo 'No Loans Exists for this Customer';
			}
		}
	}
?>