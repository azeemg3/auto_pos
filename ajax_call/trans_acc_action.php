<?php 
require_once'../inc.func.php';
session_start();
$data[]=""; $id=""; $query="";
if(isset($_POST) && !empty($_POST['trans_acc_type']) && !empty($_POST['trans_acc_name']))
{
	$data=$_POST;
	$id=$_POST['trans_acc_id'];
	if($id==0 || $id=="")
	{
		$data['userId']=$_SESSION['sessionId'];
		$data['status']='active';
		$query=$cm->insert_array("trans_acc", $data, 'create_date', 'NOW()');
	}
	else
	{
		$query=$cm->update_array("trans_acc",$data, "trans_acc_id=".$id."");
	}
}
$fd=""; $count=1;
 $rid="";
$sWhere="";$whereArray=array();
if(!empty($_POST))
{
	if(!empty($_POST['ser_trans_acc_type']))$whereArray[]="trans_acc_type='".$_POST['ser_trans_acc_type']."'";
	if(!empty($_POST['trans_acc_name'])) $whereArray[]="trans_acc_name LIKE '%".$_POST['trans_acc_name']."%'";
	
	$sWhere = implode(" AND ", $whereArray);	
}
/*if(!empty($_POST['ser_trans_acc_type']))
{
	$sWhere="trans_acc_type='".$_POST['ser_trans_acc_type']."'";
}
*/
else
{
	$sWhere="1";
}
$result=$cm->selectData("trans_acc", "{$sWhere} ORDER BY trans_acc_id DESC");
while($row=$result->fetch_assoc())
{
	$rid=$row['trans_acc_id'];
	$fd.='<tr>
			<td>'.$row['trans_acc_name'].'</td>
			<td>'.$row['trans_acc_type'].'</td>
			<td>'.$row['city_name'].'</td>
			<td>'.$row['area_name'].'</td>
			<td>'.$row['amount'].'</td>
			<td>'.$row['trans_acc_address'].'</td>
			<td><a class="btn btn-default btn-sm" onclick="edit_trans_acc('.$row['trans_acc_id'].')">
				<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
		  </tr>
		';
}
$fd.=$cm->nothing_found($rid, 5);
echo $query,"~",$fd;
?>