<?php
/**
 * Modal
 */

$modal=new LTE\Modal;
$modal->id('modalPermissions');
$modal->title('Permissions');
$modal->body('');
$btns='';//<button id=btnthis class="btn btn-default btn-sm"><i class="fa fa-save"></i> Save</button>
$btns.='<button class="btn btn-default btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>';
$modal->footer($btns);
echo $modal;

