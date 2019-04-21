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

/**
 * AdminLte Card
 * http://almsaeedstudio.com/AdminLTE/pages/widgets.html
 * PHP version 7
 *
 * @category LTE
 * @package  LTEturbo
 * @author   jambonbill <jambonbill@gmail.com>
 * @license  https://github.com/jambonbill  Jambon License 1.01
 * @link     https://github.com/jambonbill
 */
class Card
{
    private $id='';
    private $type='solid';
    private $icon='';
    private $iconUrl='';
    private $color='';
    private $class='';
    private $p0=false;//no padding
    private $style='';
    private $title='';
    private $small='';//
    private $tools='';//(mini top tray on the right)

    private $body='';
    //private $body_padding=true;//box-body no-padding
    private $footer='';
    private $collapsable=false;
    private $collapsed=false;
    private $removable=false;
    private $loading=false;


    public function __construct()
    {
        $this->id = md5(rand(0, time()));
    }

    /**
     * Box types : default|primary|danger|success|warning
     *
     * @param  string $type [description]
     *
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
     * The card title
     *
     * @param  string $title [description]
     *
     * @return [type]        [description]
     */
    public function title($title = '')
    {
        if ($title) {
            $this->title=$title;
        }
        return $this->title;
    }


    public function tools($htm = '')
    {
        if ($htm) {
            $this->tools=$htm;
        }
        return $this->tools;
    }


    /**
     * The 'small' title
     *
     * @param  string $title [description]
     *
     * @return [type]        [description]
     */
    public function small($str = '')
    {
        if ($str) {
            $this->small=$str;
        }
        return $this->small;
    }

    /**
     * Card icon class. Use font awesome names, ex: 'fa fa-user'
     * You can pass multiple icons in a array, ex: ['fa fa-user','fa fa-file']
     *
     * @param  string $classname [description]
     *
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
     *
     * @param  string $url [description]
     *
     * @return [type]      [description]
     */
    public function iconUrl($url = '')
    {
        if ($url) {
            $this->iconUrl=$url;
        }
        return $this->iconUrl;
    }

    /**
     * Color Used for the 'tiles'
     *
     * @param  string $color [description]
     *
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
     *
     * @param  string $id [description]
     *
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
     * Card html body
     *
     * @param  string $body [description]
     *
     * @return [type]       [description]
     */
    public function body($body = '')
    {
        if (is_array($body)) {
            $this->body=implode('', $body);
        } elseif ($body) {
            $this->body=$body;
        }
        return $this->body;
    }


    /**
     * Set the body padding (add the class 'no-padding to the box boddy')
     * Padding is set (true) by default
     *
     * @param  boolean $padding [description]
     *
     * @return [type]           [description]
     */
    public function p0($padding = true)
    {
        if ($padding) {
            $this->p0=true;
        } else {
            $this->p0=false;
        }
        return $this->p0;
    }


    /**
     * Card html footer
     *
     * @param  string $footer [description]
     *
     * @return string
     */
    public function footer($footer = '')
    {
        if ($footer) {
            $this->footer=$footer;
        }
        return $this->footer;
    }


    /**
     * When set to true, the box show a overlay and a loading image
     * You can hide it with $('#boxid .overlay, #boxid.loading-img').hide()
     *
     * @param  boolean $loading [description]
     *
     * @return boolean
     */
    public function loading($loading = false)
    {
        if ($loading) {
            $this->loading=$loading;
        }
        return $this->loading;
    }


    public function collapsable($collapsable = false)
    {
        if ($collapsable) {
            $this->collapsable=$collapsable;
        }
        return $this->collapsable;
    }


    public function collapsed($collapsed = false)
    {
        if ($collapsed) {
            $this->collapsable=true;
            $this->collapsed=true;
        }
        return $this->collapsed;
    }




    /**
     * Add a top-right "x" button that allow box desctruction
     * @param  boolean $removable [description]
     * @return [type]             [description]
     */
    public function removable($removable = false)
    {
        if ($removable) {
            $this->removable=$removable;
        }
        return $this->removable;
    }

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
     *
     * @return [type] [description]
     */
    public function html($body = '', $footer = '')
    {

        if ($body) {
            $this->body($body);
        }

        if ($footer) {
            $this->footer($footer);
        }

        $STYLE='';
        if ($this->style()) {
            $STYLE="style='".$this->style()."'";
        }


        $class=[];
        $class[]='card';
        $class[]='card-'.$this->type();
        
        if ($this->collapsed) {
            $class[]='collapsed-card';
        }
        

        if ($this->addClass()) {
            $class[]=$this->addClass();
        }

        $htm='<div class="'.implode(" ", $class).'" '.$STYLE.' id="'.$this->id().'">';// box-solid



        if ($this->title||$this->icon()) {

          $htm.='<div class="card-header">';

            $htm.='<h3 class="card-title">';

            if ($this->icon()) {
                if (is_array($this->icon())) {
                    foreach ($this->icon() as $ico) {
                        $htm.="<i class='".$ico."'></i> ";
                    }
                } else {
                    $htm.="<i class='".$this->icon()."'></i> ";
                }
            }

            $htm.=$this->title;

            if ($this->small()) {
                $htm.=' <small>'.$this->small().'</small>';
            }

            $htm.='</h3>';

            $htm.='<div class="card-tools">';// pull-right box-tools

            if ($this->tools()) {
                $htm.=$this->tools();
            }

            if ($this->collapsable()) {

                $class="fa fa-minus";

                $htm.='<button class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="'.$class.'"></i></button>';
            }

            // remove

            if ($this->removable()) {
                $htm.='<button class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>';
            }

            $htm.='</div>';
            $htm.='</div>';
        }




        // body
        $class=$style=[];
        $class[]='card-body';
        /*
        if ($this->collapsed()) {
            $class[]='collapsed-box';
            $style[]='display:none;';
        }
        */

        /*
        if (!$this->body_padding()) {
            $class[]='no-padding';
        }
        */
        if($this->p0){
          $class[]='p-0';
        }


        $htm.="<div class='".implode(' ', $class)."' style='".implode('', $style)."'>";


        if (is_array($this->body)) {
            $htm.=implode('', $this->body);
        } else {
            $htm.=$this->body;
        }

        $htm.='</div>';// body end

        //Card footer
        if ($this->footer()) {
            $htm.="<div class='card-footer'>";// $collapse
            $htm.=$this->footer();
            $htm.='</div>';
        }

        if ($this->loading()) {
            $htm.='<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>';
        } else {
            $htm.='<div class="overlay" style="display:none"><i class="fa fa-refresh fa-spin"></i></div>';
        }

        $htm.='</div>';// end.box

        return $htm;
    }

    public function __toString()
    {
        return $this->html();
    }
}

/*
<div class="card">
  <div class="card-header no-border">
    <h3 class="card-title">Online Store Overview</h3>
    <div class="card-tools">
      <a href="#" class="btn btn-sm btn-tool">
        <i class="fa fa-download"></i>
      </a>
      <a href="#" class="btn btn-sm btn-tool">
        <i class="fa fa-bars"></i>
      </a>
    </div>
  </div>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
      <p class="text-success text-xl">
        <i class="ion ion-ios-refresh-empty"></i>
      </p>
      <p class="d-flex flex-column text-right">
        <span class="font-weight-bold">
          <i class="ion ion-android-arrow-up text-success"></i> 12%
        </span>
        <span class="text-muted">CONVERSION RATE</span>
      </p>
    </div>
    <!-- /.d-flex -->
    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
      <p class="text-warning text-xl">
        <i class="ion ion-ios-cart-outline"></i>
      </p>
      <p class="d-flex flex-column text-right">
        <span class="font-weight-bold">
          <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
        </span>
        <span class="text-muted">SALES RATE</span>
      </p>
    </div>
    <!-- /.d-flex -->
    <div class="d-flex justify-content-between align-items-center mb-0">
      <p class="text-danger text-xl">
        <i class="ion ion-ios-people-outline"></i>
      </p>
      <p class="d-flex flex-column text-right">
        <span class="font-weight-bold">
          <i class="ion ion-android-arrow-down text-danger"></i> 1%
        </span>
        <span class="text-muted">REGISTRATION RATE</span>
      </p>
    </div>
    <!-- /.d-flex -->
  </div>
</div>
*/