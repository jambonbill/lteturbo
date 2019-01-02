<?php
/**
 * AdminLte2 Callout
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
 * AdminLte2 Callout
 * PHP version 7
 *
 * @category LTE
 * @package  LTEturbo
 * @author   jambonbill <jambonbill@gmail.com>
 * @license  https://github.com/jambonbill  Jambon License 1.01
 * @link     https://github.com/jambonbill
 */
class Callout
{

    private $_type ='default';

    /**
     * Callout Title
     */
    private $_title='title';

    /**
     * Callout Body
     */
    private $_body ='body';


    /**
     * Constructor
     *
     * @param string $type  [description]
     * @param string $title [description]
     * @param string $body  [description]
     */
    public function __construct($type = '', $title = '', $body = '')
    {
        $this->_type = $type;
        $this->_title = $title;
        $this->_body = $body;
    }

    /**
     * Set type
     *
     * @param  [type] $str [description]
     *
     * @return [type]      [description]
     */
    public function type($str)
    {
        if ($str) {
            $this->_type=$str;
        }
        return $this->_type;
    }


    /**
     * Set title
     *
     * @param string $str [description]
     *
     * @return string      [description]
     */
    public function title($str)
    {
        if ($str) {
            $this->title=$str;
        }
        return $this->title;
    }


    /**
     * Set body
     *
     * @param [type] $str [description]
     *
     * @return [type]      [description]
     */
    public function body($str)
    {
        if ($str) {
            $this->body=$str;
        }
        return $this->body;
    }

    /**
     * Build html string
     *
     * @return [type] [description]
     */
    public function html()
    {
        $htm='<div class="callout callout-'.$this->_type.'">';
        $htm.='<h4>'.$this->_title.'</h4>';

        if ($this->_body) {
            $htm.='<p>'.$this->_body.'</p>';
        }
        $htm.='</div>';
        return $htm;
    }


    /**
     * Return html
     *
     * @return string [description]
     */
    public function __toString()
    {
        return $this->html();
    }
}
