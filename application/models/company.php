<?php
	Class Company extends CI_Model{
		public function companyDetails($data){
			if ($this->db->insert("company", $data)) { 
				return true; 
			}
			else 
				return false;
		}
		public function updateCompanyDetails($data){
			if($this->db->update('company',$data)){
				return true;
			}
			else
				return false;
		}
		public function updateCompanySettings($data){
			if($this->db->update('company',$data)){
				return true;
			}
			else
				return false;
		}
	}
?>