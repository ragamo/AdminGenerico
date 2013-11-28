<?php

class Media extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verificaLogin();
	}

	public function index($tipoSeleccion = null, $idSeleccion = null, $accion = null) {
		$this->load->library('grocery_CRUD','','crud');

		//Selecciona la tabla base
		$this->crud->set_table('media')->set_subject('archivo');

		//Filtramos registros segun el tipo de seleccion
		if(!empty($tipoSeleccion) && !empty($idSeleccion)) {
			$this->load->model('media_model');
			switch($tipoSeleccion) {
				case 'proyecto': 
					$subtitulo['value'] = $this->media_model->getNombreProyecto($idSeleccion);
					$subtitulo['link'] = "proyectos";

					$this->crud->where('med_proyecto', $idSeleccion);
					$this->crud->columns('med_id','med_proyecto','med_tipo','med_url','med_orden');
					$this->crud->fields('med_proyecto','med_tipo','med_url','med_orden');

					if($accion == "add") {
						$this->crud->field_type('med_proyecto','hidden',$idSeleccion);
					}
					if($accion == "edit") {
						$this->crud->field_type('med_proyecto','readonly');
						$this->crud->set_relation('med_proyecto','proyectos','pro_nombre');
					}
				break;
				case 'modelo':
					$subtitulo['value'] = $this->media_model->getNombreModelo($idSeleccion);
					$subtitulo['link'] = "modelos";

					$this->crud->where('med_modelo', $idSeleccion); 
					$this->crud->columns('med_id','med_modelo','med_tipo','med_url','med_orden');
					$this->crud->fields('med_modelo','med_tipo','med_url','med_orden');	

					if($accion == "add") {
						$this->crud->field_type('med_modelo','hidden',$idSeleccion);
					}
					if($accion == "edit") {
						$this->crud->field_type('med_modelo','readonly');
						$this->crud->set_relation('med_modelo','modelos','mod_nombre');
					}
				break;
			}

		} else {
			$this->crud->columns('med_id','med_proyecto','med_modelo','med_tipo','med_url','med_orden');
		}

		//Relaciones
		if($accion != "add" && $accion != "edit") {
			$this->crud->set_relation('med_proyecto','proyectos','pro_nombre');
			$this->crud->set_relation('med_modelo','modelos','mod_nombre');
		}

		//Mapeo de filas y nombres
		$this->crud->display_as('med_id','ID')
					->display_as('med_proyecto','Proyecto')
					->display_as('med_modelo','Modelo')
					->display_as('med_tipo','Tipo')
					->display_as('med_url','Imagen')
					->display_as('med_orden','Orden');

		//Tipo de campos
		$this->crud->field_type('med_orden','integer')
					->field_type('med_tipo','dropdown', array(
						'logo' => 'Logo', 
						'imagen' => 'Imagen',
						'video' => 'Video',
						'360' => '360º',
						'planta' => 'Planta'
					));

		//Uploader
		$this->crud->set_field_upload('med_url','application/uploads');

		//Requeridos
		$this->crud->required_fields('med_tipo','med_url');

		//Output
		$output = $this->crud->render();
		$data['grid'] = $output->output;
		$data['css'] = $output->css_files;
		$data['js'] = $output->js_files;

		$data['titulo'] = "Archivos";
		if(!empty($subtitulo)) 
			$data['subtitulo'] = '<a href="'.BASE_URL.'/'.$subtitulo['link'].'/">'.ucfirst($subtitulo['link']).'</a> > '.
								'<a href="'.BASE_URL.'/'.$subtitulo['link'].'/index/read/'.$idSeleccion.'">'.$subtitulo['value'].'</a>';
		$this->smarty->render('generico.tpl', $data);
	}


	// TEST
	public function images($idProyecto = NULL) {
		$this->load->library('image_CRUD','','icrud');

		$this->icrud->set_table('media');
		$this->icrud->set_primary_key_field('med_id');
		$this->icrud->set_url_field('med_url');
		$this->icrud->set_ordering_field('med_orden');
		$this->icrud->set_image_path('application/uploads');
		//$this->icrud->set_relation_parent('med_proyecto', $idProyecto);
			
		$output = $this->icrud->render();
		//print_r($output);
		$data['grid'] = $output->output;
		$data['css'] = $output->css_files;
		$data['js'] = $output->js_files;

		$data['titulo'] = "Imagenes";
		$this->smarty->render('generico.tpl', $data);
		return;
	}

}