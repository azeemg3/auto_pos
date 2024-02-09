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
$fd=""; $count=1;
$result=$cm->selectData("products", "1 ORDER BY product_id DESC limit $start, $per_page");
$total_rec=$cm->count_val("products","product_id","1");
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
$fd.='<tr><td colspan="5">'.$cm->pagination($total_rec,$cur_page,$per_page,"get_products").'</td></tr>';
echo $query,"~",$fd;

?>