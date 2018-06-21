<?php
/**
 * AdminLte2 Modal V4
 * https://almsaeedstudio.com/themes/AdminLTE/pages/UI/modals.html
 * to pop the modal -> $("#modalwindow").modal(true);
 * to update the title -> $("#modalwindow .modal-title").html('html');
 * to update the body -> $("#modalwindow .modal-body").html('html');
 *
 * More here :
 * https://v4-alpha.getbootstrap.com/components/modal/#optional-sizes
 */

namespace LTE;

class Modal
{
    private $id ='myModal';
    private $type ='default';
    private $icon ='fa fa-times';
    private $title='modal-title';
    private $body ='modal-body';
    private $footer ='<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>';

    public function __construct($title = '', $body = '', $footer = '')
    {
        if ($title) {
            $this->title($title);
        }
        if ($body) {
            $this->body($body);
        }
        if ($footer) {
            $this->footer($footer);
        }
    }

    public function id($str = '')
    {
        if ($str) {
            $this->id=$str;
        }
        return $this->id;
    }

    public function type($str = '')
    {
        if ($str) {
            $this->type=$str;
        }
        return $this->type;
    }

    public function title($str = '')
    {
        if ($str) {
            $this->title=$str;
        }
        return $this->title;
    }

    public function body($str = '')
    {
        if ($str) {
            $this->body=$str;
        }
        return $this->body;
    }

    public function footer($str = '')
    {
        if ($str) {
            $this->footer=$str;
        }
        return $this->footer;
    }

    public function icon($str = '')
    {
        if ($str) {
            $this->icon=$str;
        }
        return $this->icon;
    }

    public function html()
    {

        $htm='<div class="modal modal-'.$this->type().'" id="'.$this->id.'">';
        $htm.='<div class="modal-dialog">';
        $htm.='<div class="modal-content">';

        $htm.='<div class="modal-header">';

        $htm.='<h4 class="modal-title">';
        
        if ($this->icon) {
            $htm.='<i class="'.$this->icon().'"></i> ';
        }
        
        $htm.=$this->title().'</h4>';

        $htm.='<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
        $htm.='</div>';

        $htm.='<div class="modal-body">'.$this->body().'</div>';

        $htm.='<div class="modal-footer">';
          //$htm.='<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';
          //$htm.='<button type="button" class="btn btn-primary">Save changes</button>';

        if (is_array($this->footer())) {
            $htm.=implode('', $this->footer());
        } else {
            $htm.=$this->footer();
        }

        $htm.='</div>';

        $htm.='</div>';//<!-- /.modal-content -->
        $htm.='</div>';//<!-- /.modal-dialog -->
        $htm.='</div>';//<!-- /.modal -->

        return $htm;
    }

    public function __toString()
    {
        return $this->html();
    }
}
