<?php
/**
 * Php class for quick integration of AdminLTE2
 * @author Jambonbill <jambonbill@gmail.com>
 */

namespace LTE;

/**
* @brief Class providing adminlte2 skeleton
*/
class Admin
{

    /**
     * Static path to assets
     */
    private $_path='../';// static path

    /**
     * Path to json config file
     */
    private $_config_file='';

    /**
     * Config object
     */
    private $_config=[];

    /**
     * Menu object
     */
    private $_menu=[];

    private $_headHtml= '';//?

    private $_lang= 'en';

    //private $navbarCustomMenu='';//html

    /**
     * The string to match against the menu, to highlight menu item
     */
    private $_menuMatch='';

    //private $userPanel='';//html


    /**
     * DEBUG mode (spit vars on screen)
     *
     * @var boolean
     */
    //public $DEBUG=false;


    /**
     * AdminLte Constructor
     * @param boolean $private [description]
     */
    public function __construct($configfile='')
    {
        // get the config file. it must be located next to the class

        if ($configfile) {
            if (is_file($configfile)) {
                $this->_config_file=$configfile;
            } else {
                throw new \Exception("Error : config file '$configfile' not found", 1);
            }
        } elseif (isset($_SESSION['lteconfig'])) {
            $this->config_file=$_SESSION['lteconfig'];
        }

        if ($this->_config_file) {
            $this->configLoad($this->_config_file);
        }

        $dirname=pathinfo($_SERVER['SCRIPT_FILENAME'])['dirname'];
        if (preg_match("/\b\/([a-z-0-9]+)$/i", $dirname, $o)) {
            $this->_menuMatch=$o[1];
            //exit($this->_menuMatch);
        }

    }


    /**
     * Register path to configfile
     *
     * @param string $filename [description]
     *
     * @return [type]           [description]
     */
    public function configfile($filename='')
    {
        //echo __FUNCTION__."($filename)";exit;
        if (is_file($filename)) {

            //make sure it decode well
            $string = file_get_contents($filename);
            $this->_config=json_decode($string);
            $err=json_last_error();

            if ($err) {
                throw new Exception("Error decoding json from $filename", 1);
            } else {
                //exit("yes sir");
            }
            //register to sessions
            $this->_config_file=$filename;
            $_SESSION['lteconfig']=$this->_config_file;
            //exit('_SESSION[lteconfig]='.$this->config_file);

            $this->configLoad($this->_config_file);
        } elseif ($filename) {
            throw new \Exception("$filename not found", 1);

        }

        return $this->_config_file;
    }


    /**
     * Load and decode config file
     *
     * @param  string $filename [description]
     *
     * @return [type]           [description]
     */
    public function configLoad($filename = '')
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

        if (isset($this->config->description)) {
            $this->description($this->config->description);
        }

        if (isset($this->config->meta)) {//decode meta//
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
     *
     * @param array  $config [description]
     *
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
     *
     * @return [type] [description]
     */
    public function lang()
    {
        return $this->_lang;
    }


    /**
     * Get/Set document title
     *
     * @param  string $title [description]
     *
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
     *
     * @param  string $title [description]
     *
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



    /**
     * Return the html blob
     *
     * @return string [description]
     */
    public function __toString()
    {
        return $this->html();
        //return $this->LTE3();//lte3
    }



    /**
     * LTE3 Version 2019
     *
     * @return string [html]
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
     * Return navbar (top navbar)
     *
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
        $htm.='<form class="form-inline ml-3" action="../search/" method="get">';
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
        if (isset($this->config()->title)) {
            $htm.='<a href="#" class="brand-link"><span class="brand-text font-weight-light">'.$this->config()->title.'</span></a>';
        }


        //<!-- Sidebar -->
        $htm.='<div class="sidebar">'."\n";

            //<!-- Sidebar user panel (optional) -->
            /*
            $htm.='<div class="user-panel mt-3 pb-3 mb-3 d-flex">';
                $htm.='<div class="image"><img src="../dist/img/user2-128x128.jpg" class="img-circle elevation-2" alt="User Image"></div>';
                $htm.='<div class="info"><a href="#" class="d-block">Jambon Bill</a></div>';
            $htm.='</div>';
            */


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
     *
     * @param [type] $json [description]
     *
     * @return [type]       [description]
     */
    private function menuDecode($json)
    {

        if (!isset($this->config()->menu)) {
            //throw new \Exception("Error : $this->config->menu must be a object", 1);
            return '';
        } else {
            $menu=$this->config()->menu;
        }

        if (!is_object($this->config->menu)) {

            $DIR=dirname(realpath($this->_config_file));//get config folder

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
    public function menu()
    {
        return $this->config->menu;
    }








    /**
     * Define matching string for menu selection
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function menuHighlight($str='')
    {
        $this->_menuMatch=$str;
        return $this->_menuMatch;
    }


    /**
     * Return left menu
     *
     * @return string html
     */
    public function menuHTML($json = '')
    {
        //echo '<pre>';print_r($_SERVER);exit;
        $this->menuDecode($json);


        //exit($this->_menuMatch);

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

                $sub='';
                $active='';
                $open='';
                foreach ($o->sub as $obj) {
                    $active='';
                    $sub.='<li class="nav-item">';

                    if (isset($obj->url)) {
                        if (strpos($obj->url, $this->_menuMatch)!==false) {
                            $active='active';
                            $open='menu-open';
                        }
                        $sub.='<a class="nav-link '.$active.'" href="'.$this->path.$obj->url.'">';
                    }

                    if (isset($obj->icon)) {
                        $sub.="<i class='nav-icon ".$obj->icon."'></i> ";
                    }

                    $sub.='<p>'.$obj->text.'</p></a>';
                    $sub.='</li>';
                }

                $htm.='<li class="nav-item has-treeview '.$open.'" '.$title.'>';

                if (!isset($o->icon)) {
                    $o->icon='';
                }

                if ($open) {
                    $active='active';
                }

                $htm.='<a href="'.@$o->url.'" class="nav-link '.$active.'">';
                $htm.='<i class="nav-icon '.$o->icon.'"></i>';
                //$htm.=' <span>'.$o->text.'</span>';
                $htm.='<p>'.$o->text;
                $htm.='<i class="fa fa-angle-left right"></i>';
                $htm.='</p>';
                $htm.='</a>';
                $htm.='<ul class="nav nav-treeview">';

                //SUB HERE
                $htm.=$sub;

                $htm.='</ul>';
                $htm.='</li>';

            } else {

                //match active
                $active='';
                if (strpos($o->url, $this->_menuMatch)!==false) {
                    $active='active';
                }

                $htm.='<li class="nav-item" '.$title.'>';

                if (isset($o->url)) {
                    $htm.='<a class="nav-link '.$active.'" href="'.$this->path.$o->url.'">';
                }

                if (isset($o->icon)) {
                    $htm.='<i class="nav-icon '.$o->icon.'"></i> ';
                }

                $htm.='<p>'.@$o->text.'</p>';

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

    /**
     * Define twitter title
     *
     * @param string $title [description]
     *
     * @return [type]        [description]
     */
    public function twitterTitle($title='Jambonbill LTETurbo')
    {
        $this->addMeta(['name'=>"twitter:title",   'content'=>$title]);
    }


    /**
     * Define twittercard type
     *
     * @param  string $type [description]
     *
     * @return [type]       [description]
     */
    public function twitterCard($type='summary')
    {
        $this->addMeta(['name'=>"twitter:card",   'content'=>$type]);
    }


    /**
     * Define twitter site
     *
     * @param  string $str [description]
     *
     * @return [type]      [description]
     */
    public function twitterSite($str='@jambonbill')
    {
        $this->addMeta(['name'=>"twitter:site",   'content'=>$str]);
    }


    /**
     * Set twitter description
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function twitterDescription($str='description')
    {
        $this->addMeta(['name'=>"twitter:description",   'content'=>$str]);
    }

    /**
     * Set twitter image
     *
     * @param string $url [description]
     *
     * @return [type]      [description]
     */
    public function twitterImage($url='')
    {
        $this->addMeta(['name'=>"twitter:image",   'content'=>$url]);
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

        if (!isset($this->config->meta)) {
            $this->config->meta=[];
        }

        if (!is_array($this->config->meta)) {
            $this->config->meta=[];
        }

        $key=false;

        if (isset($newmeta['name'])) {
            $key=$newmeta['name'];
        }

        if (isset($newmeta['property'])) {
            $key=$newmeta['property'];
        }

        $meta=[];
        $replace=false;
        foreach ($this->config->meta as $k=>$metar) {
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

        $this->config->meta=$meta;
        return true;
    }


    /**
     * Bring the headers, and initial assets
     *
     * @return [type] [description]
     */
    public function head()
    {
        $htm='<!DOCTYPE html>'."\n";
        $htm.='<html lang="' . $this->lang() . '">'."\n";
        $htm.='<head>'."\n";
        $htm.='<meta charset="UTF-8">'."\n";

        if (isset($this->config->title)) {
            $htm.='<title>' . strip_tags($this->config->title) . '</title>'."\n";
        }

        if (isset($this->config->apple_app_icon)) {
            $htm.= '<link rel="apple-touch-icon" href="' . $this->path . $this->config->apple_app_icon . '">';
        }

        $htm.= "<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>\n";
        $htm.='<meta name="apple-mobile-web-app-status-bar-style" content="black" />'."\n";
        $htm.='<meta name="apple-mobile-web-app-capable" content="yes" />'."\n";


        //echo "<pre>";var_dump($this->config);exit;

        if (isset($this->config->meta)) {

            if (is_array($this->config->meta)) {
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
        if ($this->_headHtml) {
            $htm.=$this->_headHtml;
        }

        //Scripts goes here
        $htm.=$this->scripts();

        $htm.="</head>";

        return $htm;
    }


    /**
     * Get/Set extra html to <head> (apple links, tracking code, etc)
     *
     * @return [type] [description]
     */
    public function headHtml($htm = '')
    {
        $this->headHtml=$htm;
        return $this->headHtml;
    }


    /**
     * Bring the headers, and initial assets
     *
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
     * This is NOT the html header, but the ADMIN header (top bar)
     *
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





    /**
     * The list of js scripts to be included
     *
     * @return html
     */
    public function scripts()
    {

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
     *
     * @param string $body [description]
     *
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
     *
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
