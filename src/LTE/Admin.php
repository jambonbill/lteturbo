<?php
/**
 * Php class for quick integration of AdminLTE2
 * PHP version 7
 *
 * @category LTE
 * @package  LTEturbo
 * @author   jambonbill <jambonbill@gmail.com>
 * @license  https://github.com/jambonbill  Jambon License 1.01
 * @link     https://github.com/jambonbill
 */

namespace LTE;

//use LTE\Modal;
use LTE\Config;
use Exception;

/**
 * Class providing adminlte3 skeleton
 * https://adminlte.io/themes/dev/AdminLTE/index3.html
 * PHP version 7
 *
 * @category LTE
 * @package  LTEturbo
 * @author   jambonbill <jambonbill@gmail.com>
 * @license  https://github.com/jambonbill  Jambon License 1.01
 * @link     https://github.com/jambonbill
 */
class Admin
{

    private static $_instance;//make sure we have only one instance

    private $_version='1.5.0';//Config object

    /**
     * LTE Config object
     */
    private $_config=null;

    /**
     * Menu object
     */
    private $_menu=[];

    private $_headHtml= '';//?

    private $_lang= 'en';


    /**
     * The string to match against the menu, to highlight menu item
     */
    private $_menuMatch='';



    /**
     * Get a value from _SESSION[key]
     * key should look as : '{key}'
     *
     * @param  string $key [description]
     * @return [type]      [description]
     */
    public function keyValue($key='')
    {

        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return false;
    }



    /**
     * AdminLte Constructor
     *
     * @param string $configfile [description]
     */
    public function __construct($configfile='')
    {
        $this->_config=new Config($configfile);

        $dirname=pathinfo($_SERVER['SCRIPT_FILENAME'])['dirname'];

        // get the current 'view' to allow menu item selection
        if (preg_match("/\b\/([a-z-0-9_-]+)$/i", $dirname, $o)) {
            $this->_menuMatch=$o[1];
        }

        if (self::$_instance) {
            throw new Exception("Admin instance already initialised", 1);
        }

        self::$_instance = $this; // initialise the instance on load
    }


    /**
     * Return config object
     *
     * @return [type]           [description]
     */

    public function config()
    {
        return $this->_config;
    }



    /**
     * Return detected language
     *
     * @return [type] [description]
     */
    public function lang(): string
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
    /*
    public function title($title = '')
    {
        if ($title) {
            $this->config->title=$title;
        }

        return $this->config->title;
    }
    */

    /**
     * Get/Set document description
     *
     * @param  string $title [description]
     *
     * @return [type]        [description]
     */
    /*
    public function description(string $str)
    {
        if ($str) {
            $this->config->description=trim($str);
            $this->addMeta(['name'=>'description','content'=>$str]);
        }

        return false;
    }
    */


    /**
     * Return the html blob
     *
     * @return string [description]
     */
    public function __toString()
    {
        return $this->html();
    }



    /**
     * LTE3 Version 2020
     *
     * @return string [html]
     */
    public function html()
    {

        $htm=$this->head();
        $htm.=$this->body();
        //$htm.=$this->header3();//(navbar)
        $htm.=$this->_navbar();//(navbar)
        $htm.=$this->_sidebar();//left menu

        //$htm.='<aside class="right-side">';
        return $htm;
    }



    /**
     * Get/Set navbar
     * @param  [type] $navbar [description]
     * @return [type]         [description]
     */
    public function navbar($nbo='')
    {
        if ($nbo) {
            $this->config->navbar=$nbo;
        }
        return $this->config->navbar;
    }


    /**
     * Return top navbar html
     *
     * @return [type] [description]
     */
    private function _navbar()
    {

        $navbar=$this->_config->navbar();

        if (!isset($navbar)) {
            return '';
        }

        //<!-- Navbar -->
        $htm='<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">';

        $htm.='<ul class="navbar-nav">';
        $htm.='<li class="nav-item">';
        $htm.='<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>';
        $htm.='</li>';

        // Links //
        $links=[];

        if (isset($navbar->links)) {
            $links=$navbar->links;
        }

        foreach ($links as $link) {

            $url='#';
            $target='';

            if (isset($link->url)) {
                $url=$link->url;
            }

            if (isset($link->target)) {
                //todo
            }

            $htm.='<li class="nav-item d-none d-sm-inline-block">';
            $htm.='<a href="'.$url.'" class="nav-link">';

            if (isset($link->icon)) {
                $htm.='<i class="'.$link->icon.'"></i> ';
            }

            $htm.=$link->text;
            $htm.='</a></li>';
        }


        $htm.='</ul>';

        if (isset($navbar->search)&&$navbar->search) {
            //<!-- SEARCH FORM -->
            $htm.='<form class="form-inline ml-3" action="../search/" method="get">';
            $htm.='<div class="input-group input-group-sm">';
                $htm.='<input class="form-control form-control-navbar" name=q type="search" placeholder="Search" aria-label="Search" autocomplete="off">';
                $htm.='<div class="input-group-append">';
                    $htm.='<button class="btn btn-navbar" type="submit"><i class="fa fa-search"></i></button>';
                $htm.='</div>';
            $htm.='</div>';
            $htm.='</form>';
        }

        //<!-- Right navbar links -->
        $htm.='<ul class="navbar-nav ml-auto">';

        $items=[];

        if (isset($navbar->items)) {
            $items=$navbar->items;
        }

        foreach ($items as $item) {
            //print_r($item);exit;

            $title='';

            if ($item->title) {
                $title=$item->title;
            }

            $htm.='<li class="nav-item" title="'.$title.'">';

                $htm.='<a class="nav-link" href="'.$item->url.'">';

                if (isset($item->icon)) {
                    $htm.='<i class="'.$item->icon.'"></i> ';
                }

                $htm.=htmlentities($item->text);
                $htm.='</a>';
            $htm.='</li>';
        }

        /*
        //<!-- Control sidebar -->
        $htm.='<li class="nav-item">';
        $htm.='<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fa fa-th-large"></i></a>';
        $htm.='</li>';
        */
        /*
        $htm.='<li class="nav-item" title="User">';
        $htm.='<a class="nav-link" href="#">email@domain.com</a>';
        $htm.='</li>';
        */
        /*
        $htm.='<li class="nav-item" title="Sign out">';
        $htm.='<a class="nav-link" href="#"><i class="fa fa-sign-out"></i> Sign out</a>';
        $htm.='</li>';
        */

        $htm.='</ul>';

        $htm.='</nav>';
        $htm.="\n";

        // replace keys
        preg_match_all("/{[a-z]+}/", $htm, $o);
        foreach ($o[0] as $key) {
            //replace those keys
            if ($val=$this->keyValue($key)) {
                $htm=str_replace($key, htmlentities($val), $htm);
            }
        }

        return $htm;
    }


    /**
     * LTE3 Sidebar (left menu)
     * @return [type] [description]
     */
    private function _sidebar()
    {
        $htm="<!-- Main Sidebar Container -->\n";
        $htm.='<aside class="main-sidebar sidebar-dark-primary elevation-4">';

        //<!-- Brand Logo -->
        $htm.='<a href="#" class="brand-link">';
        /*
        if (isset($this->config()->{'title-mini'})) {
            $htm.='<span class="logo-mini">'.$this->config()->{'title-mini'}.'</span>';
        }
        */
        $htm.='<span class="brand-text font-weight-light">'.$this->_config->title().'</span>';
        $htm.='</a>';


        //<!-- Sidebar -->
        $htm.='<div class="sidebar">'."\n";

        $htm.='<nav class="mt-2">';
        $htm.=$this->menuHTML()."\n";
        $htm.='</nav>';

        $htm.='</div>'."\n";

        $htm.='</aside>'."\n";

        // replace keys
        preg_match_all("/{[a-z]+}/", $htm, $o);

        foreach ($o[0] as $key) {
            //try to replace those keys
            if ($val=$this->keyValue($key)) {
                $htm=str_replace($key, htmlentities($val), $htm);
            }
        }

        return $htm;
    }



    /**
     * Return menu for inspection/manipulation
     *
     * @return [type] [description]
     */
    public function menu()
    {
        return $this->config->menu;
    }



    /**
     * Return left menu
     *
     * @return string html
     */
    public function menuHTML()
    {
        //echo '<pre>';print_r($_SERVER);exit;
        //$this->menuDecode($json);

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

        foreach ($this->_config->menu() as $name => $o) {

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
                    $sub.='<li class="nav-item" style="padding-left:16px">';

                    if (isset($obj->match)&&$obj->match&&$this->_menuMatch) {
                        if (preg_match("/".$obj->match."/", $this->_menuMatch)) {
                            $active='active';
                            $open='menu-open';
                        }
                    }

                    if (isset($obj->url)) {
                        if ($this->_menuMatch&&strpos($obj->url, $this->_menuMatch)!==false) {
                            $active='active';
                            $open='menu-open';
                        }
                        $sub.='<a class="nav-link '.$active.'" href="'.$obj->url.'">';
                    }

                    if (isset($obj->icon)) {
                        $sub.="<i class='nav-icon ".$obj->icon."'></i> ";
                    }

                    $sub.='<p>'.$obj->text;
                    // Badge
                    if (isset($o->badge)&&$o->badge->text) {// Badge
                        $style='info';
                        if ($o->badge->style) {
                            $style=$o->badge->style;
                        }
                        $sub.='<span class="right badge badge-'.$style.'">'.$o->badge->text.'</span>';
                    }

                    $sub.='</p></a>';

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

                $htm.=$sub;//SUB HERE

                $htm.='</ul>';
                $htm.='</li>';

            } else {

                // match active
                $active='';

                if (isset($o->match)&&$o->match&&$this->_menuMatch) {
                    if (preg_match("/".$o->match."/", $this->_menuMatch)) {
                        $active='active';
                    }
                }


                $htm.='<li class="nav-item" '.$title.'>';

                if (isset($o->url)) {
                    if ($this->_menuMatch&&strpos($o->url, $this->_menuMatch)!==false) {
                        $active='active';
                    }
                    $htm.='<a class="nav-link '.$active.'" href="'.$o->url.'">';
                }

                if (isset($o->icon)) {
                    $htm.='<i class="nav-icon '.$o->icon.'"></i> ';
                }

                $htm.='<p>'.@$o->text;

                if (isset($o->badge)&&$o->badge->text) {// Badge
                    $style='info';
                    if ($o->badge->style) {
                        $style=$o->badge->style;
                    }
                    $htm.='<span class="right badge badge-'.$style.'">'.htmlentities($o->badge->text).'</span>';
                }

                $htm.='</p>';

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
     *
     * @return [type] [description]
     */
    /*
    public function meta($meta=null)
    {
        return $this->config->meta;
    }
    */

    // opengraph methods, its crap, must improve //

    /**
     * Set opengraph URL
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function ogUrl($str='')
    {
        $this->config()->addMeta(['property'=>'og:url',      'content'=>$str]);
    }


    /**
     * Set opengraph Type
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function ogType($str='')
    {
        $this->config()->addMeta(['property'=>"og:type",     'content'=>$str]);
    }


    /**
     * Set opengraph Title
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function ogTitle($str='')
    {
        $this->config()->addMeta(['property'=>"og:title",    'content'=>$str]);
    }


    /**
     * Set opengraph Description
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function ogDescription($str='')
    {
        $this->config()->addMeta(['property'=>"og:description", 'content'=>$str]);
    }


    /**
     * Set opengraph Image URL
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function ogImage($str='')
    {
        $this->config()->addMeta(['property'=>"og:image",    'content'=>$str]);
    }



    /**
     * Set opengraph Locale
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function ogLocale($str='')
    {
        $this->config()->addMeta(['property'=>"og:locale",   'content'=>$str]);
    }



    /**
     * Define twitter title
     *
     * @param string $title [description]
     *
     * @return [type]        [description]
     */
    public function twitterTitle($title='Jambonbill LTETurbo')
    {
        $this->config()->addMeta(['name'=>"twitter:title",   'content'=>$title]);
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
        $this->config()->addMeta(['name'=>"twitter:card",   'content'=>$type]);
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
        $this->config()->addMeta(['name'=>"twitter:site",   'content'=>$str]);
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
        $this->config()->addMeta(['name'=>"twitter:description",   'content'=>$str]);
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
        $this->config()->addMeta(['name'=>"twitter:image",   'content'=>$url]);
    }





    /**
     * Bring the headers, and initial assets
     *
     * @return [type] [description]
     */
    public function head()
    {
        $htm ='<!DOCTYPE html>'."\n";
        $htm.='<html lang="' . $this->lang() . '">'."\n";
        $htm.='<head>'."\n";
        $htm.='<meta charset="UTF-8">'."\n";

        if (isset($this->config->title)) {
            $htm.='<title>' . strip_tags($this->config->title) . '</title>'."\n";
        }

        //$htm.='<base href="/web">'."\n";

        if (isset($this->config->apple_app_icon)) {
            $htm.= '<link rel="apple-touch-icon" href="' . $this->config->apple_app_icon . '">';
        }

        $htm.="<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>\n";
        $htm.='<meta name="apple-mobile-web-app-status-bar-style" content="black" />'."\n";
        $htm.='<meta name="apple-mobile-web-app-capable" content="yes" />'."\n";

        //$appName='LTETurbo Ver.'.$this->_version;

        //if ($this->config->('application-name')) {
        //    $appName=$this->_config->application-name;
        //}

        //$htm.='<meta name="application-name" content="'.$appName.'">'."\n";

        foreach ($this->_config->meta() as $meta) {
            $values=[];
            foreach ($meta as $k => $v) {
                $values[]=$k.'="'.$v.'"';
            }
            $htm.="<meta ".implode(' ', $values).">\n";
        }

        if (isset($this->_config->favicon) && is_file($this->config->favicon)) {
            $htm.='<link id="favicon" rel="shortcut icon" href="'.$this->config->favicon.'">';
        } else {
            //define 'no favicon'
            $htm.='<link rel="shortcut icon" href="#" />';
            $htm.="\n";
        }

        //more link
        if (isset($this->config->link)) {
            foreach ($this->config->link as $v) {
                $props=[];
                foreach ((array)$v as $prop=>$value) {
                    $props[]=$prop.'="'.$value.'"';
                }
                $htm.='<link '.implode(' ', $props).' />'."\n";
            }
        }

        // Css
        foreach ($this->_config->css() as $v) {
            $htm.='<link href="'.htmlentities($v).'" rel="stylesheet" type="text/css" />';
            $htm.="\n";
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
            $homeurl=$this->config->homeurl;
        } else {
            $homeurl='#';
        }

        $htm.=$this->topNav();

        return $htm;
    }





    /**
     * The list of scripts to be included
     *
     * @return html
     */
    public function scripts()
    {
        /*
        $js=$this->_config->js();

        if (!isset($js)) {
            return '';
        }
        */

        $htm='';
        foreach ($this->_config->js() as $k => $js) {
            $htm.='<script src="'.htmlentities($js).'" type="text/javascript"></script>'."\n";
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

        // auto require modal's ? now is the time
        $footer=$this->_config->prop('footer');

        if (!$footer) {
            return false;
        }

        $htm='<footer class="main-footer">';

        if (isset($footer->right)) {
            $htm.='<div class="float-right d-none d-sm-block">';
            $htm.=$footer->right;
            $htm.='</div>';
        }

        if ($footer->left) {
            $htm.=$footer->left;
        }

        $htm.='</footer>';

        return $htm;

    }


    /**
     * Build modals
     * @return [type] [description]
     */
    /*
    public function automodal()
    {
        $files=glob("modal*.json");

        foreach ($files as $file)  {

            $jso=$this->jso($file);
            //print_r($jso);
            $modal=new Modal();

            if (isset($jso->id)) {
                $modal->id($jso->id);
            }

            if (isset($jso->type)) {
                $modal->type($jso->type);
            }

            if (isset($jso->icon)) {
                $modal->icon($jso->icon);
            }

            $modal->title($jso->title);
            $modal->body($jso->body);
            $modal->footer($jso->footer);

            if (isset($jso->size)) {
                $modal->size($jso->size);
            }

            echo $modal;
        }
    }
    */

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

        //$this->automodal();

        $htm.='</body>';
        $htm.='</html>';
        exit($htm);
    }
}
