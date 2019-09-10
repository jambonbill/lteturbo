<?php
/**
 * Bootstrap Modal V4
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
    private $_id ='myModal';
    private $_type ='default';
    private $_size ='';
    private $_icon ='';
    private $_title='';
    private $_body ='';
    private $_footer ='<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>';

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


    /**
     * Define modal id
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function id($str = '')
    {
        if ($str) {
            $this->_id=$str;
        }
        return $this->_id;
    }

    /**
     * Define modal type
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function type($str = '')
    {
        if ($str) {
            $this->_type=$str;
        }
        return $this->_type;
    }


    /**
     * Define model size (sm|md|lg)
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function size($str='')
    {
        if ($str) {
            $this->_size=$str;
        }
        return $this->_size;

    }

    /**
     * Set modal title
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function title($str = '')
    {
        if ($str) {
            $this->_title=$str;
        }
        return $this->_title;
    }


    /**
     * Set modal body
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function body($str = '')
    {
        if ($str) {
            $this->_body=$str;
        }
        return $this->_body;
    }


    /**
     * Set modal footer
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function footer($str = '')
    {
        if ($str) {
            $this->_footer=$str;
        }
        return $this->_footer;
    }

    /**
     * [icon description]
     *
     * @param string $str [description]
     *
     * @return [type]      [description]
     */
    public function icon($str = '')
    {
        if ($str) {
            $this->_icon=$str;
        }
        return $this->_icon;
    }

    /**
     * [html description]
     *
     * @return [type] [description]
     */
    public function html()
    {

        $htm='<div class="modal fade modal-'.$this->type().'" id="'.$this->_id.'">';

        if ($this->_size) {
            $htm.='<div class="modal-dialog modal-'.$this->_size.'">';
        } else {
            $htm.='<div class="modal-dialog">';
        }


        $htm.='<div class="modal-content">';

        $htm.='<div class="modal-header">';

        $htm.='<h4 class="modal-title">';

        if ($this->_icon) {
            $htm.='<i class="'.$this->icon().'"></i> ';
        }

        $htm.=$this->title().'</h4>';

        $htm.='<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
        $htm.='</div>';

        $htm.='<div class="modal-body">'.$this->body().'</div>';

        $htm.='<div class="modal-footer">';

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


    /**
     * [__toString description]
     *
     * @return string [description]
     */
    public function __toString()
    {
        return $this->html();
    }
}
