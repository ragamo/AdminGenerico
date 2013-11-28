<?php

class Provincias extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verificaLogin();
	}

	public function index() {
		$this->load->library('grocery_CRUD','','crud');

		//Selecciona la tabla base
		$this->crud->set_table('provincias')->set_subject('provincia');

		//Campos a mostrar en la grilla
		$this->crud->columns('prov_id','prov_nombre','prov_region');

		//Campos a mostrar en el formulario de adicion y edicion
		$this->crud->fields('prov_id','prov_nombre','prov_region');

		//Mapeo de filas y nombres
		$this->crud->display_as('prov_id','ID')
					->display_as('prov_nombre','Nombre')
					->display_as('prov_region','Región');

		//Tipo de campos
		$this->crud->field_type('prov_id','readonly');
	
		//Relaciones
		$this->crud->set_relation('prov_region','regiones','reg_nombre');

		//Requeridos
		$this->crud->required_fields('prov_nombre','prov_region');

		//Output
		$output = $this->crud->render();
		$data['grid'] = $output->output;
		$data['css'] = $output->css_files;
		$data['js'] = $output->js_files;

		$data['titulo'] = "Provincias";
		$this->smarty->render('generico.tpl', $data);
	}

}