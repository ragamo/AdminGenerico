<?php

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verificaLogin();
	}

	public function index() {
		$this->load->library('grocery_CRUD','','crud');

		//Selecciona la tabla base
		$this->crud->set_table('usuarios')->set_subject('usuario');

		//Campos a mostrar en la grilla
		$this->crud->columns('usu_id','usu_user');

		//Mapeo de filas y nombres
		$this->crud->display_as('usu_id','ID')
					->display_as('usu_user','Usuario')
					->display_as('usu_pass','Contraseña')
					->display_as('usu_activo','Estado')
					->display_as('usu_permisos','Permisos');

		//Tipo de campos
		$this->crud->field_type('usu_activo','dropdown', array('0' => 'Inactivo', '1' => 'Activo'))
					->field_type('usu_id','readonly')
					->field_type('usu_pass','password');

		//Requeridos
		$this->crud->required_fields('usu_user','usu_pass','usu_activo','usu_permisos');

		//Callbacks
		$this->crud->callback_before_insert(array($this,'encryptPasswordCallback'));
		$this->crud->callback_before_update(array($this,'encryptPasswordCallback'));

		//Permisos
		$this->load->library('menu');
		$this->crud->field_type('usu_permisos','multiselect', $this->menu->getModulos());

		//Output
		$output = $this->crud->render();
		$data['grid'] = $output->output;
		$data['css'] = $output->css_files;
		$data['js'] = $output->js_files;

		$data['titulo'] = "Usuarios";
		$this->smarty->render('generico.tpl', $data);
	}

	public function encryptPasswordCallback($formData, $id = NULL) {
		//Si ya es MD5 no hace nada
		if(!preg_match('/^[a-f0-9]{32}$/', $formData['usu_pass'])) {
			$formData['usu_pass'] = md5($formData['usu_pass']);
		}
		return $formData;
	}

}