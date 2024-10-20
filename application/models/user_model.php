<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends \CI_Model
{
	public function getAll(){
		$result = $this->db
			->select('user_id, user_name')
			->from('tbl_user')
			->get()
			->result();

		return $result;
	}
	public function getById($id){
		$result = $this->db
			->select('user_id, user_name')
			->from('tbl_user')
			->where('user_id', $id)
			->get()
			->result();
		return $result;
	}

	public function addUser($user_data) {
		$this->db->insert('tbl_user', $user_data);

		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function updateUser($id, $user_data) {
		$this->db->where('user_id', $id);
		$this->db->update('tbl_user', $user_data);

		return $this->db->affected_rows() > 0;
	}

	public function deleteUser($id){
		$this->db->where('user_id', $id);
		$this->db->delete('tbl_user');
	}
}
