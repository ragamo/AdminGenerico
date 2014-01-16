<?php
/**
 * Valor de la UF desde SII
 * Codigo original por Seth en http://www.chw.net/foro/webmasters/287574-extraer-uf-php-solucion-definitiva-3.html
 * Modificado por CHaack, se prepara para CI e integra cache.
 */

class Uf {
	private $fecha;
	private $year;
	private $mes;
	private $dia;
	private $res;
	private $cacheFile;

	public function __construct($config = null) {
		// si no le damos fecha a la instancia, se usa la actual
		if(!$config) $config['fecha'] = date('d-m-Y');
		$this->fecha = $config['fecha'];
		$this->cacheFile = APPPATH."cache/uf";
		$this->setFecha($config['fecha']);
	}

	public function setFecha($fecha) {
		$fecha = explode("-",$fecha);
		$this->dia = $fecha[0];
		$this->mes = $fecha[1];
		$this->year = $fecha[2];
	}

	public function getUf() {
		if($valorCache = $this->getCache()) {
			return $valorCache;

		} else {
			$this->getUfFromSii();
			$valorUf = $this->res[$this->mes-1][$this->dia-1];
			$valorUf = floor(str_replace(array(".",","), array("","."), $valorUf));
			$this->guardarCache($valorUf);
			return $valorUf;
		}
	}
	
	private function getUfFromSii() {
		$url = "http://www.sii.cl/pagina/valores/uf/uf" . $this->year . ".htm";
		$dom = new DOMDocument;
		$dom->preserveWhiteSpace = false;
		@$dom->loadHTMLFile($url);
			
		$domxpath = new DOMXpath($dom);
		$arr = $domxpath->query("//td");
		$d = 0;
		$m = 0;

		foreach ($arr as $uf) {
			$this->res[$m++][$d] = $uf->nodeValue;
			if ($m>11) {
				$m = 0;
				$d++;
			}                
		}
	}

	private function guardarCache($valor) {
		file_put_contents($this->cacheFile, $this->fecha."|".$valor);
	}

	private function existeCache() {
		$cache = @file_get_contents($this->cacheFile);
		if($cache) {
			$cache = explode("|", $cache);
			if($cache[0] == $this->fecha)
				return $cache[1];
		}
		return false;
	}

	private function getCache() {
		if($valor = $this->existeCache()) {
			return $valor;
		}
		return false;
	}
}