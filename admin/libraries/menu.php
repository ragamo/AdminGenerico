<?php

//Iconos:
//http://getbootstrap.com/2.3.2/base-css.html#icons

class Menu {

	private function items() {
		return array(
			'Inicio' => array(
				'icono' => 'icon-home',
				'controller' => 'inicio'
			),
			'Proyectos' => array(
				'icono' => 'icon-tag',
				'controller' => 'proyectos'
			),
			'Modelos' => array(
				'icono' => 'icon-tags',
				'controller' => 'modelos'
			),
			'Configuración' => array(
				'icono' => 'icon-cog',
				'submenu' => array(

					'Usuarios' => array(
						'icono' => 'icon-user',
						'controller' => 'usuarios'
					),
					'Archivos' => array(
						'icono' => 'icon-picture',
						'controller' => 'media'
					),
					'Comunas' => array(
						'icono' => 'icon-map-marker',
						'controller' => 'comunas'
					),
					'Provincias' => array(
						'icono' => 'icon-map-marker',
						'controller' => 'provincias'
					),
					'Regiones' => array(
						'icono' => 'icon-map-marker',
						'controller' => 'regiones'
					)
				)
			)
		);
	}

	public function getItems() {
		$items = $this->items();
		foreach($items as $i => $item) {
			if(isset($item['controller'])) {
				if(strstr($_SERVER["REQUEST_URI"], 'php/'.$item['controller'])) {
					$items[$i]['active'] = true;
					break;
				}
			} elseif(isset($item['submenu'])) {
				foreach($item['submenu'] as $k => $submenu) {
					if(strstr($_SERVER["REQUEST_URI"], 'php/'.$submenu['controller'])) {
						$items[$i]['submenu'][$k]['active'] = true;
						break;
					}
				}
			}
		}
		return $items;
	}

}