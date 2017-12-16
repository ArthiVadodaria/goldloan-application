<?php

Class Login_model extends CI_Model {

	// Insert registration data in database
	public function registration_insert($data) {
		// Query to check whether username already exist or not
		$condition = "cust_no =" . "'" . $data['cust_no'] . "'";
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {

		// Query to insert data in database
		$this->db->insert('admin', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else {
		return false;
		}
	}

	// Read data using username and password
	public function login($data) {

		$condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
		return true;
		} else {
		return false;
		}
	}
	
	public function changePwd($username,$update){
		$this->db->where('username',$username);
		$this->db->update('admin', $update);
		return true;
	}

	// Read data from database to show data in admin page
	public function read_user_information($username) {
		$condition = "username=" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
		return false;
		}
	}
}
?>