<?php
function accesscontrol_service(){

if ($permissions<'5'){

$tblDemo->disallowAdd();

$tblDemo->disallowDelete();

$tblDemo->disallowDelete('date');

$tblDemo->disallowDelete('am_pm');

}







}

?>
