<?php
/**
 * AdminLTETurbo Config class
 * PHP version 7
 *
 * @category LTE
 * @package  LTEturbo
 * @author   jambonbill <jambonbill@gmail.com>
 * @license  https://github.com/jambonbill  Jambon License 1.01
 * @link     https://github.com/jambonbill
 */

namespace LTE;

use Exception;

/**
 * Admin Config Class
 * PHP version 7
 *
 * @category LTE
 * @package  LTEturbo
 * @author   jambonbill <jambonbill@gmail.com>
 * @license  https://github.com/jambonbill  Jambon License 1.01 (MIT)
 * @link     https://github.com/jambonbill
 */
class Config
{

    /**
     * Path to main json config file
     */
    private $_path='';


    /**
     * Title
     */
    private $_title='';

    private $_menu=null;//objects
    private $_navbar=null;//objects


    /**
     * List of meta
     *
     * @var array
     */
    private $_meta=[];


    /**
     * List of css
     *
     * @var array
     */
    private $_css=[];


    /**
     * List of js files
     *
     * @var array
     */
    private $_js=[];

    /**
     * List of `link`
     *
     * @var array
     */
    private $_link=[];


    /**
     * Footer config
     *
     * @var null
     */
    private $_footer=null;

    /*
    private $_menu=null;
    private $_navbar=null;
    private $_assets=null;
    */


    /**
     * AdminLte Constructor
     *
     * @param string $configfile [description]
     */
    public function __construct($configfile='')
    {

        // Find config path
        $DIR=preg_replace("/\/vendor\/.*/", "/config/adminlte", __DIR__);
        //exit($path);


        if (preg_match('/^\//', $configfile)) {
            //absolute path
        } else {

        }

        if (!$configfile) {
            $configfile='config.json';//default
        }

        if (is_file($configfile)) {
            //config file is found
            $this->_path=realpath($configfile);

        } else {

            $test=$DIR.'/'.basename($configfile);
            //echo "test=$test";
            if (is_file($test)) {
                $this->_path=$test;
            } else {
                throw new Exception("Error : file '$test' not found", 1);
            }
        }


        if ($this->_path) {
            $this->load($this->_path);
        } else {
            // what should we do?
            throw new Exception("LTE config file not found", 1);
        }


        $dirname=pathinfo($_SERVER['SCRIPT_FILENAME'])['dirname'];

        // get the current 'view' to allow menu item selection
        if (preg_match("/\b\/([a-z-0-9_-]+)$/i", $dirname, $o)) {
            $this->_menuMatch=$o[1];
        }

    }


    public function path()
    {
        return realpath($this->_config_file);
    }




    /**
     * Load and decode config file
     *
     * @param  string $filename [description]
     *
     * @return [type]           [description]
     */
    private function load()
    {
        //echo "<li>load()\n";

        //$filename=$this->_path;
        $DIR=dirname(realpath($this->_path));//get config folder
        //exit($DIR);

        $string = file_get_contents($this->_path);

        $config=json_decode($string);

        $err=json_last_error();

        if ($err) {
            die("Error: Invalid config.json");
        }


        if (!isset($config->assets)) {
            throw new Exception("!config->assets. please define config->assets", 1);
        } else if ($config->assets=='assets.json') {

            $ass=$this->jso($DIR.'/assets.json');
            //var_dump($ass);

            foreach ($ass->css as $str) {
                $this->addCss($str);
            }

            //$this->_css=$ass->css;

            foreach ($ass->js as $str) {
                $this->addJs($str);
            }
            //$this->_js=$ass->js;
        }

        // Make sure we have all our keys here
        if (isset($config->title)) {
            $this->_title=$config->title;
        }

        // decode meta
        if ($config->meta=='meta.json') {
            $this->_meta=$this->jso($DIR.'/meta.json');
        }

        // decode link
        if (!isset($config->link)) {
            $config->link=[];
        }

        if ($config->link=='link.json') {
            $this->_link=$this->jso($DIR.'/link.json');
        }

        // decode menu
        if ($config->menu=='menu.json') {
            $this->_menu=$this->jso($DIR.'/menu.json');
        }

        // decode navbar
        if ($config->navbar=='navbar.json') {
            $this->_navbar=$this->jso($DIR.'/navbar.json');
        }
        return true;
    }


    /**
     * Return json file content
     *
     * @param string $path [description]
     *
     * @return [type]       [description]
     */
    private function jso(string $path)
    {
        if (!is_file($path)) {
            throw new Exception("Config file $path not found", 1);
        }

        $jso=json_decode(file_get_contents($path));
        $err=json_last_error();

        if ($err) {
            throw new Exception(json_last_error_msg() . " in " . basename($path), 1);
        }
        return $jso;
    }


    /**
     * Get/Set config
     *
     * @param array  $config [description]
     *
     * @return [type]         [description]
     */
    /*
    public function config($config = [])
    {
        if ($config) {
            $this->config=$config;
        }
        return $this->config;
    }
    */

    /**
     * Return a property value
     *
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    /*
    public function prop(string $key)
    {
        $cfg=(array)$this->config;
        if (isset($cfg[$key])) {
            return $cfg[$key];
        }
        return false;
    }
    */


    /**
     * Menu config object
     *
     * @return [type] [description]
     */
    public function menu()
    {
        if ($this->_menu) {
            return $this->_menu;
        }
        return [];
    }


    /**
     * Navbar config object
     *
     * @return [type] [description]
     */
    public function navbar()
    {
        return $this->_navbar;
    }


    /**
     * Assets config object
     *
     * @return [type] [description]
     */

    public function title()
    {
        return $this->_title;
    }


    /**
     * Footer config
     *
     * @return [type] [description]
     */
    public function footer()
    {
        return $this->_footer;
    }


    /**
     * Css config object
     *
     * @return array [list of css file]
     */
    public function css()
    {
        /*
        $a=$this->assets();

        if (isset($a->css)) {
            return $a->css;
        }
        */
        return $this->_css;
    }


    /**
     * Js files
     *
     * @return array [list of js file to embed]
     */
    public function js()
    {
        /*
        $a=$this->assets();

        if (isset($a->js)) {
            return $a->js;
        }
        */
        return $this->_js;
    }


    /**
     * Add one js file
     *
     * @param string $path [description]
     */
    public function addJs(string $path)
    {
        $this->_js[]=$path;
    }


    /**
     * Add one css file
     *
     * @param string $path [description]
     */
    public function addCss(string $path)
    {
        $this->_css[]=$path;
    }

    /**
     * Meta config object
     *
     * @return [type] [description]
     */
    public function meta()
    {
       return $this->_meta;
    }

    /**
     * Add one meta record.
     * auto-replace duplicates
     *
     * @param array $newmeta [description]
     *
     * @return bool      [description]
     */
    public function addMeta($newmeta=[])
    {
        //echo "addMeta()";print_r($newmeta);exit;
        //print_r($this->_config);exit;
        /*
        if (!isset($this->_config->meta)) {
            $this->_config[->]meta=[];
        }
        */
        /*
        if (!is_array($this->_config->meta)) {
            $this->_config->meta=[];
        }
        */
        $key=false;

        if (isset($newmeta['name'])) {
            $key=$newmeta['name'];
        }

        if (isset($newmeta['property'])) {
            $key=$newmeta['property'];
        }

        $meta=[];
        $replace=false;
        foreach ($this->_meta as $k=>$metar) {
            //Replace previous property-value, or name-value if any
            foreach ($metar as $name=>$value) {
                if ($value==$key) {
                    $replace=$newmeta;
                }
            }

            if ($replace) {
                $meta[]=$replace;
            } else {
                $meta[]=$metar;
            }
        }

        if (!$replace) {//we didnt replace one, so we must add it
            $meta[]=$newmeta;
        }

        $this->_meta=$meta;
        //$this->_config->meta=$meta;
        return true;
    }


    /**
     * [__toString description]
     *
     * @return string [description]
     */
    public function __toString()
    {
        $out=[];
        $out['menu']=$this->_menu;
        return json_encode($out, JSON_PRETTY_PRINT);
    }

}