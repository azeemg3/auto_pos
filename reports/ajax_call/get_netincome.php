<?php
require_once'../../inc.func.php';
if(!empty($_POST['df']) && !empty($_POST['dt']))
{
	$df=$_POST['df'];
	$dt=$_POST['dt'];
	$gp=$cm->gp($df, $dt);
	$texp=$cm->texp($df, $dt);
	$netincome=$gp-$texp;
	echo number_format($gp,2),"~",number_format($texp,2),"~",number_format($netincome, 2);
}
?>