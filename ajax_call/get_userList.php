<?php
require_once'../inc.func.php';
session_start();
if(isset($_GET['page']))
{
	$page=$_GET['page'];
}
else
{
	$page=1;
}
if(isset($_POST['per_page']) && !empty($_POST['per_page']))
{
	$per_page=$_POST['per_page'];
}
else{ 
$per_page=10;
}
$cur_page = $page;
$page -=1;
$start = $page * $per_page;
$userList="";
$count=1;
$query=$cm->selectData("user", "1");
while($row=$query->fetch_assoc())
{
	$userList.='
				<tr id="'.$row['id'].'">
					<td>'.$count++.'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['account_name'].'</td>
					<td>'.$row['phone'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['status'].'</td>
					<td>'.$row['date_created'].'</td>
					<td>
					'.(($cm->user_access("edit",$_SESSION['sessionId']))?'
						<a class="btn btn-default btn-sm" href="register?userid='.$row['id'].'">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
					':'').'
					'.(($cm->user_access("delete",$_SESSION['sessionId']))?'
						<a class="btn btn-default btn-sm" onClick = del_rec(\'\',\'users\','.$row['id'].')>
						<span class="glyphicon glyphicon-remove"></span>
						</a>
						':'').'
					</td>
					
				</tr>
	';
}
echo $userList;
?>