<?php
function is_admin_login()
{
	if(isset($_SESSION['admin_id']))
	{
		return true;
	}
	return false;
}

function is_user_login()
{
	if(isset($_SESSION['user_id']))
	{
		return true;
	}
	return false;
}
function base_url()
{
	return 'http://localhost/DBMS_project/';
}
function fill_cattle_ID($connect)
{
	$query = "
	SELECT cattle_id FROM cattle WHERE milk_status=1;
	";

	$result = $connect->query($query);

	$output = '<option value="">Select Cattle</option>';

	foreach($result as $row)
	{
		$output .= '<option value="'.$row["cattle_id"].'">'.$row["cattle_id"].'</option>';
	}

	return $output;
}
function fill_Dealer_ID($connect)
{
	$query = "
	SELECT dealer_id FROM dealers ORDER BY dealer_id ASC;
	";

	$result = $connect->query($query);

	$output = '<option value="">Select Dealer</option>';

	foreach($result as $row)
	{
		$output .= '<option value="'.$row["dealer_id"].'">'.$row["dealer_id"].'</option>';
	}

	return $output;
}
?>
