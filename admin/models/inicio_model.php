<?php

class Inicio_model extends CI_Model {

	public function getTotalProyectos() {
		$sql = "SELECT COUNT(*) as total FROM proyectos";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			$res = $query->result_array();
			return $res[0]['total'];
		}
		return 0;
	}

	public function getTotalModelos() {
		$sql = "SELECT COUNT(*) as total FROM modelos";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			$res = $query->result_array();
			return $res[0]['total'];
		}
		return 0;
	}

	public function getTotalArchivos() {
		$sql = "SELECT COUNT(*) as total FROM media";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			$res = $query->result_array();
			return $res[0]['total'];
		}
		return 0;
	}


}