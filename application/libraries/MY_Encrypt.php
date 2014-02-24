<?php

class MY_Encrypt extends CI_Encrypt {

	public function encode($string)  {
		$ret = parent::encode($string);
		$ret = strtr($ret, array(
			'+' => '.',
			'=' => '-',
			'/' => '~'
		));
		return $ret;
	}

	public function decode($string) {
		$string = strtr($string, array(
			'.' => '+',
			'-' => '=',
			'~' => '/'
		));
		return parent::decode($string);
	}
}