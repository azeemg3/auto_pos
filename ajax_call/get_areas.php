<?php
require_once'../inc.func.php';
$msg="";
if(isset($_POST['area_name']) && !empty($_POST['area_name']))
{
	$data=$_POST;
	$area_name=$cm->u_value("areas", "area_name", "area_name='".$_POST['area_name']."'");
	if(!empty($area_name) && !empty($area_name))
	{
		echo $msg= 1;
		exit;
	}
	else
	{
		$cm->insert_array("areas", $data);
		$msg=2;
	}
}
$list="";
$result=$cm->selectData("areas", "1 ORDER BY area_id DESC");
$count=1;
while($row=$result->fetch_assoc())
{
	$list.='
		<tr id="'.$row['area_id'].'">
			<td>'.$count++.'</td>
			<td>'.$row['area_name'].'</td>
			<td>'.$cm->u_value("cities", "city_name", "city_id=".$row['city_id']."").'</td>
			<td><a class="btn btn-default btn-sm" onclick="del_rec(\''.$row['area_id'].'\', \'area\',\'\')">
						<span class="glyphicon glyphicon-remove"></span>
			</a></td>
		</tr>
	';
}
echo $msg,"~",$list;
?>