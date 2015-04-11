<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

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

	public function validate() {		
		$this->load->model('login_model');

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$user = $this->login_model->validate($username, $password);
		if(!$user) {
			$this->index("Invalid user or password.");
			return;
		}
		
		//Si el usuario es valido.
		$data = array(
			'id' => $user['id'],
			'username' => $username,
			'loggedin' => 1
		);
		$this->session->set_userdata($data);

		//Recupera el primer modulo habilitado para el usuario
		$modulos = $this->login_model->getModulesByUser($data['id']);
		$this->load->helper('url');
		redirect(BASE_URL.'/'.$modulos[0]);
	}	

}