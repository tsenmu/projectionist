<?php
require_once('database.php');

//============Control Record=========
function insert_record($user_id,$film_id,$chain_id,$date_time,$location)
{

	$sql= "INSERT INTO records(user_id,film_id,chain_id,date_time,location)".
	" VALUES ('$user_id', '$film_id', '$chain_id','$date_time','$location')";
	
	if(execute_sqlCommand($sql))
	{
		return "INSERT_RECORD_SUCCESS";
	}
	
	else
		return "ERROR_INSERT_RECORD";
}

/*
some confusions in here
*/
function update_record($record_id, $film_id,$chain_id,$date_time,$location)
{
	$sql = "UPDATE records SET film_id='$film_id',chain_id='$chain_id', date_time='$date_time', location='$location' WHERE record_id='$record_id'";
	
	if(execute_sqlCommand($sql))
	{
		return "UPDATE_RECORD_SUCCESS";
	}
	else
		return "ERROR_UPDATE_RECORD";
}

function update_record_by_admin($record_id, $film_id,$chain_id,$user_name,$date_time,$location)
{
	$user_id=get_user_id($user_name);
	if($user_id==NULL)
	{
		return "ERROR_USER_NAME";
	}
	//echo $user_id;
	$sql = "UPDATE records SET film_id='$film_id',chain_id='$chain_id', date_time='$date_time', location='$location',user_id='$user_id' WHERE record_id='$record_id'";
	
	if(execute_sqlCommand($sql))
	{
		return "UPDATE_RECORD_SUCCESS";
	}
	else
		return "ERROR_UPDATE_RECORD";
}

function delete_record($record_id)
{
	$sql="DELETE FROM records WHERE record_id = '$record_id'";
	
	if(execute_sqlCommand($sql))
	{
		return "DELETE_RECORD_SUCCESS";
	}
	else
		return "ERROR_DELETE_RECORD";
}


function get_child_user_tree($parent_user_id)
{
	$sql = "SELECT * FROM user_tree WHERE parent_user_id = '$parent_user_id'";
	$child_user_tree=get_all_sqlCommand($sql);
	return $child_user_tree;
}

/*input parent_user_id and then return itself and all its children's id*/
function get_all_child($parent_user_id)
{
	$tail=0;
	$cur=0;
	
	
	$queue[$tail]=$parent_user_id;
	$tail++;
	
	while($cur<$tail)
	{
		$temp_parent=$queue[$cur];
		$temp_child=get_child_user_tree($temp_parent);
		for($i=0;$i<count($temp_child);$i++)
		{
			//judge whether this child exists or not
			
			$temp_id=$temp_child[$i]["child_user_id"];
			$temp_user_name=get_user_name_by_id($temp_id);
			//if(is_user_exist($temp_user_name))
			//{
			
				$queue[$tail]=$temp_child[$i]["child_user_id"];
				$tail++;
			//}
		}
		$cur++;
	}
	
	return $queue;
}

	
//return all the record which is subordinated by the user 	
function get_record($user_id)
{
	$all_child_user_id=get_all_child($user_id);
	$str_command="SELECT * FROM records WHERE user_id IN ($all_child_user_id[0]";	
	for($i=1;$i<count($all_child_user_id);$i++)
	{
		$str_command .=",$all_child_user_id[$i]";
	}
	$str_command .=')';
	$record=get_all_sqlCommand($str_command);
	if($record != NULL)	
		return $record;
	else
		return array();
}


function show_record($record_id)
{
	$sql = "SELECT * FROM records WHERE record_id='$record_id'";
	$res=get_through_sqlCommand($sql);
	
	if($res == NULL)
	{
		return array();
	}
	$film_name=get_film_name_by_id($res["film_id"]);
	$chain_name=get_chain_name_by_id($res["chain_id"]);
	$user_name=get_user_name_by_id($res["user_id"]);
	$time=$res["date_time"];
	$location=$res["location"];
	
	$record["film_name"]=$film_name;
	$record["chain_name"]=$chain_name;
	$record["user_name"]=$user_name;
	$record["date_time"]=$time;
	$record["location"]=$location;
	
	return $record;
}

//-------------------multi array sort----------
function multi_array_sort($multi_array, $sort_key, $sort=SORT_ASC)
{
	if(is_array($multi_array))
	{
		foreach($multi_array as $row_array)
		{
			if(is_array($row_array))
			{
				$key_array[]=$row_array[$sort_key];
			}
			else
			{
				return false;
			}
		}
	}
	else
	{
		return false;
	}
	array_multisort($key_array,$sort,$multi_array);
	return $multi_array;
}

function get_record_order_by_time($user_id)
{
	$record=get_record($user_id);
	if($record==NULL)
	{
		return "ERROR_RECORD_NULL";
	}
	$res=multi_array_sort($record,"date_time",SORT_DESC);
	return $res;
}

//==============test multiple table connection======
function output_record($user_id)
{
	$resval=get_record_order_by_time($user_id);
    foreach($resval as $res)
	{
		$records[]=show_record($res["record_id"]);
	}
	return $records;
}

//===============Search Records====================

//just for split show result
function split_result($res,$per_page,$page_number)
{
	if(count($res)<= $per_page)
		return $res;
	else
	{
		$start_index=($page_number-1)*$per_page;
		for($i=$start_index;$i<$start_index+$per_page && $i<count($res);$i++)
		{
			$sub_res[]=$res[$i];
		}
	}
	return $sub_res;

}
//user restrict: itself and its child
function search_record_by_single_item($mode="",$search_str,$begin_time="1900-01-01",$end_time="2300-12-12")
{
	$search_result;
	switch($mode)
	{
		case "FILM":
				$sql="SELECT * FROM records WHERE film_id IN (".
				"SELECT film_id FROM films WHERE film_name LIKE '%$search_str%')";
			break;
		case "CHAIN":
				$sql="SELECT * FROM records WHERE chain_id IN (".
				"SELECT chain_id FROM chains WHERE chain_name LIKE '%$search_str%')";
			break;
		case "USER":
				$sql="SELECT * FROM records WHERE user_id IN (".
				"SELECT user_id FROM users WHERE user_name LIKE '%$search_str%')";
			break;
		case "TIME":
				// here should use between and
				$sql="SELECT * FROM records WHERE date_time BETWEEN $begin_time AND $end_time";
			break;
		case "LOCATION":
				$sql="SELECT * FROM records WHERE location LIKE '%$search_str%'";				
			break;
		case "ALL":
				$sql="SELECT * FROM records";	
			break;
		default:		
			$sql="SELECT * FROM records WHERE location LIKE '%$search_str%'";	
			break;
	}
	$search_result=get_all_sqlCommand($sql);
	return $search_result;
}



function search_record($user_id="",$film_name="",$chain_name="",$user_name="",
						$location="",$begin_time="0",$end_time="3100-01-01")
{
    if ($begin_time =="" ) {
        $begin_time = "0";
    }
    if ($end_time == "") {
        $end_time = "3100-01-01";
    }
	$all_child_user_id=get_all_child($user_id);
	$str_command="user_id IN ($all_child_user_id[0]";	
	for($i=1;$i<count($all_child_user_id);$i++)
	{
		$str_command .=",$all_child_user_id[$i]";
	}
	$str_command .=') AND ';
	

	$sql="SELECT * FROM records WHERE ".
		"film_id IN (SELECT film_id FROM films WHERE film_name LIKE '%$film_name%') AND ".
		"chain_id IN (SELECT chain_id FROM chains WHERE chain_name LIKE '%$chain_name%') AND ".
		"user_id IN (SELECT user_id FROM users WHERE user_name LIKE '%$user_name%') AND ".
		$str_command.
		"location LIKE '%$location%' AND ".
		"date_time BETWEEN '$begin_time' AND '$end_time'";	
	$search_result=get_all_sqlCommand($sql);
	return $search_result;
}

?>
