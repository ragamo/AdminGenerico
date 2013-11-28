<?php

class Media_model extends CI_Model {

	public function getNombreProyecto($idProyecto) {
		$sql = 'SELECT pro_nombre FROM proyectos WHERE pro_id = '.$this->db->escape($idProyecto);
		$query = $this->db->query($sql);

		if($query->num_rows() > 0) {
			$res = $query->result_array();
			return $res[0]['pro_nombre'];
		}
		return false;
	}

	public function getNombreModelo($idModelo) {
		$sql = 'SELECT mod_nombre FROM modelos WHERE mod_id = '.$this->db->escape($idModelo);
		$query = $this->db->query($sql);

		if($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result[0]['mod_nombre'];
		}
		return false;
	}

}