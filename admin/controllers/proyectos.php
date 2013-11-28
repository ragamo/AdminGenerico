<?php

class Proyectos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->auth->verificaLogin();
	}

	public function index() {
		$this->load->library('grocery_CRUD','','crud');

		//Selecciona la tabla base
		$this->crud->set_table('proyectos')->set_subject('proyecto');

		//Campos a mostrar en la grilla
		$this->crud->columns('pro_id','pro_nombre','pro_avance','pro_preciouf','pro_comuna','pro_visible','pro_direccion');

		//Campos a mostrar en el formulario de adicion
		$this->crud->add_fields('pro_nombre','pro_visible','pro_avance','pro_descripcion','pro_caracteristicas',
							'pro_preciouf','pro_preciopesos','pro_comuna','pro_fono','pro_email','pro_direccion','pro_horaatencion',
							'pro_mapa','pro_nombrecontacto','pro_comollegar','pro_distribucion','pro_superficie');

		//Campos a mostrar en el formulario de edicion (/*v*/: virtual)
		$this->crud->edit_fields('pro_id','pro_nombre','pro_visible','pro_avance','pro_descripcion','pro_caracteristicas',
							'pro_preciouf','pro_preciopesos','pro_comuna','pro_fono','pro_email','pro_direccion','pro_horaatencion',
							'pro_mapa','pro_nombrecontacto','pro_comollegar','pro_distribucion','pro_superficie',/*v*/'acciones');

		//Mapeo de filas y nombres
		$this->crud->display_as('pro_id','ID')
					->display_as('pro_nombre','Nombre')
					->display_as('pro_visible','Visible')
					->display_as('pro_estado','Estado')//?
					->display_as('pro_avance','Avance')
					->display_as('pro_descripcion','Descripcion')
					->display_as('pro_caracteristicas','Caracteristicas')
					->display_as('pro_preciouf','Precio UF')
					->display_as('pro_preciopesos','Precio $')
					->display_as('pro_comuna','Comuna')
					->display_as('pro_fono','Teléfono')
					->display_as('pro_email','Email')
					->display_as('pro_direccion','Dirección')
					->display_as('pro_horaatencion','Horario atención')
					->display_as('pro_mapa','Mapa')
					->display_as('pro_nombrecontacto','Nombre contacto')
					->display_as('pro_comollegar','Como llegar')
					->display_as('pro_distribucion','Distribución')
					->display_as('pro_superficie','Superficie');

		//Tipo de campos
		$this->crud->field_type('pro_visible','dropdown', array('0' => 'Oculto', '1' => 'Publicado'))
					->field_type('pro_id','readonly')
					->field_type('pro_descripcion','text')
					->field_type('pro_caracteristicas','text')
					->field_type('pro_preciouf','integer')
					->field_type('pro_preciopesos','integer');
	
		//Relaciones
		$this->crud->set_relation('pro_avance','avances','ava_nombre');
		$this->crud->set_relation('pro_comuna','comunas','com_nombre');

		//Requeridos
		$this->crud->required_fields('pro_nombre');

		//Acciones en grilla
		$this->crud->add_action('Imagenes', FULL_PATH.'/img/icons/images.png', '/media/index/proyecto');
		$this->crud->add_action('Modelos', FULL_PATH.'/img/icons/house.png', '/modelos/index');

		//Campos virtuales
		$this->crud->callback_edit_field('acciones', array($this, 'linkAcciones'));

		//Output
		//$this->crud->set_theme('twitter-bootstrap');
		$output = $this->crud->render();
		$data['grid'] = $output->output;
		$data['css'] = $output->css_files;
		$data['js'] = $output->js_files;

		$data['titulo'] = "Proyectos";
		$this->smarty->render('generico.tpl', $data);
	}

	public function linkAcciones($value, $id) {
		return '<a href="'.BASE_URL.'/proyectos/index/edit/'.$id.'">Editar</a> | '.
				'<a href="'.BASE_URL.'/modelos/index/'.$id.'">Modelos</a> | '.
				'<a href="'.BASE_URL.'/media/index/proyecto/'.$id.'">Imagenes</a>';
	}

}