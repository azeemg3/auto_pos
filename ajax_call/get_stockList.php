<?php
require_once'../inc.func.php';
$fd=""; $count=1;
$db=$cm->db();
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
$result=$cm->selectMultiData("*","products inner join opening_stock on products.product_id=opening_stock.product_id", "{$sWhere}  ORDER BY products.product_id DESC limit $start, $per_page");
$total_rec=$cm->count_val("products products inner join opening_stock on products.product_id=opening_stock.product_id","products.product_id","{$sWhere}");
while($row=$result->fetch_assoc())
{
	$rid=$row['product_id'];
	// $pq=$row['qty']+$cm->u_total("stock_details", "qty","product_id=".$row['product_id']." AND type='p'");
	// $sq=$cm->u_total("stock_details", "qty","product_id=".$row['product_id']." AND type='s'");
	// $avg_price=$cm->u_value("stock_details","AVG(rate)","product_id=".$row['product_id']." AND pi_id!=''");
	$query="SELECT 
    SUM(
        CASE 
            WHEN si_id > 1 THEN stock_details.qty 
            ELSE 0 
        END
    ) AS sq,
    SUM(
        CASE 
            WHEN pi_id > 1 THEN (stock_details.qty*stock_details.rate) 
            ELSE 0 
        END
    ) AS price,
    SUM(
        CASE 
            WHEN pi_id > 1 THEN stock_details.qty 
            ELSE 0 
        END
    ) AS pq
FROM stock_details,products LEFT JOIN opening_stock on products.product_id=opening_stock.product_id
WHERE stock_details.product_id =".$rid." GROUP BY products.product_id";
$result1 =$db->query($query);
$row1 = $result1->fetch_assoc();
	$avg_price=$cm->u_value("stock_details","AVG(rate)","product_id=".$rid." AND pi_id!=''");
	$rq=($row1['pq']??0)-($row1['sq']??0);
	//if($rq>0){
	$fd.='<tr>
			<td>'.$count.'</td>
			<td>'.$row['product_name'].'</td>
			<td>N/A</td>
			<td>'.$rq.'</td>
			<td>'.($rq)*($avg_price).'</td>
			<!-- <td>'.($row1['price']??0).'</td>-->
		  </tr>
		';
	//}
	$count++;
}
$fd.=$cm->nothing_found($rid, 5);
$fd.='<tr><td colspan="5">'.$cm->pagination($total_rec,$cur_page,$per_page,"get_stockList").'</td></tr>';
echo $fd;
?>