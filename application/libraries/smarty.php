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


//require_once APPPATH."third_party/Smarty-3.0.8/libs/Smarty.class.php";
require_once BASEPATH.'libraries/Smarty-3.0.8/libs/Smarty.class.php';

class CI_Smarty extends Smarty {

    public function __construct() {
        parent::__construct();

        // Store the Codeigniter super global instance... whatever
        $CI = get_instance();

        $CI->load->config('smarty');

        $this->template_dir      = config_item('template_directory');
        $this->compile_dir       = config_item('compile_directory');
        $this->cache_dir         = config_item('cache_directory');
        $this->config_dir        = config_item('config_directory');
        $this->template_ext      = config_item('template_ext');
        $this->caching           = config_item('cache');
        $this->cache_lifetime    = config_item('cache_lifetime');
        $this->exception_handler = null;
        
        // Only show serious errors. Without this if you try and use variables that
        // do not exist, Smarty will throw variable does not exist errors
        $this->error_reporting   = config_item('error_reporting');

        // Add all helpers to plugins_dir
        $helpers = glob(APPPATH . 'helpers/', GLOB_ONLYDIR | GLOB_MARK);

        foreach ($helpers as $helper) {
            $this->plugins_dir[] = $helper;
        }
        
        // Should let us access Codeigniter stuff in views
        $this->assign("this", $CI);
    }
    
    
    public function view($template, $data = array(), $return = FALSE){
        $data['BASE_URL']  = BASE_URL;
        $data['FULL_PATH'] = FULL_PATH;
        $data['FB_API_KEY'] = FB_API_KEY;
    
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        
        if ($return == FALSE){
            $CI =& get_instance();
            $CI->output->set_output($this->fetch($template));
            return;
            
        } else {
            return $this->fetch($template);
        }
    }

    public function render($template, $data = array(), $return = FALSE) {
        $x['CONTENIDO'] = $this->view($template, $data, TRUE);
        return $this->view("inc/template.tpl", $x, $return);
    }

}