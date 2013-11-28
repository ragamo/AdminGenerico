<?php

class Inicio extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verificaLogin();
	}

	public function index() {
		$this->load->model('inicio_model');

		$data['totalProyectos'] = $this->inicio_model->getTotalProyectos();
		$data['totalModelos'] = $this->inicio_model->getTotalModelos();
		$data['totalArchivos'] = $this->inicio_model->getTotalArchivos();

		$data['css'] = FULL_PATH.'/css/inicio.css';
		$data['js'] = FULL_PATH.'/js/funciones_inicio.js';
		$this->smarty->render('inicio.tpl', $data);
	}

}