<?php

class Modelos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verificaLogin();
	}

	public function index($idProyecto = null, $accion = null) {
		$this->load->library('grocery_CRUD','','crud');

		//Selecciona la tabla base
		$this->crud->set_table('modelos')->set_subject('modelo');

		//Campos a mostrar en la grilla
		$this->crud->columns('mod_id','mod_nombre','mod_proyecto','mod_tipo','mod_preciouf','mod_visible');

		//Campos a mostrar en el formulario de adicion
		$this->crud->add_fields('mod_nombre','mod_proyecto','mod_tipo','mod_visible','mod_descripcion','mod_caracteristicas',
							'mod_superficie','mod_dormitorios','mod_banios','mod_preciouf','mod_preciopesos');

		//Campos a mostrar en el formulario de edicion
		$this->crud->edit_fields('mod_id','mod_nombre','mod_proyecto','mod_tipo','mod_visible','mod_descripcion','mod_caracteristicas',
							'mod_superficie','mod_dormitorios','mod_banios','mod_preciouf','mod_preciopesos');

		//Algo de logica
		$subtitulo = "";
		if(isset($idProyecto) && is_numeric($idProyecto)) {
			$this->load->model('media_model');
			$subtitulo = $this->media_model->getNombreProyecto($idProyecto);

			$this->crud->where('mod_proyecto',$idProyecto);
			if($accion == "add") 
				$this->crud->field_type('mod_proyecto','hidden',$idProyecto);
			if($accion == "edit") {
				$this->crud->field_type('mod_proyecto','readonly');
			}
		}

		//Mapeo de filas y nombres
		$this->crud->display_as('mod_id','ID')
					->display_as('mod_proyecto','Proyecto')
					->display_as('mod_nombre','Nombre')
					->display_as('mod_tipo','Tipo')
					->display_as('mod_visible','Visible')
					->display_as('mod_descripcion','Descripcion')
					->display_as('mod_caracteristicas','Caracteristicas')
					->display_as('mod_superficie','Superficie')
					->display_as('mod_dormitorios','Dormitorios')
					->display_as('mod_banios','Baños')
					->display_as('mod_preciouf','Precio UF')
					->display_as('mod_preciopesos','Precio $');

		//Tipo de campos
		$this->crud->field_type('mod_visible','dropdown', array('0' => 'Oculto', '1' => 'Publicado'))
					->field_type('mod_id','readonly')
					->field_type('mod_descripcion','text')
					->field_type('mod_caracteristicas','text')
					->field_type('mod_preciouf','integer')
					->field_type('mod_preciopesos','integer');
	
		//Relaciones
		if($accion != "add") $this->crud->set_relation('mod_proyecto','proyectos','pro_nombre');
		$this->crud->set_relation('mod_tipo','tipos','tip_nombre');

		//Acciones en grilla
		$this->crud->add_action('Imagenes', FULL_PATH.'/img/icons/images.png', '/media/index/modelo','');

		//Campos requeridos
		$this->crud->required_fields('mod_proyecto','mod_nombre','mod_visible','mod_tipo');

		//Output
		$output = $this->crud->render();
		$data['grid'] = $output->output;
		$data['css'] = $output->css_files;
		$data['js'] = $output->js_files;

		$data['titulo'] = "Modelos";
		if(isset($idProyecto) && is_numeric($idProyecto))
			$data['subtitulo'] = '<a href="'.BASE_URL.'/proyectos">Proyectos</a> > '.
								'<a href="'.BASE_URL.'/proyectos/index/read/'.$idProyecto.'">'.$subtitulo.'</a>';
		$this->smarty->render('generico.tpl', $data);
	}

}