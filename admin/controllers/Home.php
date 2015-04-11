<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verificaLogin();
	}

	public function index() {
		$this->smarty->render('inicio.tpl');
	}

}
