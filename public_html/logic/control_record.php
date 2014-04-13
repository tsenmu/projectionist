<?php
require_once('database.php');

function get_record($user_id)
{
	$parent_user_id=$user_id;
	$sql= "SELECT child_user_id FROM user_tree START WITH parent_user_id = '$parent_user_id'".
	"CONNECT BY PRIOR parent_user_id=child_user_id";
		
		
	$sql= "SELECT * FROM user_tree WHERE parent_user_id = '$parent_user_id'";
	$all_child_user=get_all_sqlCommand($sql);
	
	$all_id=$all_child_user;
	$all_id[count($all_id)+1]["child_user_id"]=$parent_user_id;
	echo count($all_id);
	
	
	
	for($i=0;$i<3;$i++)
	{
		echo $all_id[$i]["child_user_id"];
		$temp=$all_id[$i]["child_user_id"];
		$sql="SELECT * FROM records WHERE user_id = '$temp'";
		$record[$i]=get_all_sqlCommand($sql);
	}
	
	
	echo "count:";
	echo count(record);
	return $record;
}

$ret=get_record(1);

echo "haha";
echo $ret[0]["location"]."<br>";
echo $ret[1]["location"]."<br>";
echo $ret[2]["location"]."<br>";

?>