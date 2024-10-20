<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function users_get()
	{
		$data['query'] = $this->um->getAll();
		echo json_encode($data);
	}

	public function getUserById($id){
		$data['query'] = $this->um->getById($id);
		echo json_encode($data);
	}

	public function addUser()
	{
		$inputJSON = file_get_contents('php://input');
		$input = json_decode($inputJSON, true);
		$user_data = array(
			'user_name' => $input['user_name'],
			'user_password' => $input['user_password'],
			'user_type' => $input['user_type']
		);
		$data['query'] = $this->um->addUser($user_data);
		if($this->db->affected_rows() > 0){
			echo '{"Success":{"text":"Added user success"}}';
		}else{
			echo '{"Error":{"text":"Added user fail"}}';
		}
	}

	public function updateUser($id){
		$inputJSON = file_get_contents('php://input');
		$input = json_decode($inputJSON, true);
		$user_data = array(
			'user_name' => $input['user_name'],
			'user_password' => $input['user_password'],
			'user_type' => $input['user_type']
		);
		$this->um->updateUser($id, $user_data);
		if($this->db->affected_rows() > 0){
			echo '{"Success":{"text":"Update user success"}}';
		}else{
			echo '{"Error":{"text":"Update user fail"}}';
		}
	}

	public function deleteUser($id){
		$this->um->deleteUser($id);
		if ($this->db->affected_rows() > 0)
		{
			echo '{"Sucess":{"text":"Delete user success"}}';
		}
		else
		{
			echo '{"Error":{"text":"Delete user fail"}}';
		}
	}

}
