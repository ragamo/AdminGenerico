<?php

class Comunas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verificaLogin();
	}

	public function index() {
		$this->load->library('grocery_CRUD','','crud');

		//Selecciona la tabla base
		$this->crud->set_table('comunas')->set_subject('comuna');

		//Campos a mostrar en la grilla
		$this->crud->columns('com_id','com_nombre','com_provincia');

		//Campos a mostrar en el formulario de adicion y edicion
		$this->crud->fields('com_id','com_nombre','com_provincia');

		//Mapeo de filas y nombres
		$this->crud->display_as('com_id','ID')
					->display_as('com_nombre','Nombre')
					->display_as('com_provincia','Provincia');

		//Tipo de campos
		$this->crud->field_type('com_id','readonly');

		//Relaciones
		$this->crud->set_relation('com_provincia','provincias','prov_nombre');

		//Requeridos
		$this->crud->required_fields('com_nombre','com_provincia');

		//Output
		$output = $this->crud->render();
		$data['grid'] = $output->output;
		$data['css'] = $output->css_files;
		$data['js'] = $output->js_files;

		$data['titulo'] = "Comunas";
		$this->smarty->render('generico.tpl', $data);
	}

}