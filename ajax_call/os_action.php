<?php 
require_once'../inc.func.php';
session_start();
$data[]=""; $id=""; $query="";
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
	$sWhere="product_id=".$_POST['ser_product']."";
}
else
{
	$sWhere="1";
}
$result=$cm->selectData("opening_stock", "{$sWhere} ORDER BY stock_id DESC");
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
echo $query,"~",$fd;
?>