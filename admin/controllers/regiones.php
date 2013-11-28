<?php

class Regiones extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verificaLogin();
	}

	public function index() {
		$this->load->library('grocery_CRUD','','crud');

		//Selecciona la tabla base
		$this->crud->set_table('regiones')->set_subject('region');

		//Campos a mostrar en la grilla
		$this->crud->columns('reg_id','reg_nombre','reg_ordinal');

		//Campos a mostrar en el formulario de adicion y edicion
		$this->crud->fields('reg_id','reg_nombre','reg_ordinal');

		//Mapeo de filas y nombres
		$this->crud->display_as('reg_id','ID')
					->display_as('reg_nombre','Nombre')
					->display_as('reg_ordinal','Ordinal');

		//Tipo de campos
		$this->crud->field_type('reg_id','readonly');

		//Requeridos
		$this->crud->required_fields('reg_nombre','reg_ordinal');

		//Output
		$output = $this->crud->render();
		$data['grid'] = $output->output;
		$data['css'] = $output->css_files;
		$data['js'] = $output->js_files;

		$data['titulo'] = "Regiones";
		$this->smarty->render('generico.tpl', $data);
	}

}