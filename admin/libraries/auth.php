<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	function verifyLogin() {
		$CI =& get_instance();

		//Detecta usuario autenticado
		$loggedin = $CI->session->userdata('loggedin');
		if(!isset($loggedin) || $loggedin != 1) {
			$CI->load->helper('url');
			redirect(BASE_URL."/login/");
		}

		//Detecta que usuario pueda usar el controller indicado
		$CI->load->model('login_model');
		$userModules = $CI->login_model->getModulesByUser($CI->session->userdata('id'));
		if(!in_array($CI->router->fetch_class(), $userModules)) {
			$data['title'] = '<i class="icon-ban-circle"></i> Restricted area.';
			$data['grid'] = '<p class="lead">You dont have the right permissions to see this module.</p>';
			echo $CI->smarty->render('generic.tpl', $data, true);
			exit;
		}
		
		return true;
	}
	
}