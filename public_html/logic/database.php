<?php
/*
This php file is used for basically interacting with database

*/

/* Connect Database*/


require_once(dirname(__FILE__) . '/../../resources/config.php');
$dbhost = $config["db"]["host"];
$dbuser = $config["db"]["username"];
$dbpass = $config["db"]["password"];
$dbname = $config["db"]["dbname"];
function connect_database()
{
    global $dbhost, $dbuser, $dbpass, $dbname;
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(! $conn)
	{
		die ('Could not connect: '.mysql_error());
	}
	return $conn;
}


function get_through_sqlCommand($sql)
{
	$conn=connect_database();
	
	mysql_select_db('projectionist');
	$retval=mysql_query($sql,$conn);
	
	if(!$retval)
	{
		return 0;
		//die('Could not get data : '.mysql_error());
	}
	$row = mysql_fetch_assoc($retval);
	
	mysql_free_result($retval);
	
	
	mysql_close($conn);
	
	return $row;
}

function get_all_sqlCommand($sql)
{
	$conn=connect_database();
	
	mysql_select_db('projectionist');
	$retval=mysql_query($sql,$conn);
	
	
	
	if(!$retval)
	{
		return 0;
		//die('Could not get data : '.mysql_error());
	}
	$i=0;
	while($row = mysql_fetch_assoc($retval))
	{
		$res_array[$i]=$row;
		$i++;
	}
	
	mysql_free_result($retval);
	
	
	mysql_close($conn);
	return $res_array;
	
}
function execute_sqlCommand($sql)
{
	$conn=connect_database();
	
	mysql_select_db('projectionist');
	$retval=mysql_query($sql,$conn);
	
	if(!$retval)
	{
		return 0;
		//die(mysql_error());
	}
	
	
	mysql_close($conn);
	return 1;
}

/*
Control User =============
*/

function insert_user($user_name, $user_password,$parent_user_name)
{
	if($user_name==NULL)
	{
		return "ERROR_USER_NAME_NULL";
	}
	if(is_user_exist($user_name))
	{
		return "ERROR_USER_EXIST";
	}
	$hash_user_password=md5($user_password);
	
	$parent_user_info=get_user_info($parent_user_name);
	$user_type=$parent_user_info["user_type"]+1;
	$parent_user_id=$parent_user_info["user_id"];
	
	
	$sql= "INSERT INTO users(user_name,user_password,user_type) VALUES ('$user_name', '$hash_user_password', '$user_type')";
	
	if(execute_sqlCommand($sql))
	{
		$child_user_id=get_user_id($user_name);
		
		$sql= "INSERT INTO user_tree(parent_user_id,child_user_id) VALUES ('$parent_user_id', '$child_user_id')";
	
		if(execute_sqlCommand($sql))
		{
			return "INSERT_USER_SUCCESS";
		}
		else
		{
			return "ERROR_INSERT_USER_TREE";
		}
	}
	else
	{
		return "ERROR_INSERT_USER";
	}
}
function get_parent_user_info()
{
	//放映员不显示
	$sql = "SELECT * FROM users WHERE user_available ='1' AND user_type < '2'";
	
	$user_array=get_all_sqlCommand($sql);
	
	return $user_array;
	
}

function get_child_user_info()
{
	//管理员不显示
	$sql = "SELECT * FROM users WHERE user_available ='1' AND user_type > '0' ";
	
	$user_array=get_all_sqlCommand($sql);
	
	return $user_array;
	
}

function get_all_user_info()
{

	$sql = "SELECT * FROM users WHERE user_available ='1' ";
	
	$user_array=get_all_sqlCommand($sql);
	
	return $user_array;
	
}
function get_user_info($user_name)
{
	if(!is_user_exist($user_name))
	{
		return "ERROR_USER_NOT_EXIST";
	}
	
	$sql="SELECT * FROM users WHERE user_name ='$user_name' AND user_available = '1'";
	
	$user_info=get_through_sqlCommand($sql);
	
	return $user_info;
}
function get_user_type($user_name)
{
	$user_info=get_user_info($user_name);
	return $user_info["user_type"];
}

function get_user_id($user_name)
{
	$user_info=get_user_info($user_name);
	return $user_info["user_id"];
}

function get_user_name_by_id($user_id)
{
	$sql="SELECT * FROM users WHERE user_id ='$user_id'";
	
	$user_info=get_through_sqlCommand($sql);
	
	return $user_info["user_name"];
}
function delete_user($user_name)
{
	if(!is_user_exist($user_name))
	{
		return "ERROR_USER_NOT_EXIST";
	}
	
	$sql="SELECT * FROM users WHERE user_name = '$user_name'";
	$res=get_through_sqlCommand($sql);
	
	if($res["user_type"]==0)
	{
		return "ERROR_DELETE_USER_ADMIN";
	}
	
	$sql= "UPDATE users SET user_available = '0' WHERE user_name= '$user_name' AND user_available= '1'";
	
	if(execute_sqlCommand($sql))
	{
		return "DELETE_USER_SUCCESS";
	}
	else
	{
		return "ERROR_DELETE_USER";
	}
	
}
function update_user_password($user_name,$user_old_password,$user_new_password)
{
	if(!is_user_exist($user_name))
	{
		return "ERROR_USER_NOT_EXIST";
	}
	$user_old_password=md5($user_old_password);
	$sql = "SELECT * FROM users WHERE user_name = '$user_name' AND user_available = '1' AND user_password = '$user_old_password'";
	$ret=get_through_sqlCommand($sql);
	if($ret==NULL)
	{
		return "ERROR_USER_OLD_PASSWORD";
	}
	
	$user_new_password=md5($user_new_password);
	
	$sql="UPDATE users SET user_password = '$user_new_password' WHERE user_name = '$user_name' AND user_available = '1' ";
	
	if(execute_sqlCommand($sql))
	{
		return "UPDATE_PASSWORD_SUCCESS";
	}
	return "ERROR_UPDATE_USER_PASSWORD";
}
function update_user_name($user_name,$user_new_name)
{
	if($user_name==NULL||$user_new_name==NULL)
	{
		return "ERROR_USER_NAME_NULL";
	}
	if(!is_user_exist($user_name))
	{
		return "ERROR_USER_NOT_EXIST";
	}
	
	$user_new_password=md5($user_new_password);
	$sql="UPDATE users SET user_name = '$user_new_name' WHERE user_name = '$user_name' AND user_available = '1' ";
	
	if(execute_sqlCommand($sql))
	{
		return "UPDATE_PASSWORD_SUCCESS";
	}
}

function update_user($user_id, $user_new_name, $user_new_password,$new_parent_user_name)
{
	if($user_new_name==NULL)
	{
		return "ERROR_USER_NEW_NAME_NULL";
	}
	$sql = "SELECT * FROM users WHERE user_id = '$user_id' AND user_available='1'";
	
	$res=get_through_sqlCommand($sql);
	if(!$res)
	{
		return "ERROR_USER_ID";
	}
	
	if(is_user_exist($user_new_name)&&($res["user_name"]!=$user_new_name))
	{
		return "ERROR_USER_NEW_NAME_EXIST";
	}
	
	$parent_user_info=get_user_info($new_parent_user_name);
	$user_type=$parent_user_info["user_type"]+1;
	$parent_user_id=$parent_user_info["user_id"];
	
	if($user_new_password!=NULL)
	{
			
		$hash_user_password=md5($user_new_password);
		$sql= "UPDATE users SET user_name = '$user_new_name', user_password = '$hash_user_password',user_type='$user_type' WHERE user_id = '$user_id'";
	}
	else
	{
		$sql= "UPDATE users SET user_name = '$user_new_name',user_type='$user_type' WHERE user_id = '$user_id'";
	}
	
	if(execute_sqlCommand($sql))
	{
		$sql= "UPDATE user_tree SET parent_user_id='$parent_user_id' WHERE child_user_id='$user_id'";
	
		if(execute_sqlCommand($sql))
		{
			return "UPDATE_USER_SUCCESS";
		}
		else
		{
			return "ERROR_UPDATE_USER_TREE";
		}
	}
	else
	{
		return "ERROR_UPDATE_USER";
	}
}
/*judge whether this user exists or not*/
function is_user_exist($user_name)
{
	$sql="SELECT * FROM users WHERE user_name = '$user_name' AND user_available = '1' ";
	$result=get_through_sqlCommand($sql);
	//user name doesn't exist
	if($result == 0)
	{
		return 0;
	}
	else
	{
		return 1;
	}
}

function is_password_match($user_name,$user_password)
{
	if(is_user_exist($user_name) == 0)
	{
		return "ERROR_USER_NAME";
	}
	else
	{
		$user_info=get_user_info($user_name);
		if($user_info["user_password"] == md5($user_password))
		{
			return "SUCCESS";
		}
		else
		{
			return "ERROR_USER_PASSWORD";
		}
	}
}

function get_parent_user_id($child_user_id)
{
	$sql= "SELECT * FROM user_tree WHERE child_user_id='$child_user_id'";
	$result=get_through_sqlCommand($sql);
	return $result["parent_user_id"];
	
}
//----------------------------------------------------------

//==========Control Chains=========================
function insert_chain($chain_name)
{
	if($chain_name==NULL)
	{
		return "ERROR_CHAIN_NAME_NULL";
	}
	if(is_chain_exist($chain_name))
	{
		return "ERROR_CHAIN_EXIST";
	}
	
	$sql= "INSERT INTO chains(chain_name) VALUES ('$chain_name')";
	
	if(execute_sqlCommand($sql))
	{
		return "INSERT_CHAIN_SUCCESS";
	}
		
}

function update_chain($old_chain_name, $new_chain_name)
{
	if($new_chain_name==NULL)
	{
		return "ERROR_CHAIN_NAME_NULL";
	}
	if(!is_chain_exist($old_chain_name))
	{
		return "ERROR_CHAIN_NOT_EXIST";
	}
	if(is_chain_exist($new_chain_name)&&($new_chain_name!=$old_chain_name))
	{
		return "ERROR_CHAIN_EXIST";
	}
	$sql= "UPDATE chains SET chain_name='$new_chain_name' WHERE chain_name= '$old_chain_name' AND chain_available = '1' ";
	
	if(execute_sqlCommand($sql))
	{
		return "UPDATE_CHAIN_SUCCESS";
	}
}

function get_all_chain_info()
{
	$sql = "SELECT * FROM chains WHERE chain_available = '1'";
	$all_chain_info=get_all_sqlCommand($sql);
	
	return $all_chain_info;

}
function delete_chain($chain_name)
{
	if(!is_chain_exist($chain_name))
	{
		return "ERROR_CHAIN_NOT_EXIST";
	}
	
	//delete related films
	$chain_id=get_chain_id_by_name($chain_name);
	$sql = "SELECT * FROM films WHERE chain_id = '$chain_id' AND film_available = '1'";
	$film=get_all_sqlCommand($sql);
	if($film!=NULL)
	{
		foreach($film as $res)
		{
			delete_film($res["film_id"]);
		}
	}
		
	$sql= "UPDATE chains SET chain_available='0' WHERE chain_name= '$chain_name' AND chain_available = '1' ";
	
	if(execute_sqlCommand($sql))
	{
		return "DELETE_CHAIN_SUCCESS";
	}
}

function is_chain_exist($chain_name)
{
	$sql="SELECT * FROM chains WHERE chain_name = '$chain_name' AND chain_available = '1' ";
	$result=get_through_sqlCommand($sql);
	//user name doesn't exist
	if($result == 0)
	{
		return 0;
	}
	else
	{
		return 1;
	}
}

function get_chain_name_by_id($chain_id)
{
	$sql="SELECT * FROM chains WHERE chain_id = '$chain_id'";
	$result=get_through_sqlCommand($sql);
	//user name doesn't exist
	if($result == 0)
	{
		return "ERROR_CHAIN_NOT_EXIST";
	}
	
	return $result["chain_name"];
}

function get_chain_id_by_name($chain_name)
{
	$sql="SELECT * FROM chains WHERE chain_name = '$chain_name' AND chain_available = '1' ";
	$result=get_through_sqlCommand($sql);
	//user name doesn't exist
	if($result == 0)
	{
		return "ERROR_CHAIN_NOT_EXIST";
	}
	
	return $result["chain_id"];
}


//=============Control Film================
function is_film_exist($film_id)
{
	$sql="SELECT * FROM films WHERE film_id = '$film_id' AND film_available = '1' ";
	$result=get_through_sqlCommand($sql);
	//user name doesn't exist
	if($result == 0)
	{
		return 0;
	}
	else
	{
		return 1;
	}
}


function insert_film($film_userdefine_id, $film_name, $film_path, $chain_id)
{
	if($film_name==NULL)
	{
		return "ERROR_FILM_NAME_NULL";
	}
	$sql= "INSERT INTO films(film_userdefine_id,film_name,film_path,chain_id)".
	"VALUES ('$film_userdefine_id','$film_name', '$film_path', '$chain_id')";
	
	if(execute_sqlCommand($sql))
	{
		return "INSERT_FILM_SUCCESS";
	}
	return "ERROR_INSERT_FILM";
}

function delete_film($film_id)
{
	if(!is_film_exist($film_id))
	{
		return "ERROR_FILM_NOT_EXIST";
	}
	
	$sql= "UPDATE films SET film_available='0' WHERE film_id= '$film_id' ";
	
	if(execute_sqlCommand($sql))
	{
		return "DELETE_FILM_SUCCESS";
	}
}

function update_film($film_id,$film_userdefine_id, $film_name, $film_path, $chain_id)
{
	if($film_name==NULL)
	{
		return "ERROR_FILM_NAME_NULL";
	}
	if(!is_film_exist($film_id))
	{
		return "ERROR_FILM_NOT_EXIST";
	}
	$sql= "UPDATE films SET film_userdefine_id='$film_userdefine_id'," .
	"film_name='$film_name',film_path='$film_path',chain_id='$chain_id'".
	"WHERE film_id ='$film_id' ";
	
	if(execute_sqlCommand($sql))
	{
		return "UPDATE_FILM_SUCCESS";
	}
	
}

function get_film_name_by_id($film_id)
{
	$sql = "SELECT * FROM films WHERE film_id =  '$film_id'";
	$film_info=get_through_sqlCommand($sql);
	if($film_info==0)
	{
		return "ERROR_FILM_NOT_EXIST";
	}
	return $film_info["film_name"];
}

function get_film_info_by_id($film_id)
{
	$sql = "SELECT * FROM films WHERE film_id =  '$film_id'";
	$film_info=get_through_sqlCommand($sql);
	if($film_info==0)
		return "ERROR_FILM_NOT_EXIST";
		
	return $film_info;
}

function get_film_info_by_film_name_and_chain_id($film_name,$chain_id)
{
	$sql = "SELECT * FROM films WHERE film_name =  '$film_name' AND chain_id = '$chain_id' AND film_available='1' ";
	$film_info=get_through_sqlCommand($sql);
	return $film_info;
}

function get_film_info_by_film_name_and_chain_name($film_name,$chain_name)
{
	$chain_id=get_chain_id_by_name($chain_name);
	$sql = "SELECT * FROM films WHERE film_name =  '$film_name' AND chain_id = '$chain_id' AND film_available='1' ";
	$film_info=get_through_sqlCommand($sql);
	return $film_info;
}

function get_film_info_by_film_name($film_name)
{
	$sql = "SELECT * FROM films WHERE film_name =  '$film_name' AND film_available = '1' ";
	$film_info=get_all_sqlCommand($sql);
	return $film_info;
}	

function get_all_film_info()
{
	$sql = "SELECT * FROM films WHERE film_available = '1' ORDER BY film_name";
	$film_info=get_all_sqlCommand($sql);
	return $film_info;
}

function get_all_film_name()
{
	$sql = "SELECT DISTINCT film_name FROM films WHERE film_available = '1' ORDER BY film_name";
	$film_info=get_all_sqlCommand($sql);
	return $film_info;
}

function get_user_type_str($type)
{
    if ($type == 0) return "区级";
    if ($type == 1 ) return "县级";
    if ($type == 2) return "放映员";
}
//==============Control User Tree=========
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

/*test*/
//insert_user(77,"123qwe123",3);
//echo is_password_match(177,"123qwe123");

//$res=get_through_sqlCommand("SELECT * FROM users WHERE user_name = '77' ");

//echo $res["user_password"];

?>
