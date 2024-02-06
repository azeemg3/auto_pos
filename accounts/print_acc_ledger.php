<?php
require_once'../inc.func.php';
session_start();
$obRow="";
if(isset($_POST['trans_acc_id']) && !empty($_POST['trans_acc_id']))
{
	$trans_acc_id=$_POST['trans_acc_id'];
	$ob_result=$cm->selectData("trans_acc","trans_acc_id=".$trans_acc_id." LIMIT 1");
	$balance="";
	$array=array();	
	$arrayofArray=array();
	$whereArray=array();
	$sWhere="";
	if(!empty($_POST['dt_frm']) && !empty($_POST['dt_to']))
	{
		$dt_frm=$_POST['dt_frm'];
		$dt_to=$_POST['dt_to'];
		$whereArray[]="STR_TO_DATE(trans_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$dt_frm', '%d-%m-%Y') AND STR_TO_DATE('$dt_to', '%d-%m-%Y ') AND status='approved' AND trans_acc_id=".$trans_acc_id.""; 
		$sWhere = implode(" AND ", $whereArray);
	}
	while($ob_row=$ob_result->fetch_assoc())
	{
		$balance+=$cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id']);
		$dr=(($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])>0)?'
			'.abs($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])).'':"0.00");
		$cr=(($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])<0)?'
			'.abs($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])).'':"0.00");
		$obRow.='
				<tr>
					<td colspan="3" align="right">'.$ob_row['trans_acc_name'].'&nbsp;&nbsp;</td>
					<td>Opening Balance As At '.$dt_frm.'</td>
					<td>'.(($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])>0)?'
			'.number_format(abs($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])),2).'':"0.00").'</td>
					<td>'.(($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])<0)?'
			'.number_format(abs($cm->ob($dt_frm,$dt_to,$ob_row['trans_acc_id'])),2).'':"0.00").'</td>
					<td>'.$cm->show_bal($balance).'</td>
				</tr>
			';
	}
	$bal="";
	$det=""; $tdr=0; $tcr=0; $tbal=0;
	$newArray=array();
	$result=$cm->selectData("trans","{$sWhere}");
	while($row=$result->fetch_assoc())
	{
	   if($row['dr_cr']=='dr'){$bal+=$row['amount'];}
	   elseif($row['dr_cr']=='cr'){$bal+='-'.$row['amount'];}
	   $tdr+=(($row['dr_cr']=='dr')?''.$row['amount'].'':"0.00");
	   $tcr+=(($row['dr_cr']=='cr')?''.$row['amount'].'':"0.00");
	   $tbal=($tdr-$tcr);
	   $det.='
	   		<tr>
				<td>'.$row['trans_date'].'</td>
				<td>'.$row['vt'].'-'.$cm->serial($row['trans_code']).'</td>
				<td>'.$cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$row['trans_acc_id']."").'</td>
				<td>'.$row['narration'].'</td>
				<td>'.(($row['dr_cr']=='dr')?''.$row['amount'].'':"0.00").'</td>
				<td>'.(($row['dr_cr']=='cr')?''.$row['amount'].'':"0.00").'</td>
				<td>'.$cm->show_bal($bal+$balance).'</td>
			</tr>
	   	';
	}
	$det.='
			<tr>
				<td colspan="4" align="right"><strong>Total</strong></td>
				<td><strong>'.$cm->show_bal_format($dr+$tdr).'</strong></td>
				<td><strong>'.$cm->show_bal_format($cr+$tcr).'</strong></td>
				<td><strong>'.$cm->show_bal($balance+$tbal).'</strong></td>
			</tr>
		';
}
?>
<link href="../bootstrap/css/printXo.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
	function print_data() {
		window.print();
		setTimeout(function() {window.close();},0);
	};
</script>
<style media="print">
@page {
  size: auto;
  margin:1 auto;
       }
table{ font-size:12px;}
#bg-text
{
	position:absolute;
	top:40%;
	left:32%;
}
</style>
<title>Print Sale Report</title>
<body onLoad="print_data()">
<div id="print_data">
<p id="bg-text"></p>
<div id="wrapper">
<div id="header">
        	<div id="tvt"></div>
            <div id="header-mid">
            	<div id="txt" style="font-size:20px;">786 Autos</div>
                <p align="center">Dhemthal Narowal<br>
                      Mobile: 0307-634050<br>
    			</p>
            </div>
            <!--<div id="iata"></div>-->
        </div>
        <hr />
        <div id="exchange"></div>
        <div style="width:500px; border:1px solid black; border-radius:4px; padding:14px; float:left; height:40px;">
        <strong>A/C</strong>: <?php echo $cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$_POST['trans_acc_id'].""); ?>
        <!--<strong>Area: </strong>-->
        </div>
        <!--end-div-->
        <div style="width:420px; border:1px solid black; border-radius:4px; padding:14px; float:left; margin-left:10px;">
        Date : <?php echo $cm->today() ?><br>
        print By : <?php echo $cm->u_value("user", "name", "id=".$_SESSION['sessionId']."") ?>
        </div>
        <!--end-div-->
        <br><br><br><br><br>
  <table border="1" align="center" width="100%" style="border-collapse:collapse; font-size:12px;" cellpadding="5">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
        <th width="10%">Date</th>
        <th>Voucher</th>
        <th width="15%">Trans A/C</th>
        <th>Description</th>
        <th>Debit</th>
        <th>Credit</th>
        <th width="10%">Balance</th>
    </tr>
    </thead>
    <?php echo $obRow;  ?>
    <?php echo $det  ?>
    </table>
</div>
</div>
<div  style="bottom:5;width:1000px;text-align:justify;  position:absolute; font-style:Arial, Helvetica, sans-serif">
	<p align="left">Sign ___________________________</p>
</div>