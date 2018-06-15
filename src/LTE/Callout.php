<?php
/**
 * AdminLte2 Callout
 * @author jambonbill
 */

namespace LTE;

Class Callout
{
    private $type ='default';
    private $title='title';
    private $body ='body';

    public function __construct ($type = '', $title = '', $body = '')
    {
        $this->type = $type;
        $this->title = $title;
        $this->body = $body;
        //echo "Youpi !!";
    }

    public function type($str)
    {
        if ($str) {
            $this->type=$str;
        }
        return $this->type;
    }
    
    public function title($str)
    {
        if ($str) {
            $this->title=$str;
        }
        return $this->title;
    }
    
    public function body($str)
    {
        if ($str) {
            $this->body=$str;
        }
        return $this->body;
    }

    public function html()
    {
        $htm='<div class="callout callout-'.$this->type.'">';
        $htm.='<h4>'.$this->title.'</h4>';
        
        if ($this->body) {
            $htm.='<p>'.$this->body.'</p>';
        }
        $htm.='</div>';
        return $htm;
    }

    public function __toString()
    {
        return $this->html();
    }
}
