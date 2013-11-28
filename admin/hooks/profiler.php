<?php

class Profiler {

	public function showProfiler() {
		$CI =& get_instance();
		$CI->output->enable_profiler(TRUE);
	}

}