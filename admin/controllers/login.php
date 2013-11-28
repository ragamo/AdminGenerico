<?php

class Login extends CI_Controller {

	public function index($error = NULL) {
		$data['error'] = $error;
		$this->smarty->view('login.tpl', $data);
	}

	public function logout(){
		$this->session->sess_destroy();
		$this->load->helper('url');
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

			$this->load->helper('url');
			redirect(BASE_URL.'/inicio');
			
		//Usuario invalido. 
		} else {
			$this->index("Usuario y/o contraseña inválida.");
		}
	}	

}