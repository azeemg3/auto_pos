<?php 
require_once'../inc.func.php';
session_start();
$data[]=""; $id=""; $query="";
if(isset($_POST) && !empty($_POST['brand_name']))
{
	$data=$_POST;
	$id=$_POST['brand_id'];
	if($id==0 || $id=="")
	{
		$data['userId']=$_SESSION['sessionId'];
		$query=$cm->insert_array("brands", $data, 'date_time', 'NOW()');
	}
	else
	{
		$query=$cm->update_array("brands",$data, "brand_id=".$id."");
	}
}
$fd=""; $count=1;
$result=$cm->selectData("brands", "1 ORDER BY brand_id DESC");
while($row=$result->fetch_assoc())
{
	$fd.='<tr>
			<td>'.$count++.'</td>
			<td>'.$row['brand_name'].'</td>
			<td><a class="btn btn-default btn-sm" onclick="edit_brnads('.$row['brand_id'].')">
				<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
		  </tr>
		';
}
echo $query,"~",$fd;
?>