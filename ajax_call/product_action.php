<?php 
require_once'../inc.func.php';
session_start();
$data[]=""; $id=""; $query="";
if(isset($_POST) && !empty($_POST['product_name']) && !empty($_POST['product_name']))
{
	$data=$_POST;
	$id=$_POST['product_id'];
	if($id==0 || $id=="")
	{
		$data['userId']=$_SESSION['sessionId'];
		$query=$cm->insert_array("products", $data, 'date_time', 'NOW()');
	}
	else
	{
		$query=$cm->update_array("products",$data, "product_id=".$id."");
	}
}
$fd=""; $count=1;
$result=$cm->selectData("products", "1 ORDER BY product_id DESC");
while($row=$result->fetch_assoc())
{
	$fd.='<tr>
			<td>'.$count++.'</td>
			<td>'.$row['product_name'].'</td>
			<td>'.$cm->u_value("brands", "brand_name", "brand_id=".$row['brand_id']."").'</td>
			<td>'.$row['purchase_price'].'</td>
			<td>'.$row['batch'].'</td>
			<td>'.$row['exp_date'].'</td>
			<td><a class="btn btn-default btn-sm" onclick="edit_products('.$row['product_id'].')">
				<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
		  </tr>
		';
}
echo $query,"~",$fd;
?>