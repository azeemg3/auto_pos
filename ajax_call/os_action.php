<?php 
require_once'../inc.func.php';
session_start();
$data[]=""; $id=""; $query="";
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
if(isset($_POST) && !empty($_POST['product_id']) && !empty($_POST['rate']))
{
	$data=$_POST;
	$id=$_POST['stock_id'];
	if($id==0 || $id=="")
	{
		$data['userId']=$_SESSION['sessionId'];
		$query=$cm->insert_array("opening_stock", $data, 'date_time', 'NOW()');
	}
	else
	{
		$query=$cm->update_array("opening_stock",$data, "stock_id=".$id."");
	}
}
$fd=""; $count=1;
$sWhere=""; $rid="";
if(!empty($_POST['ser_product']))
{
	$sWhere="a.product_id=".$_POST['ser_product']."";
}
else
{
	$sWhere="1";
}
$result=$cm->selectMultiData("*","opening_stock a join products b on a.product_id=b.product_id", "{$sWhere} ORDER BY a.stock_id DESC limit $start, $per_page");
$total_rec=$cm->count_val("opening_stock a join products b on a.product_id=b.product_id","a.product_id","{$sWhere}");
while($row=$result->fetch_assoc())
{
	$rid=$row['stock_id'];
	$fd.='<tr>
			<td>'.$count++.'</td>
			<td>'.$cm->u_value("products", "product_name", "product_id=".$row['product_id']."").'</td>
			<td>'.$row['rate'].'</td>
			<td>'.$row['qty'].'</td>
			<td><a class="btn btn-default btn-sm" onclick="edit_opeining_stock('.$row['stock_id'].')">
				<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
		  </tr>
		';
}
$fd.=$cm->nothing_found($rid, 5);
$fd.='<tr><td colspan="5">'.$cm->pagination($total_rec,$cur_page,$per_page,"get_stock_det").'</td></tr>';
echo $query,"~",$fd;
?>