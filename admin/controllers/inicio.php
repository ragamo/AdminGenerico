<?php

class Inicio extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verificaLogin();
	}

	public function index() {
		$this->smarty->render('inicio.tpl');
	}

}