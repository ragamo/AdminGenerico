<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//Icons:
//http://getbootstrap.com/2.3.2/base-css.html#icons
//http://fortawesome.github.io/Font-Awesome/3.2.1/icons/

class Menu {

	private function items() {
		return array(
			'Home' => array(
				'icon' => 'icon-home',
				'controller' => 'home'
			),
			'Config' => array(
				'icon' => 'icon-cog',
				'submenu' => array(

					'Administrators' => array(
						'icon' => 'icon-user',
						'controller' => 'administrators'
					)
				)
			)
		);
	}

	/**
	 * getModulos
	 * Retorna un arreglo de primer nivel para exponer
	 * los modulos disponible para cada usuario como permiso.
	 * Se utiliza en /usuarios
	 * 
	 * @return
	 */
	public function getModules() {
		$output = array();
		$items = $this->items();

		foreach($items as $i => $item) {
			if(isset($item['controller'])) {
				$output[$item['controller']] = $i;
			} elseif(isset($item['submenu'])) {
				foreach($item['submenu'] as $k => $submenu) {
					$output[$submenu['controller']] = $k;
				}
			}
		}

		return $output;
	}

	/**
	 * getItems
	 * Retorna un arreglo para imprimir los elementos en la vista
	 * ademas detecta si el usuario se encuentra en el controller seleccionado
	 * 
	 * @return
	 */
	public function getItems() {
		$CI =& get_instance();
		$CI->load->model('login_model');
		$permisos = $CI->login_model->getModulesByUser($CI->session->userdata('id'));

		$output = array();
		$items = $this->items();
		foreach($items as $i => $item) {
			if(isset($item['controller']) && in_array($item['controller'], $permisos)) {
				$output[$i] = $items[$i];

				if(strstr($_SERVER["REQUEST_URI"], 'php/'.$item['controller'].'/')) {
					$output[$i]['active'] = true;
				}

			} elseif(isset($item['submenu'])) {
				foreach($item['submenu'] as $k => $submenu) {
					if(in_array($submenu['controller'],$permisos)) {
						$output[$i]['icon'] = $items[$i]['icon'];
						$output[$i]['submenu'][$k] = $items[$i]['submenu'][$k];

						if(strstr($_SERVER["REQUEST_URI"], 'php/'.$submenu['controller'].'/')) {
							$output[$i]['submenu'][$k]['active'] = true;
						}
					}
				}
			}
		}
		return $output;
	}

}