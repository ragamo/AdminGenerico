<?php

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	public function index($error = NULL) {
		$data['error'] = $error;
		$this->smarty->view('login.tpl', $data);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(BASE_URL);
	}

	public function validar() {		
		$this->load->model('login_model');

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$query = $this->login_model->validar($username, $password);
		
		//Si el usuario es valido.
		if($query) {
			$data = array(
				'id' => $query->usu_id,
				'username' => $username,
				'logeado' => 1
			);
			$this->session->set_userdata($data);

			//Recupera el primer modulo habilitado para el usuario
			$modulos = $this->login_model->getModulosPorUsuario($data['id']);
			redirect(BASE_URL.'/'.$modulos[0]);
			
		//Usuario invalido. 
		} else {
			$this->index("Usuario y/o contraseña inválida.");
		}
	}	

}