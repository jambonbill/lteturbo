<?php
/**
 * Box content types
 */

$htm='please wait';

$box=new LTE\Card;
$box->id('boxContentTypes');
//$box->icon('fa fa-list');
$box->title('Content types');
$box->small('django_content_type');
$box->body($htm);
//$box->small('small text');
//$box->collapsable(true);
$box->p0(1);
$box->loading(1);
echo $box;