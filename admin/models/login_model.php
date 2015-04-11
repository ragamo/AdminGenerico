<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function validate($username = NULL, $password = NULL) {
		if(!isset($username) || $username == "") return false;
		if(!isset($password) || $password == "") return false;
		
		$sql = "SELECT adm_id AS id
				FROM administrators 
				WHERE adm_user = {$this->db->escape($username)} 
				AND adm_pass = {$this->db->escape(md5($password))}
				AND adm_active = 1";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			return $query->row_array();
		}

		return false;
	}

	public function getModulesByUser($idUser) {
		if(!$idUser) return false;
		
		$sql = "SELECT adm_permissions
				FROM administrators 
				WHERE adm_id = {$this->db->escape($idUser)}";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			$res = $query->row_array();
			return explode(",",$res['adm_permissions']);
		}
		return false;
	}


}