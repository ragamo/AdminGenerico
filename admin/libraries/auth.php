<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	function verificaLogin() {
		$CI =& get_instance();

		//Detecta usuario autenticado
		$logeado = $CI->session->userdata('logeado');
		if(!isset($logeado) || $logeado != 1) {
			$CI->load->helper('url');
			redirect(BASE_URL."/login/");
		}

		//Detecta que usuario pueda usar el controller indicado
		$CI->load->model('login_model');
		$userModules = $CI->login_model->getModulosPorUsuario($CI->session->userdata('id'));
		if(!in_array($CI->router->fetch_class(), $userModules)) {
			$data['titulo'] = '<i class="icon-ban-circle"></i> Acceso restringido.';
			$data['grid'] = '<p class="lead">No posees los permisos necesarios para ver este módulo.</p>';
			echo $CI->smarty->render('generico.tpl', $data, true);
			exit;
		}
		
		return true;
	}
	
}