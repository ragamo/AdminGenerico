<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name CI Smarty
* @copyright Dwayne Charrington, 2011.
* @author Dwayne Charrington and other Github contributors
* @license (DWYWALAYAM) 
           Do What You Want As Long As You Attribute Me Licence
* @version 1.2
* @link http://ilikekillnerds.com
*/

// Your views directory with a trailing slash
$config['template_directory']   = APPPATH."views/";

// Where templates are compiled
$config['compile_directory']    = APPPATH."cache/smarty/compiled";

// Cache
$config['cache']				= false;
$config['cache_lifetime']		= 3600;
$config['cache_directory']      = APPPATH."cache/smarty/cached";

// Where Smarty configs are located
$config['config_directory']     = APPPATH."third_party/Smarty/configs";

// Default extension of templates if one isn't supplied
$config['template_ext']         = 'tpl';

// PHP error reporting level (can be any valid error reporting level)
$config['error_reporting'] = "E_ALL";