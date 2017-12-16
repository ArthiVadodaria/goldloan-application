<?php
	class details_controller extends CI_Controller{
		public function __construct(){
			parent ::__construct();
				$this->load->library(array('form_validation','session'));
				$this->load->helpers(array('url','form'));
				$this->load->database();
				//session variable check
				if(!$this->session->userdata('logged_in')){
					header('location:http://localhost/gl/authentication_controller/');
				}
		}
		
		public function profile(){
				$this->load->view('includes/header');
				$query = $this->db->get("company"); 
				$data['records'] = $query->result();
				$this->load->view('admin/login/company_profile',$data);
				$this->load->view('includes/footer');
		}
		
		public function companydetails(){
			$this->load->model('company');
			$data=array('company_name'=>$this->input->post('company_name'),
				'company_addrs'=>$this->input->post('company_addrs'),
				'company_phno'=>$this->input->post('company_phno'),
				'company_email'=>$this->input->post('company_email')
				);
			$result = $this->company->companyDetails($data);
			if($result==true){
				$query = $this->db->get("company"); 
				$data['records'] = $query->result();
				$this->load->view('admin/login/company_profile',$data);
				redirect ('details_controller/profile/view');
				echo 'data inserted successfully';
			}
			else{
				$this->load->view('admin/login/company_profile');
				echo json_encode($result);
			}
			$this->load->view('includes/footer');
		}
		
		public function update_companydetails(){
			$this->load->model('company');
			$data=array('company_name'=>$this->input->post('company_name'),
				'company_addrs'=>$this->input->post('company_addrs'),
				'company_phno'=>$this->input->post('company_phno'),
				'company_email'=>$this->input->post('company_email')
				);
			$result = $this->company->updateCompanyDetails($data);
			if($result==true){
				$query = $this->db->get("company"); 
				$data['records'] = $query->result();
				$this->load->view('admin/login/company_profile',$data);
				redirect ('details_controller/profile/view');
			}
			else{
				$this->load->view('admin/login/company_profile');
				echo json_encode($result);
			}
			$this->load->view('includes/footer');
		}
		
		public function update_companysettings(){
			$this->load->model('company');
			$data=array(
				'interest_type'=>$this->input->post('interesttype'),
				'description1'=>$this->input->post('desc1'),
				'description2'=>$this->input->post('desc2')
			);
			echo json_encode($data);
			$result = $this->company->updateCompanySettings($data);
			if($result==true){
				$query = $this->db->get("company"); 
				$data['records'] = $query->result();
				$this->load->view('admin/login/company_profile',$data);
				redirect ('details_controller/profile/view');
			}
			else{
				$this->load->view('admin/login/company_profile');
				echo json_encode($result);
			}
			$this->load->view('includes/footer'); 
		}
		
		function do_upload(){
		  $url = "../images";
		  $image=basename($_FILES['pic']['name']);
		  $image=str_replace(' ','|',$image);
		  $type = explode(".",$image);
		  $type = $type[count($type)-1];
		  if (in_array($type,array('jpg','jpeg','png','gif')))
		  {
			$tmppath="images/".$image; // uniqid(rand()) function generates unique random number.
			if(is_uploaded_file($_FILES["pic"]["tmp_name"]))
			{
			  move_uploaded_file($_FILES['pic']['tmp_name'],$tmppath);
			  return $tmppath; // returns the url of uploaded image.
			}
		  }
		  else
		  {
			redirect(base_url() . 'index.php/Welcome/not_img', 'refresh');// redirect to show file type not support message
		  }
		}
	
		function image_upload(){
		  $data ['image_url']= $this->do_upload();
		  $data ['alt']= $this->input->post('alt');
		  $this->db->update('image_upload', $data);
		  redirect(base_url() . 'details_controller/profile/view', 'refresh');
		}
		
		public function change_pwd(){
			$this->load->view('includes/header');
			$this->load->view('admin/login/change_pwd');
			$this->load->view('includes/footer');
		}
		
	}
?>