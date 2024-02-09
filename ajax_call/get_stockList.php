<?php
require_once'../inc.func.php';
$fd=""; $count=1;
$sWhere=""; $rid="";
if(!empty($_POST['ser_product']))
{
	$sWhere="product_name LIKE '%".$_POST['ser_product']."%'";
}
else
{
	$sWhere="1";
}
if(isset($_GET['page'])){
	$page=$_GET['page'];
}else{
	$page=1;
}
if(isset($_POST['per_page']) && !empty($_POST['per_page'])){
	$per_page=$_POST['per_page'];
}else{
	$per_page=20;
}
$cur_page=$page;
$page -=1;
$start=$page*$per_page;
$result=$cm->selectData("products", "{$sWhere}  ORDER BY product_id DESC limit $start, $per_page");
$total_rec=$cm->count_val("products","product_id","{$sWhere}");
while($row=$result->fetch_assoc())
{
	$pId=$row['product_id'];
	$pq=$cm->u_total("opening_stock","qty","product_id=".$row['product_id']."")+$cm->u_total("stock_details", "qty","product_id=".$row['product_id']." AND type='p'");
	$sq=$cm->u_total("stock_details", "qty","product_id=".$row['product_id']." AND type='s'");
	$avg_price=$cm->u_value("stock_details","AVG(rate)","product_id=".$row['product_id']." AND pi_id!=''");
	$rq=$pq-$sq;
	//if($rq>0){
	$fd.='<tr>
			<td>'.$count.'</td>
			<td>'.$row['product_name'].'</td>
			<td>'.$cm->u_value("brands", "brand_name", "brand_id=".$row['brand_id']."").'</td>
			<td>'.$rq.'</td>
			<td>'.($rq)*($avg_price).'</td>
		  </tr>
		';
	//}
	$count++;
}
$fd.=$cm->nothing_found($pId, 5);
$fd.='<tr><td colspan="5">'.$cm->pagination($total_rec,$cur_page,$per_page,"get_stockList").'</td></tr>';
echo $fd;
?>