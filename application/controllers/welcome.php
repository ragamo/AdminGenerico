<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		$data['var'] = "Welcome";
		$this->smarty->view('welcome.tpl', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */