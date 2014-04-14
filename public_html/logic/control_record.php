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
	$sql = "UPDATE records SET film_id='$film_id', date_time='$date_time', location='$location' WHERE record_id='$record_id')";
	
	if(execute_sqlCommand($sql))
	{
		return "UPDATE_RECORD_SUCCESS";
	}
	else
		return "ERROR_UPDATE_RECORD";
}


function delete_record($record_id)
{
	$sql="DELETE record WHERE record_id = '$record_id'";
	
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
			$temp_user_name=get_user_name_by_user_id($temp_id);
			if(is_user_exist($temp_user_name))
			{
			
				$queue[$tail]=$temp_child[$i]["child_user_id"];
				$tail++;
			}
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
?>
