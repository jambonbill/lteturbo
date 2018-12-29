<?php
/**
 * Php class for quick integration of AdminLTE2
 * @author jambonbill
 */

namespace LTE;

/**
* @brief Class providing adminlte2 skeleton
*/
class Admin
{

    /**
     * Static path to assets
     * @var string
     */
    private $path='../';// static path

    /**
     * path to json config file
     * @var string
     */
    private $config_file='';

    /**
     * Config object
     * @var array
     */
    private $config=[];

    private $headHtml= '';

    private $lang= 'en';

    private $navbarCustomMenu='';//html

    private $userPanel='';//html

    private $DEBUG=false;


    /**
     * AdminLte Constructor
     * @param boolean $private [description]
     */
    public function __construct($configfile='')
    {
        // get the config file. it must be located next to the class

        if ($configfile) {
            if (is_file($configfile)) {
                $this->config_file=$configfile;
            } else {
                throw new \Exception("Error : config file '$configfile' not found", 1);
            }
        } else if(isset($_SESSION['lteconfig'])) {
            $this->config_file=$_SESSION['lteconfig'];
        }

        if ($this->config_file) {
            $this->configLoad($this->config_file);
        }

        /*
        $this->lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);// set language
        if ($this->lang!='fr') {
            $this->lang='en';
        }
        */
    }


    /**
     * Register path to configfile
     * @param  string $filename [description]
     * @return [type]           [description]
     */
    public function configfile($filename='')
    {
        //echo __FUNCTION__."($filename)";exit;
        if (is_file($filename)) {

            //make sure it decode well
            $string = file_get_contents($filename);
            $this->config=json_decode($string);
            $err=json_last_error();
            if ($err) {
                throw new Exception("Error decoding json from $filename", 1);
            }else{
                //exit("yes sir");
            }
            //register to sessions
            $this->config_file=$filename;
            $_SESSION['lteconfig']=$this->config_file;
            //exit('_SESSION[lteconfig]='.$this->config_file);

            $this->configLoad($this->config_file);
        }else if($filename){
            throw new \Exception("$filename not found", 1);

        }

        return $this->config_file;
    }


    private function configLoad($filename = '')
    {
        $string = file_get_contents($filename);
        $this->config=json_decode($string);
        $err=json_last_error();

        if ($err) {
            die("Error: Invalid config.json");
        } else {
            //find the correct path for assets
            $diff=count(explode("/", realpath('.')))-count(explode("/", realpath(__DIR__."/../../web")));
            if ($diff > 0) {
                $this->path=str_repeat("../", $diff);
            }
        }

        if(isset($this->config->description)){
            $this->description($this->config->description);
        }

        if(isset($this->config->meta)){//decode meta//
            $type=gettype($this->config->meta);
            if ($type=='string') {
                $DIR=dirname(realpath($this->config_file));//get config folder
                if (is_file($DIR.'/'.$this->config->meta)) {
                    $content=file_get_contents($DIR.'/'.$this->config->meta);
                    $this->config->meta=json_decode($content);
                    if ($err=json_last_error()) {
                        die("error $err".json_last_error_msg()."<br>$content");
                    }
                }
            }
        }
        return true;
    }


    /**
     * Get/Set config
     * @param  array  $config [description]
     * @return [type]         [description]
     */
    public function config($config = [])
    {
        if ($config) {
            $this->config=$config;
        }
        return $this->config;
    }


    /**
     * Return detected language
     * @return [type] [description]
     */
    public function lang()
    {
        return $this->lang;
    }


    /**
     * Get/Set document title
     * @param  string $title [description]
     * @return [type]        [description]
     */
    public function title($title = '')
    {
        if ($title) {
            $this->config->title=$title;
        }

        return $this->config->title;
    }


    /**
     * Get/Set document description
     * @param  string $title [description]
     * @return [type]        [description]
     */
    public function description($str = '')
    {
        if ($str) {
            $this->config->description=trim($str);
            $this->addMeta(['name'=>'description','content'=>$str]);
        }

        return false;
    }




    public function __toString()
    {
        return $this->html();
        //return $this->LTE3();//lte3
    }


    /**
     * return the admin html
     * @return string html
     */
    /*
    public function html()
    {
        $htm=$this->head();
        $htm.=$this->body();
        $htm.=$this->header();
        $htm.=$this->leftside();
        //$htm.=$this->scripts();//in head()
        $htm.='<aside class="right-side">';
        return $htm;
    }
    */
    /**
     * LTE3 Version 2019
     */
    public function html()
    {

        $htm=$this->head();
        $htm.=$this->body();
        //$htm.=$this->header3();//(navbar)
        $htm.=$this->navbar();//(navbar)
        $htm.=$this->sidebar();//left menu

        //$htm.='<aside class="right-side">';
        return $htm;
    }


    /**
     * Return navbar
     * @return [type] [description]
     */
    public function navbar()
    {
        //<!-- Navbar -->
        $htm='<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">';

        $htm.='<ul class="navbar-nav">';
        $htm.='<li class="nav-item">';
        $htm.='<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>';
        $htm.='</li>';
        /*
          <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">Home</a></li>
          <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">Contact</a></li>
        */
        $htm.='</ul>';

        //<!-- SEARCH FORM -->
        $htm.='<form class="form-inline ml-3" action="../search" method=post>';
        $htm.='<div class="input-group input-group-sm">';
            $htm.='<input class="form-control form-control-navbar" name=q type="search" placeholder="Search" aria-label="Search" autocomplete="off">';
        $htm.='<div class="input-group-append">';
            $htm.='<button class="btn btn-navbar" type="submit"><i class="fa fa-search"></i></button>';
        $htm.='</div>';
        $htm.='</div>';
        $htm.='</form>';

        //<!-- Right navbar links -->
        $htm.='<ul class="navbar-nav ml-auto">';

        /*
        //<!-- Control sidebar -->
        $htm.='<li class="nav-item">';
        $htm.='<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fa fa-th-large"></i></a>';
        $htm.='</li>';
        */

        $htm.='<li class="nav-item" title="Sign out">';
        $htm.='<a class="nav-link" href="#"><i class="fa fa-sign-out"></i></a>';
        $htm.='</li>';

        $htm.='</ul>';

        $htm.='</nav>';
        $htm.="\n";

        return $htm;
    }


    /**
     * LTE3 Sidebar (left menu)
     * @return [type] [description]
     */
    public function sidebar()
    {
        $htm="<!-- Main Sidebar Container -->\n";
        $htm.='<aside class="main-sidebar sidebar-dark-primary elevation-4">';

        //<!-- Brand Logo -->
        //$htm.='<a href="#" class="brand-link"><span class="brand-text font-weight-light">AL&CO</span></a>';

        //<!-- Sidebar -->
        $htm.='<div class="sidebar">'."\n";

            //<!-- Sidebar user panel (optional) -->
            $htm.='<div class="user-panel mt-3 pb-3 mb-3 d-flex">';
                $htm.='<div class="image"><img src="../dist/img/user2-128x128.jpg" class="img-circle elevation-2" alt="User Image"></div>';
                $htm.='<div class="info"><a href="#" class="d-block">Jambon Bill</a></div>';
            $htm.='</div>';



        //<!-- Sidebar Menu -->
        /*
        $htm.='<nav class="mt-2">';

        $htm.='<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';
          //<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          $htm.='<li class="nav-item has-treeview">';

            $htm.='<a href="#" class="nav-link">';
              $htm.='<i class="nav-icon fa fa-users"></i>';
              $htm.='<p>Users <i class="right fa fa-angle-left"></i></p>';
            $htm.='</a>';

            $htm.='<ul class="nav nav-treeview">';
              $htm.='<li class="nav-item">';
                $htm.='<a href="../index.html" class="nav-link"><i class="fa fa-circle-o nav-icon"></i><p>Dashboard v1</p></a>';
              $htm.='</li>';
              $htm.='<li class="nav-item">';
                $htm.='<a href="../index2.html" class="nav-link"><i class="fa fa-circle-o nav-icon"></i><p>Dashboard v2</p></a>';
              $htm.='</li>';

            $htm.='</ul>';

          $htm.='</li>';

          $htm.='<li class="nav-item">';
            $htm.='<a href="../infobox" class="nav-link">';
              $htm.='<i class="nav-icon fa fa-th"></i>';
              $htm.='<p>Infobox <span class="right badge badge-danger">New</span></p>';
            $htm.='</a>';
          $htm.='</li>';

          $htm.='<li class="nav-item">';
            $htm.='<a href="widgets.html" class="nav-link">';
              $htm.='<i class="nav-icon fa fa-th"></i>';
              $htm.='<p>AdminLTE3</p>';
            $htm.='</a>';
          $htm.='</li>';

            // LOG OUT //
          $htm.='<li class="nav-item">';
            $htm.='<a href="../login/logout.php" class="nav-link">';
              $htm.='<i class="nav-icon fa fa-sign-out"></i>';
              $htm.='<p>Logout</p>';
            $htm.='</a>';
          $htm.='</li>';

        $htm.='</ul>';
        $htm.='</nav>';
        */

        $htm.='<nav class="mt-2">';
        $htm.=$this->menuHTML()."\n";
        $htm.='</nav>';

        $htm.='</div>'."\n";

        $htm.='</aside>'."\n";
        return $htm;
    }


    /**
     * Decode the menu object
     * @param  [type] $json [description]
     * @return [type]       [description]
     */
    private function menuDecode($json)
    {

        if (!isset($this->config()->menu)) {
            //throw new \Exception("Error : $this->config->menu must be a object", 1);
            return '';
        }else{
            $menu=$this->config()->menu;
        }

        if (!is_object($this->config->menu)) {

            $DIR=dirname(realpath($this->config_file));//get config folder

            if ($this->config->menu&&is_file($DIR.'/'.$this->config->menu)) {

                $content=file_get_contents($DIR.'/'.$this->config->menu);
                $this->config->menu=json_decode($content);

                $err=json_last_error();

                if ($err) {
                    die("error $err".json_last_error_msg()."<br>$content");
                    //throw new \Exception("JSON Error $err", 1);
                }

            } else {
                //die("this->config->menu not found");
                return '';
            }

        }

        return true;

    }


    /**
     * Return menu for inspection/manipulation
     * @return [type] [description]
     */
    public function menu(){
        return $this->config->menu;
    }

    /**
     * Return left menu
     * @return string html
     */
    public function menuHTML($json = '')
    {

        $this->menuDecode($json);


        //$htm='<ul class="sidebar-menu">';//old
        $htm='<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';
        /*
        $htm.='<li class="nav-item">';
            $htm.='<a href="widgets.html" class="nav-link">';
              $htm.='<i class="nav-icon fa fa-th"></i>';
              $htm.='<p>AdminLTE3</p>';
            $htm.='</a>';
          $htm.='</li>';
        */

        foreach (@$this->config->menu as $name => $o) {

            $title='';
            $class='';

            if (!$o) {
                continue;
            }

            /*
            if (isset($o->class)) {
                $class='class="nav-item '.$o->class.'"';
            }
            */

            if (isset($o->title)) {
                $title='title="'.$o->title.'"';
            }

            if (isset($o->header)) {

                $htm.='<li class="nav-header">'.$o->header.'</li>';

            } else if (isset($o->sub)) {
                //continue;
                $htm.='<li class="nav-item has-treeview" '.$title.'>';
                //if(!isset($o->url))$o->url='#';
                if (!isset($o->icon)) {
                    $o->icon='';
                }
                $htm.='<a href="'.@$o->url.'" class="nav-link">';
                $htm.='<i class="nav-icon '.$o->icon.'"></i>';
                //$htm.=' <span>'.$o->text.'</span>';
                $htm.='<p>'.$o->text;
                $htm.='<i class="fa fa-angle-left right"></i>';
                $htm.='</p>';
                $htm.='</a>';
                $htm.='<ul class="nav nav-treeview">';
                foreach ($o->sub as $obj) {

                    $htm.='<li class="nav-item">';

                    if (isset($obj->url)) {
                        $htm.='<a class="nav-link" href="'.$this->path.$obj->url.'">';
                    }

                    if (isset($obj->icon)) {
                        $htm.="<i class='nav-icon ".$obj->icon."'></i> ";
                    }

                    $htm.='<p>'.$obj->text.'</p></a>';
                    $htm.='</li>';
                }
                $htm.='</ul>';
                $htm.='</li>';
            } else {
                $htm.='<li class="nav-item" '.$title.'>';
                if (isset($o->url)) {
                    $htm.='<a class="nav-link" href="'.$this->path.$o->url.'">';
                }
                if (isset($o->icon)) {
                    $htm.='<i class="nav-icon '.$o->icon.'"></i> ';
                }
                $htm.='<p>'.@$o->text.'</p>';
                //$htm.='<small class="label pull-right bg-green">new</small>';//small
                if (isset($o->url)) {
                    $htm.='</a>';
                }
                $htm.='</li>';
            }
        }

        $htm.='</ul>';
        return $htm;
    }



    /**
     * GET config meta's
     * debug with https://search.google.com/structured-data/testing-tool/u/0/
     * @return [type] [description]
     */

    public function meta($meta=null)
    {
        return $this->config->meta;
    }


    // opengraph methods //
    public function ogUrl($str='')
    {
        $this->addMeta(['property'=>'og:url',      'content'=>$str]);
    }

    public function ogType($str='')
    {
        $this->addMeta(['property'=>"og:type",     'content'=>$str]);
    }

    public function ogTitle($str='')
    {
        $this->addMeta(['property'=>"og:title",    'content'=>$str]);
    }

    public function ogDescription($str='')
    {
        $this->addMeta(['property'=>"og:description", 'content'=>$str]);
    }

    public function ogImage($str='')
    {
        $this->addMeta(['property'=>"og:image",    'content'=>$str]);
    }

    public function ogLocale($str='')
    {
        $this->addMeta(['property'=>"og:locale",   'content'=>$str]);
    }

    // twitter methods //
    public function twitterTitle($title='Jambonbill LTETurbo')
    {
        $this->addMeta(['name'=>"twitter:title",   'content'=>$title]);
    }

    public function twitterCard($type='summary')
    {
        $this->addMeta(['name'=>"twitter:card",   'content'=>$type]);
    }

    public function twitterSite($str='@jambonbill')
    {
        $this->addMeta(['name'=>"twitter:site",   'content'=>$str]);
    }


    public function twitterDescription($str='description')
    {
        $this->addMeta(['name'=>"twitter:description",   'content'=>$str]);
    }

    public function twitterImage($url='')
    {
        $this->addMeta(['name'=>"twitter:image",   'content'=>$url]);
    }


    /**
     * Add one meta record.
     * auto-replace duplicates
     * @param array $newmeta [description]
     */
    public function addMeta($newmeta=[])
    {
        //echo "addMeta()";print_r($newmeta);exit;

        if(!isset($this->config->meta)){
            $this->config->meta=[];
        }

        if(!is_array($this->config->meta)){
            $this->config->meta=[];
        }

        $key=false;

        if(isset($newmeta['name'])){
            $key=$newmeta['name'];
        }

        if(isset($newmeta['property'])){
            $key=$newmeta['property'];
        }

        $meta=[];
        $replace=false;
        foreach ($this->config->meta as $k=>$metar) {//Replace previous property-value, or name-value if any

            foreach($metar as $name=>$value){
                if($value==$key)$replace=$newmeta;
            }

            if ($replace) {
                $meta[]=$replace;
            } else {
                $meta[]=$metar;
            }
        }

        if(!$replace){//we didnt replace one, so we must add it
            $meta[]=$newmeta;
        }

        $this->config->meta=$meta;
        return true;
    }


    /**
     * head
     * bring the headers, and initial assets
     * @return [type] [description]
     */
    public function head()
    {
        $htm='<!DOCTYPE html>'."\n";
        $htm.='<html lang="' . $this->lang() . '">'."\n";
        $htm.='<head>'."\n";
        $htm.='<meta charset="UTF-8">'."\n";

        if (isset($this->config->title)) {
            $htm.='<title>' . $this->config->title . '</title>'."\n";
        }

        if (isset($this->config->apple_app_icon)) {
            $htm.= '<link rel="apple-touch-icon" href="' . $this->path . $this->config->apple_app_icon . '">';
        }

        $htm.= "<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>\n";
        $htm.='<meta name="apple-mobile-web-app-status-bar-style" content="black" />'."\n";
        $htm.='<meta name="apple-mobile-web-app-capable" content="yes" />'."\n";


        //echo "<pre>";var_dump($this->config);exit;

        if (isset($this->config->meta)) {

            if( is_array($this->config->meta)) {
                //echo "<pre>";print_r($this->config->meta);exit;
                foreach ($this->config->meta as $meta) {
                    $values=[];
                    foreach ($meta as $k => $v) {
                        $values[]=$k.'="'.$v.'"';
                    }
                    $htm.="<meta ".implode(' ', $values).">\n";
                }
            }

        }

        if (isset($this->config->favicon) && is_file($this->path.$this->config->favicon)) {
            $htm.='<link id="favicon" rel="shortcut icon" href="'.$this->path.$this->config->favicon.'">'."\n";
        }

        // Css
        if (isset($this->config->css)) {
            foreach ($this->config->css as $v) {
                if (preg_match("/^http/i", $v)) {
                    $htm.='<link href="'.$v.'" rel="stylesheet" type="text/css" />'."\n";
                } else {
                    $htm.='<link href="'.$this->path.$v.'" rel="stylesheet" type="text/css" />'."\n";
                }
            }
        }

        // extra head //
        if ($this->headHtml) {
            $htm.=$this->headHtml;
        }

        //Scripts goes here
        $htm.=$this->scripts();

        $htm.="</head>";

        return $htm;
    }


    /**
     * Get/Set extra html to <head> (apple links, tracking code, etc)
     * @return [type] [description]
     */
    public function headHtml($htm = '')
    {
        $this->headHtml=$htm;
        return $this->headHtml;
    }


    /**
     * body
     * bring the headers, and initial assets
     * @return [type] [description]
     */
    public function body()
    {
        $class=[];
        $class[]='hold-transition';
        $class[]='sidebar-mini';

        /*
        if (isset($this->config()->layout->skin)) {
            $class[]=$this->config()->layout->skin;
        } else {
            $class[]='skin-black';
        }
        */

        /*
        if (isset($this->config()->layout->fixed)) {
            $class[]='fixed';
        }
        */

        /*
        if (isset($this->config()->layout->{'sidebar-collapse'})) {
            if ($this->config()->layout->{'sidebar-collapse'}) {
                $class[]='sidebar-collapse';
            }
        }
        */
        /*
        if (isset($this->config()->layout->{'layout-boxed'})) {
            $class[]='layout-boxed';
        }
        */


        $htm="\n<body class='".implode(" ", $class)."'>\n";
        $htm.='<div class="wrapper">'."\n";
        return $htm;
    }


    /**
     * header
     * this is NOT the html header, but the ADMIN header (top bar)
     * @return [type] [description]
     */
    public function header()
    {
        $htm='';

        if (isset($this->config->title)) {
            $title=$this->config->title;
        }

        if (isset($this->config->homeurl)) {
            $homeurl=$this->path.$this->config->homeurl;
        } else {
            $homeurl='#';
        }

        $htm.=$this->topNav();

        return $htm;
    }






    private $user=[];

    public function user($USR = [])
    {
        $this->user=$USR;
    }


    /**
     * Top navigation thing
     * @return [type] [description]
     */
    /*
    private function topNav()
    {

        if (isset($this->config->homeurl)) {
            $homeurl=$this->path.$this->config->homeurl;
        } else {
            $homeurl='#';
        }

        $htm='<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">';

        if(isset($this->config()->title)){
            $htm.='<a class="navbar-brand" href="'.$homeurl.'">'.$this->config()->title.'</a>';
        }else{
            $htm.='<a class="navbar-brand" href="'.$homeurl.'">LTETurbo</a>';
        }

          //<!--nav-link navbar-toggler sidebar-toggle-->
        $htm.='<button class="nav-link navbar-toggler sidebar-toggle" data-toggle="offcanvas" style="display:inline">';
        $htm.='    <span class="navbar-toggler-icon"></span>';
        $htm.='</button>';


        $htm.='<div class="collapse navbar-collapse" id="navbarsExampleDefault">';

        $htm.='<ul class="navbar-nav mr-auto">';
        $htm.='<li class="nav-item">';
        if ($this->user) {
            $htm.='<a class="nav-link disabled" href="#">'.$this->user['email'].'</a>';
        }
        $htm.='</li>';

        $htm.='</ul>';

        $htm.='<ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">';

        $htm.='</ul>';

        $htm.='</div>';
        $htm.='</nav>';
        return $htm;
    }
    */



    /**
     * Set top navbar html
     * Usefull for user messages
     * @param  string $htm [description]
     * @return [type]      [description]
     */
    /*
    public function navbarCustomMenu($htm = '')
    {
        if ($htm&&is_array($htm)) {
            $htm=implode('', $htm);
        }

        if ($htm) {
            $this->navbarCustomMenu=$htm;
        }
        return $this->navbarCustomMenu;
    }
    */


    /**
     * Get/Set the menu user panel (first thing to appear in the left menu)
     * @param  string $htm [description]
     * @return [type]      [description]
     */
    /*
    public function userPanel($htm = '')
    {

        if ($htm&&is_array($htm)) {
            $htm=implode('', $htm);
        }

        if ($htm) {
            $this->userPanel=$htm;
        }

        return $this->userPanel;
    }
    */



    /**
     * left side (old)
     */
    public function leftside()
    {

        $htm='<div class="wrapper row-offcanvas row-offcanvas-left">';
        //$htm.='<aside class="left-side sidebar-offcanvas">';//old
        $htm.='<aside class="main-sidebar">';//new
        // sidebar: style can be found in sidebar.less -->
        $htm.='<section class="sidebar">';

        // Sidebar user panel -->
        $htm.=$this->userPanel();


        // search field /
        if (isset($this->config->menusearch) && $this->config->menusearch) {
            $htm.='<div class="sidebar-form input-group">';
            $htm.='<input type="text" id="q" name="q" class="form-control" placeholder="Search ...">';
            $htm.='<span class="input-group-btn">';
            $htm.='<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>';
            $htm.='</span>';
            $htm.='</div>';
        }

        // sidebar menu: : style can be found in sidebar.less -->
        //$htm.= $this->menu();
        $htm.= $this->menu();

        $htm.='</section>';
        $htm.='</aside>';
        return $htm;
    }




    /**
    * @brief the list of js scripts to be included
    * @returns html
    */
    public function scripts()
    {
        //echo "<li>scripts()<br />";
        if (!isset($this->config->js)) {
            return '';
        }

        $htm='';
        foreach ($this->config->js as $k => $js) {
            if (preg_match("/^http/", $js)) {
                $htm.='<script src="' . $js . '" type="text/javascript"></script>'."\n";
            } else {
                $htm.='<script src="' . $this->path . $js . '" type="text/javascript"></script>'."\n";
            }
        }
        return $htm;
    }





    /**
     * Define footer. The footer is displayed only when "end()" is called
     * @param  string $body [description]
     * @return [type]       [description]
     */
    public function footer()
    {

        //print_r($this->config()->footer);exit;

        $htm='<footer class="main-footer">';
            $htm.='<div class="float-right d-none d-sm-block">';
                $htm.='<b>Version</b> 3.0.0-alpha';
            $htm.='</div>';
            $htm.='<strong>Powered by <a href="https://jambonbill.org">Jambonbill</a> LTETurbo</strong>';
        $htm.='</footer>';

        return $htm;

        /*
        if ($htm) {
            $this->footer=$htm;
        }
        return $this->footer;
        */
    }

    /**
     * `Properly` finish the html document and end the script
     * @return [type] [description]
     */
    public function end()
    {
        $htm='';// end aside class="right-side"
        $htm.=$this->footer();

        $htm.='</div>';
        $htm.='</body>';
        $htm.='</html>';
        exit($htm);
    }
}
