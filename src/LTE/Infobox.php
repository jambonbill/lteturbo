<?php

namespace LTE;

/**
 * AdminLte Infobox TODO
 * http://almsaeedstudio.com/AdminLTE/pages/widgets.html
 */
class Infobox
{
    private $id='';
    private $type='';//danger, success, info, warning, etc
    private $bg='';//danger, success, info, warning, etc

    private $icon='';
    //private $iconUrl='';
    private $color='';
    private $class='';
    private $style='';
    //private $title='';
    private $small='';//

    private $progress=null;//%
    private $progress_description='';// 70% Increase in 30 Days

    private $text='';
    private $number='';

    //private $collapsable=false;
    //private $collapsed=false;
    //private $removable=false;
    //private $loading=false;

    public function __construct()
    {
        $this->id = md5(rand(0, time()));
    }

    /**
     * Box types : default|primary|danger|success|warning
     * @param  string $type [description]
     * @return [type]       [description]
     */
    public function type($type = '')
    {
        if ($type) {
            $this->type=$type;
        }
        return $this->type;
    }


    /**
     * Info box bg type -- <div class="info-box bg-{type}">
     * @param  string $type [description]
     * @return [type]       [description]
     */
    public function bg($type='')
    {
        if ($type) {
            $this->bg=$type;
        }
        return $this->bg;

    }


    /**
     * Infobox icon class. Use font awesome names, ex: 'fa fa-user'
     * @param  string $classname [description]
     * @return [type]            [description]
     */
    public function icon($classname = '')
    {
        if ($classname) {
            $this->icon=$classname;
        }
        return $this->icon;
    }

    /**
     * A target link on the icon
     * @param  string $url [description]
     * @return [type]      [description]
     */
    /*
    public function iconUrl($url = '')
    {
        if ($url) {
            $this->iconUrl=$url;
        }
        return $this->iconUrl;
    }
    */

    /**
     * Color Used for the 'tiles'
     * @param  string $color [description]
     * @return [type]        [description]
     */
    public function color($color = '')
    {
        if ($color) {
            $this->color=$color;
        }
        return $this->color;
    }

    /**
     * The card id (html property)
     * @param  string $id [description]
     * @return [type]     [description]
     */
    public function id($id = '')
    {
        if ($id) {
            $this->id=$id;
        }
        return $this->id;
    }

    /**
     * Box text
     * @param  string $body [description]
     * @return [type]       [description]
     */
    public function text($str = '')
    {
        if ($str) {
          $this->text=$str;
        }
        return $this->text;
    }


    public function number($str = '')
    {
        if ($str) {
          $this->number=$str;
        }
        return $this->number;
    }

    public function progress($n=0)
    {
        if ($n) {
          $this->progress=$n;
        }
        return $this->progress;
    }

    public function progress_description($str = '')
    {
        if ($str) {
          $this->progress_description=$str;
        }
        return $this->progress_description;
    }





    /**
     * When set to true, the box show a overlay and a loading image
     * You can hide it with $('#boxid .overlay, #boxid.loading-img').hide()
     * @param  boolean $loading [description]
     * @return boolean
     */
    /*
    public function loading($loading = false)
    {
        if ($loading) {
            $this->loading=$loading;
        }
        return $this->loading;
    }
    */




    /**
     * Add a top-right "x" button that allow box desctruction
     * @param  boolean $removable [description]
     * @return [type]             [description]
     */
    /*
    public function removable($removable = false)
    {
        if ($removable) {
            $this->removable=$removable;
        }
        return $this->removable;
    }
    */

    public function addClass($str = '')
    {
        if ($str) {
            $this->class=$str;
        }
        return $this->class;
    }

    public function style($style = '')
    {
        if ($style) {
            $this->style=$style;
        }
        return $this->style;
    }

    /**
     * Return the LTE Box as html
     * @return [type] [description]
     */
    public function html($text = '', $number = '')
    {

        if ($text) {
            $this->text($text);
        }

        if ($number) {
            $this->number($number);
        }


        $STYLE='';
        if ($this->style()) {
            $STYLE="style='".$this->style()."'";
        }


        $class=[];
        $class[]='info-box';
        //$class[]='card-'.$this->type();

        if($this->bg()){
            $class[]='bg-'.$this->bg();
        }

        if ($this->addClass()) {
            $class[]=$this->addClass();
        }

        $htm='<div class="'.implode(" ", $class).'" '.$STYLE.' id="'.$this->id().'">';// box-solid

        //Icon
        if($this->type()){
            //exit($this->type());
            $htm.='<span class="info-box-icon bg-'.$this->type().'"><i class="'.$this->icon().'"></i></span>';//bg-warning
        }else{
            $htm.='<span class="info-box-icon"><i class="'.$this->icon().'"></i></span>';//bg-warning
        }


        // body
        $class=$style=[];
        $class[]='info-box-content';

        $htm.="<div class='".implode(' ', $class)."' style='".implode('', $style)."'>";

        $htm.='<span class="info-box-text">'.$this->text().'</span>';
        $htm.='<span class="info-box-number">'.$this->number().'</span>';

        if($this->progress()){
            $htm.='<div class="progress"><div class="progress-bar" style="width: '.$this->progress().'%"></div></div>';
        }


        if($this->progress_description()){
            $htm.='<span class="progress-description">'.$this->progress_description().'</span>';
        }


        $htm.='</div>';// content end

        /*
        if ($this->loading()) {
            $htm.='<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>';
        } else {
            $htm.='<div class="overlay" style="display:none"><i class="fa fa-refresh fa-spin"></i></div>';
        }
        */

        $htm.='</div>';// end.box

        return $htm;
    }

    public function __toString()
    {
        return $this->html();
    }
}
