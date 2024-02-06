<?php
require_once'inc.func.php';
session_start();
$obRow=""; $row=NULL;
if(isset($_GET['invId']) && !empty($_GET['invId']))
{
    $invId=$_GET['invId'];
    $result=$cm->selectData("sale_invoice","s_id=".$invId."");
    $row=$result->fetch_assoc();
    $receive=0;
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
 size: 3in;
 margin:0 auto;
}
table {
    font-size: 8px;
    width: 100% !important;
}
table {
    caption-side: bottom;
}
</style>
<title>Sale Invoice</title>
<body onLoad="print_data()" style="margin-top:0px;">
<br>
<br>
<table border="0" align="center" style="border-collapse:collapse;" cellpadding="2">
  <caption><br>
  Thanks for your visit.
  </caption>
  <thead>
    <tr>
        <td align="center" colspan="5" style="border: 0px;">
            <!-- <div style="float: left;"><img src="images/logo.png" width="40"></div> -->
       <div id="" style="font-size:10px;">786 Autos<br> <span style="font-size: 8px;">Autos Spare Parts</span> </div>
        <p align="center" style="font-size:6px;">Chandni Chowk Sankhtra Road Dhamthal.<br>For Contact: 0307-6340250/0333-8716427

 </p>
        <br>
        <span style="float:left;">Client Name: <?php echo $cm->u_value("trans_acc", "trans_acc_name", "trans_acc_id=".$row['client_id'].""); ?></span>
        <span style="float:right;">#Invoice:<?php echo $cm->serial($invId) ?> </span>
        <br> 
        <span style="float:left;">Cashier: <?php echo $cm->u_value("user","name", "id=".$row['userId'].""); ?></span> 
        <span style="float:right;">Time:<?php echo $cm->current_dt(); ?> </span>
        </td>
    </tr>
    <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
      <th>Sr#</th>
      <th>Items</th>
      <th>Rate</th>
      <th>Quantity</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $count=1;
    $query=$cm->selectData("stock_details", "si_id=".$invId."");
    while($sRow=$query->fetch_assoc())
    {
     ?>
    <tr>
      <td width="5%" align="center" style="border:1px solid #E7E4E4;"><?php echo $count++; ?></td>
      <td style="width: 50%; border: 1px solid #E7E4E4"><?php echo $cm->u_value("products","product_name", "product_id=".$sRow['product_id']."")  ?></td>
      <td width="10%" align="center" style="border:1px solid lightgray;"><?php echo $sRow['rate'] ?></td>
      <td width="5%" align="center" style="border:1px solid #E7E4E4;"><?php echo $sRow['qty'];?></td>
      <td width="10%" align="right" style="border:1px solid #E7E4E4;"><?php echo $cm->show_bal_format($sRow['qty']*$sRow['rate']) ?></td>
    </tr>
    <?php } ?>
    <tr>
            <td colspan="3" align="left">Total Item: <?php echo $count-1; ?></td>
            <td width="30%"><strong>Sub Total</strong></td>
            <td align="right"><strong><?php echo $cm->show_bal_format($row['sub_total']) ?></strong></td>
    </tr>
    <tr>
            <td colspan="3"></td>
            <td align="left"><strong>Discount</strong></td>
            <td align="right"><strong><?php echo $cm->show_bal_format($row['discount']) ?></strong></td>
        </tr>
    <tr>
            <td colspan="3"></td>
            <td align="left"><strong>GST</strong></td>
            <td align="right"><?php echo $cm->show_bal_format($row['gst']) ?></td>
        </tr>
    <tr>
    <tr>
        <td colspan="3"></td>
        <td align="left"><strong>Net Total</strong></td>
        <td align="right"><strong><?php echo $cm->show_bal_format($row['net_total']) ?></strong></td>
    </tr>
     <tr>
            <td colspan="3"></td>
            <td align="left"><strong>Received</strong></td>
            <td align="right"><?php echo $cm->show_bal_format($row['receive']+$receive) ?></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="left"><strong>Balance</strong></td>
            <td align="right"><?php echo $cm->show_bal_format($row['net_total']-$row['receive']-$receive) ?></td>
        </tr>
  </tbody>
</table>