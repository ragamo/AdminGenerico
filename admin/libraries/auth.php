<?php
 
class Auth {

	function verificaLogin() {
		$CI =& get_instance();
		$logeado = $CI->session->userdata('logeado');

		if(!isset($logeado) || $logeado != 1) {
			$CI->load->helper('url');
			redirect(BASE_URL."/login/");
		}
		
		return true;
	}
	
}