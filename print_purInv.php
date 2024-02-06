<?php
require_once'inc.func.php';
session_start();
$obRow=""; $row=NULL;
if(isset($_GET['invId']) && !empty($_GET['invId']))
{
	$invId=$_GET['invId'];
	$result=$cm->selectData("purchase_invoice","p_id=".$invId."");
	$row=$result->fetch_assoc();
}
?>
<link href="bootstrap/css/printXo.css" type="text/css" rel="stylesheet">
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
<p id="bg-text"><img src="images/deutech.jpg" width="300"></p>
<div id="wrapper">
<div id="header">
        	<div id="tvt"><img width="180" src="images/deutech.png"></div>
            <div id="header-mid">
            	<div id="txt" style="font-size:20px;">DEU TECH PHARMACEUTICALS</div>
                <p align="center">
                      307-R-II Johar Town Lahore<br>
                      Phone: 0322-7862800<br>
                      LIC# 01-A|AIT|II|2014
    			</p>
            </div>
            <!--<div id="iata"></div>-->
        </div>
        <hr />
        <div id="exchange"></div>
        <br>
        <div style="width:500px; border:1px solid black; border-radius:4px; padding:14px; float:left; height:54px;">
        <strong>Vendor</strong>: <?php echo $cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$row['vendor_id'].""); ?>
        </div>
        <!--end-div-->
        <div style="width:420px; border:1px solid black; border-radius:4px; padding:14px; float:left; margin-left:10px;">
        Date : <?php echo $cm->today() ?><br>
        Inv# : <?php echo $cm->serial($invId) ?><br>
        Created : <?php echo $cm->u_value("user", "name", "id=".$_SESSION['sessionId']."") ?>
        </div>
        <!--end-div-->
        <br><br><br><br><br>
        <div style="clear:both;"></div>
  <table border="1" align="center" width="100%" style="border-collapse:collapse; font-size:14px;" cellpadding="5">
    <thead>
      <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
        <th>Sr#</th>
        <th>Product Name</th>
        <th>Batch</th>
        <th>Rate</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <?php
	$count=1;
	$query=$cm->selectData("stock_details", "pi_id=".$invId."");
	while($sRow=$query->fetch_assoc())
	{
	 ?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $cm->u_value("products","product_name", "product_id=".$sRow['product_id']."")  ?></td>
            <td></td>
            <td><?php echo $sRow['rate'] ?></td>
            <td><?php echo $sRow['qty'];if($sRow['bonus_qty']>0) echo '+' .$sRow['bonus_qty'] ?></td>
            <td><?php echo $cm->show_bal_format($sRow['qty']*$sRow['rate']) ?></td>
        </tr>
<?php } ?>
        <tr>
        	<td align="right" colspan="5"><strong>Sub Total</strong></td>
            <td><?php echo $row['sub_total'] ?></td>
        </tr>
        <tr>
        	<td align="right" colspan="5"><strong>GST</strong></td>
            <td><?php echo $row['gst'] ?></td>
        </tr>
        <tr>
        	<td align="right" colspan="5"><strong>Net Total</strong></td>
            <td><?php echo $row['net_total'] ?></td>
        </tr>
        <tr>
        	<td align="right" colspan="5"><strong>Paid</strong></td>
            <td><?php echo $row['paid'] ?></td>
        </tr>
        <tr>
        	<td align="right" colspan="5"><strong>Balance</strong></td>
            <td><?php echo $row['net_total']-$row['paid'] ?></td>
        </tr>
    </tbody>
    </table>
</div>
<center>
<div  style="bottom:20;width:1000PX;text-align:justify;  position:absolute;">
	<p align="left">Sign ___________________________</p>
	<p style="bottom:10px; border:1px solid black; border-radius:4px; padding:10px;">
    FORM 2A (SEE RULE 19 & 30) WARRANTY UNDER SECTION 23(1).
    (1) OF THE DRUG ACT' 1976<br>
    I UMAIR HASSAN Being resident in Pakistan carrying business at 307-R, II Johar Town , Lahore Under the name of M/S Deu Tech Pharmaceutical and being Authorized agent of the drugs described above, do hereby warranty that the drugs described above as sold by us, Specified and contained in the bill of sales, or not contravene in anyway the provisions of section 23 of the Drughs Act, 1976.<br>
    <strong>Note:</strong> This warranty does not apply Unani, Natural Homeopathic, Cosmo Derma, Dispensing, Bio-Chemical systems of meicines and general items if any mentioned in this cash memo/ Invoices.
    </p>
</div>
</center>