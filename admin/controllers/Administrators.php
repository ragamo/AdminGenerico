<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administrators extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verifyLogin();
	}

	public function index() {
		$this->load->library('grocery_CRUD','','crud');

		//Selecciona la tabla base
		$this->crud->set_table('administrators')->set_subject('admin');

		//Campos a mostrar en la grilla
		$this->crud->columns('adm_id','adm_user','adm_active','adm_permissions');

		//Campos a mostrar en el formulario de adicion
		$this->crud->add_fields('adm_user','adm_pass','adm_active','adm_permissions');

		//Campos a mostrar en el formulario de edicion (/*v*/: virtual)
		$this->crud->edit_fields('adm_id','adm_user','adm_pass','adm_active','adm_permissions');

		//Mapeo de filas y nombres
		$this->crud->display_as('adm_id','ID')
					->display_as('adm_user','User')
					->display_as('adm_pass','Password')
					->display_as('adm_active','Status')
					->display_as('adm_permissions','Permissions');

		//Tipo de campos
		$this->crud->field_type('adm_active','dropdown', array('0' => 'Inactive', '1' => 'Active'))
					->field_type('adm_id','readonly')
					->field_type('adm_pass','password');

		//Requeridos
		$this->crud->required_fields('adm_user','adm_pass','adm_active','adm_permissions');

		//Callbacks
		$this->crud->callback_before_insert(array($this,'encryptPasswordCallback'));
		$this->crud->callback_before_update(array($this,'encryptPasswordCallback'));

		//Permisos
		$this->load->library('menu');
		$this->crud->field_type('adm_permissions','multiselect', $this->menu->getModules());

		//Output
		$output = $this->crud->render();
		$data['grid'] = $output->output;
		$data['css'] = $output->css_files;
		$data['js'] = $output->js_files;

		$data['title'] = __CLASS__;
		$this->smarty->render('generic.tpl', $data);
	}

	public function encryptPasswordCallback($formData, $id = NULL) {
		//Si ya es MD5 no hace nada
		if(!preg_match('/^[a-f0-9]{40}$/', $formData['adm_pass'])) {
			$formData['adm_pass'] = sha1($formData['adm_pass']);
		}
		return $formData;
	}

}