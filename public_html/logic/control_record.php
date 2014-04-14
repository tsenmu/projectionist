<?php
require_once('database.php');
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
			$queue[$tail]=$temp_child[$i]["child_user_id"];
			$tail++;
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
	return $record;
}

?>