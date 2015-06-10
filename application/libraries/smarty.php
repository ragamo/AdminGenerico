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

class Smarty extends BaseSmarty {
    protected $CI = null;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        // Store the Codeigniter super global instance... whatever
        $this->CI =& get_instance();
        $this->CI->load->config('smarty');

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

        // Modular Separation / Modular Extensions has been detected
        if(method_exists($this->CI->router, 'fetch_module')) {
            $this->_module = $this->CI->router->fetch_module();
            //add the current module view folder as a template directory
            if ($this->_module !== '')
                $this->addTemplateDir(APPPATH."modules/".$this->_module.'/views');
        }
        
        // Should let us access Codeigniter stuff in views
        $this->assign("this", $this->CI);
    }
    
    /**
     * view
     * Imprime o retorna una plantilla procesada.
     * 
     * @param  string  $template nombre o ruta de la plantilla a utilizar
     * @param  array   $data     cada "key" del arreglo se convierte en una variable del mismo nombre que key para ser utilizada en la vista
     * @param  boolean $return   si es true, retorna la plantilla procesada para ser asignada a una variable.
     * @return html
     */
    public function view($template, $data = array(), $return = FALSE){
        $data['BASE_URL']  = BASE_URL;
        $data['FULL_PATH'] = FULL_PATH;
        $data['FB_API_KEY'] = FB_API_KEY;
    
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        
        if ($return == FALSE){
            $this->CI->output->set_output($this->fetch($template));
            return;
            
        } else {
            return $this->fetch($template);
        }
    }

    /**
     * render
     * Preprocesa la plantilla incluyendola ademas dentro de /inc/template.tpl
     * Su funcionamiento es igual a view
     * 
     * @param  string  $template nombre o ruta de la plantilla a utilizar
     * @param  array   $data     cada "key" del arreglo se convierte en una variable del mismo nombre que key para ser utilizada en la vista
     * @param  boolean $return   si es true, retorna la plantilla procesada para ser asignada a una variable.
     * @return html
     */
    public function render($template, $data = array(), $return = FALSE) {
        $data['CONTENIDO'] = $this->view($template, $data, TRUE);
        return $this->view("inc/template.tpl", $data, $return);
    }

}