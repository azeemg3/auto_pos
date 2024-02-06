<?php
require_once'../inc.func.php';
$msg="";
if(isset($_POST['city_name']) && !empty($_POST['city_name']))
{
	$data=$_POST;
	$cuntry_id=$cm->u_value("cities", "country_code", "country_code='".$_POST['country_code']."'");
	$city_name=$cm->u_value("cities", "city_name", "city_name='".$_POST['city_name']."'");
	if(!empty($cuntry_id) && !empty($city_name))
	{
		echo $msg= 1;
		exit;
	}
	else
	{
		$cm->insert_array("cities", $data);
		$msg=2;
	}
}
$list="";
$result=$cm->selectData("cities", "1 ORDER BY city_id DESC");
$count=1;
while($row=$result->fetch_assoc())
{
	$list.='
		<tr id="'.$row['city_id'].'">
			<td>'.$count++.'</td>
			<td>'.$row['city_name'].'</td>
			<td>'.$row['province'].'</td>
			<td>'.$cm->u_value("countries", "country_name", "country_code=".$row['country_code']."").'</td>
			<td><a class="btn btn-default btn-sm" onclick="del_rec(\'\',\'city\', \''.$row['city_id'].'\')">
						<span class="glyphicon glyphicon-remove"></span>
			</a></td>
		</tr>
	';
}
echo $msg,"~",$list;
?>