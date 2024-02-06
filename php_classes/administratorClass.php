<?php
class administrator extends crm
{
	// airline list marketing point of view 
	function airlines($pref_airlines="")
	{
		$airlines[]="";
		$airlines=explode(",",$pref_airlines);
		$result=$this->selectData('airline_list', "1");
		$list="";
		$all_airlines=array();
		while($row=$result->fetch_assoc())
		{
			$list.='<li><a href="#" class="small" data-value="'.$row['airline_name'].'" tabIndex="-1">
                <input type="checkbox" name="pref_airline[]" value="'.$row['airline_name'].'" 
				'.((in_array(''.$row['airline_name'].'', $airlines))?'checked':"").'/>
                &nbsp;'.$row['airline_name'].'</a></li>';
				$all_airlines[]=$row['airline_name'];
		}
		$value=array_diff($airlines, $all_airlines);
		$list.='<li><a href="#" class="small" data-value="other_airline" tabIndex="-1">
                <input type="text" placeholder="Other Prefered Class" name="pref_airline[]"
					value="'.implode("",$value).'"/></a></li>';
		return $list;
	}
	// airline list in options
	function airlineList()
	{
		$list="";
		$result=$this->selectData("airline_list","1 ORDER BY airline_name ASC");
		while($row=$result->fetch_assoc())
		{
			$list.='<option value="'.$row['airline_id'].'">'.$row['airline_name'].'</option>';
		}
		return $list;
	}
	function travel_class($pref_class="")
	{
		$prefClass=explode(",",$pref_class);
		$result=$this->selectData('travel_class', "1");
		$all_classes=array();
		$list="";
		while($row=$result->fetch_assoc())
		{
			$list.='<li><a href="#" class="small" data-value="'.$row['class_name'].'" tabIndex="-1">
                <input type="checkbox" name="pref_class[]" value="'.$row['class_name'].'" 
				'.((in_array(''.$row['class_name'].'', $prefClass))?'checked':"").'/>
                &nbsp;'.$row['class_name'].'</a></li>';
				$all_classes[]=$row['class_name'];
				
		}
		$value=array_diff($prefClass, $all_classes);
		$list.='<li><a href="#" class="small" data-value="other_class" tabIndex="-1">
                <input type="text" placeholder="Other Prefered Class" name="pref_class[]" value="'.implode("",$value).'"/></a></li>';
		return $list;
	}
	function airline_seat_list($pref_seat="")
	{
		$prefSeat=explode(",",$pref_seat);
		$result=$this->selectData('airline_seat', "1");
		$all_seats=array();
		$list="";
		while($row=$result->fetch_assoc())
		{
			$list.='<li><a href="#" class="small" data-value="'.$row['seat_name'].'" tabIndex="-1">
                <input type="checkbox" name="pref_seat[]" value="'.$row['seat_name'].'"
				 '.((in_array(''.$row['seat_name'].'', $prefSeat))?'checked':"").'/>
                &nbsp;'.$row['seat_name'].'</a></li>';
				$all_seats[]=$row['seat_name'];
		}
		$value=array_diff($prefSeat,$all_seats);
		$list.='<li><a href="#" class="small" data-value="Qatar" tabIndex="-1">
                <input type="text" placeholder="Other Prefered Seat" name="pref_seat[]" value="'.implode("",$value).'"/></a></li>';
		return $list;
	}
	function airline_membership($airline_mem)
	{
		//am=airline membership
		$am=explode(',',$airline_mem);
		$result=$this->selectData('airline_membership', "1");
		$airlineMem=array();
		$list="";
		while($row=$result->fetch_assoc())
		{
			$list.='<li><a href="#" class="small" data-value="'.$row['membership_name'].'" tabIndex="-1">
                <input type="checkbox" name="airline_membership[]" value="'.$row['membership_name'].'"
				 '.((in_array(''.$row['membership_name'].'', $am))?'checked':"").'/>
                &nbsp;'.$row['membership_name'].'</a></li>';
				$airlineMem[]=$row['membership_name'];
		}
		$value=array_diff($am, $airlineMem);
		$list.='<li><a href="#" class="small" data-value="Qatar" tabIndex="-1">
                <input type="text" placeholder="other Airline membership" name="airline_membership[]"
				value="'.implode("",$value).'"/></a></li>';
		return $list;
	}
	// transaction account types
	function trans_acc_type($type="")
	{
		$list="";
		$array=array("Bank","Vendor","Expense", "Cash", "Staff");
		foreach($array as $val)
		{
			$list.='<option value="'.$val.'">'.$val.'</option>';
		}
		return $list;
	}
	// transation cash acconts
	function cash_acc()
	{
		$list="";
		$result=$this->selectData("trans_acc","trans_acc_type='Cash' AND branch_id=".$_SESSION['branch_id']."");
		while($row=$result->fetch_assoc())
		{
			$list.='<option value="'.$row['trans_acc_id'].'">'.$row['trans_acc_name'].'</option>';
		}
		return $list;
	}
	function ob($dt_frm, $dt_to, $transacc)
	{
		date_default_timezone_set("Asia/Karachi");
		$ob="";
		if($this->u_value("trans_acc", "dr_cr", "trans_acc_id=".$transacc."")=='dr')
		{
			$ob=$this->u_value("trans_acc", "amount", "trans_acc_id=".$transacc."");
		}
		if($this->u_value("trans_acc", "dr_cr", "trans_acc_id=".$transacc."")=='cr')
		{
			$ob='-'.$this->u_value("trans_acc", "amount", "trans_acc_id=".$transacc."");
		}
		$old_date =$dt_frm;
		$new_date = date("d-m-Y", strtotime($old_date) );
		$prev_date = date("d-m-Y", strtotime('-1 days', strtotime($new_date)) );
		$date1=$this->u_value("trans", "trans_date", "trans_acc_id='$transacc' AND status='approved' ORDER BY trans_date ASC LIMIT 1");
		$cr=$this->u_total("trans", "amount", "STR_TO_DATE(trans_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$date1."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND 
		trans_acc_id='$transacc' AND dr_cr='cr' AND status='approved'");
		$dr=$this->u_total("trans", "amount", "STR_TO_DATE(trans_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$date1."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND 
		trans_acc_id='$transacc' AND dr_cr='dr' AND status='approved'");
		$bal=($dr)-($cr)+($ob);
		return $bal;
		//return $this->show_bal_format($ob);
	}
	function trans_code()
	{
		$code=0;
		$code=$this->u_value("trans","trans_code", "1 ORDER BY trans_id DESC LIMIT 1 ");
		$codeVal=$code+1;
		return $codeVal;
	}
	function vt()
	{
		$list="";
		$array=array("RV","PV","CD","JV");
		foreach($array as $val)
		{
			$list.='<option value="'.$val.'">'.$val.'</option>';
		}
		return $list;
	}
	//fetch the monthly wise sale reports in graphical mode
	function monthly_sale($dfrm, $dto)
	{
		if($this->user_access('branch_admin', $_SESSION['sessionId']))
		{
		$ticket=$this->u_total("add_sale","recieved","STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$dfrm."', '%d-%m-%Y') AND STR_TO_DATE('".$dto."', '%d-%m-%Y') AND branch=".$_SESSION['branch_id']."");
		$other_sale=$this->u_total("other_sale","recieved","STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$dfrm."', '%d-%m-%Y') AND STR_TO_DATE('".$dto."', '%d-%m-%Y') AND branch=".$_SESSION['branch_id']."");
		$tourSale=tourSale::mon_t_t_inv($dfrm,$dto);
		}
		else
		{
			$ticket=$this->u_total("add_sale","recieved","STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$dfrm."', '%d-%m-%Y') AND STR_TO_DATE('".$dto."', '%d-%m-%Y') AND salesStaff=".$_SESSION['sessionId']."");
		$other_sale=$this->u_total("other_sale","recieved","STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$dfrm."', '%d-%m-%Y') AND STR_TO_DATE('".$dto."', '%d-%m-%Y') AND salesStaff=".$_SESSION['sessionId']."");
		$tourSale=tourSale::mon_t_t_inv($dfrm,$dto);
		}
		return ($ticket+$other_sale+$tourSale);
	}
	// Types of Team
	function team_list($team_id="")
	{
		$list="";
		$result=$this->selectData("teams", "1");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($team_id==$row['team_id'])?'selected':"").' value="'.$row['team_id'].'">'.$row['team_name'].'</option>';
		}
		return $list;
	}
	// departments list
	function deparments($dep_id="")
	{
		$list="";
		$result=$this->selectData("departments","1");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($row['dep_id']==$dep_id)?"selected":"").' value="'.$row['dep_id'].'">'.$row['dep_name'].'</option>';
		}
		return $list;
	}
	// team leaders
	function team_leaders($team_id, $branch)
	{
		$list="";
		$result=$this->selectData("user","status='active' AND team_leader='yes' AND branch_id=".$branch."");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($row['id']==$team_id)?"selected":"").' value="'.$row['id'].'">'.$row['name'].'</option>';
		}
		return $list;
	}
}
?>