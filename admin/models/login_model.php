<?php

class Login_model extends CI_Model {

	public function validar($username = NULL, $password = NULL) {
		if(!isset($username) || $username == "") return false;
		if(!isset($password) || $password == "") return false;
		
		$sql = "SELECT usu_id AS id
				FROM usuarios 
				WHERE usu_user = {$this->db->escape($username)} 
				AND usu_pass = {$this->db->escape(md5($password))}
				AND usu_activo = 1";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			return $query->row_array();
		}

		return false;
	}

	public function getModulosPorUsuario($idUsuario) {
		if(!$idUsuario) return false;
		
		$sql = "SELECT usu_permisos 
				FROM usuarios 
				WHERE usu_id = {$this->db->escape($idUsuario)}";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			$res = $query->row_array();
			return explode(",",$res['usu_permisos']);
		}
		return false;
	}


}