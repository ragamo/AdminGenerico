<?php

class Login_model extends CI_Model {

	public function validar($username = NULL, $password = NULL) {
		if(!isset($username) || $username == "") {
			return FALSE;
		}
		if(!isset($password) || $password == "") {
			return FALSE;
		}
		
		$sql = 'SELECT * FROM usuarios 
				WHERE usu_user = '.$this->db->escape($username).' 
				AND usu_pass = '.$this->db->escape(md5($password)).' 
				AND usu_activo = "1"';

		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
			$res = $query->result();
			return $res[0];
		}

		return FALSE;
	}


}