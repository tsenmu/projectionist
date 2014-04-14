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
	}
}
function get_parent_user_info()
{
	//放映员不显示
	$sql = "SELECT * FROM users WHERE user_available ='1' AND user_type < '3'";
	
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
	//管理员不显示
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
	
	$sql="SELECT * FROM users WHERE user_name ='$user_name'";
	
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

function get_user_name_by_user_id($user_id)
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

	$sql= "UPDATE users SET user_available = '0' WHERE user_name= $user_name";
	
	if(execute_sqlCommand($sql))
	{
		return "DELETE_USER_SUCCESS";
	}
	
}
function update_user_password($user_name,$user_new_password)
{
	if(!is_user_exist($user_name))
	{
		return "ERROR_USER_NOT_EXIST";
	}
	
	$user_new_password=md5($user_new_password);
	$sql="UPDATE users SET user_password = '$user_new_password' WHERE user_name = '$user_name'";
	
	if(execute_sqlCommand($sql))
	{
		return "UPDATE_PASSWORD_SUCCESS";
	}
}

/*judge whether this user exists or not*/
function is_user_exist($user_name)
{
	$sql="SELECT user_password FROM users WHERE user_name = '$user_name' AND user_available = '1' ";
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
	if(!is_chain_exist($old_chain_name))
	{
		return "ERROR_CHAIN_NOT_EXIST";
	}
	
	$sql= "UPDATE chains SET chain_name='$new_chain_name' WHERE chain_name= '$old_chain_name' ";
	
	if(execute_sqlCommand($sql))
	{
		return "UPDATE_CHAIN_SUCCESS";
	}
}

function get_all_chain_info()
{
	$sql = "SELECT * FROM chains";
	$all_chain_info=get_all_sqlCommand($sql);
	
	return $all_chain_info;

}
function delete_chain($chain_name)
{
	if(!is_chain_exist($chain_name))
	{
		return "ERROR_CHAIN_NOT_EXIST";
	}
	$sql= "UPDATE chains SET chain_available='0' WHERE chain_name= '$chain_name' ";
	
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
	$sql="SELECT * FROM chains WHERE chain_id = '$chain_id' AND chain_available = '1' ";
	$result=get_through_sqlCommand($sql);
	//user name doesn't exist
	if($result == 0)
	{
		return "ERROR_CHAIN_NOT_EXIST";
	}
	
	return $result["chain_name"];
}
function get_all_chain()
{
	$sql="SELECT * FROM chains";
	$result=get_all_sqlCommand($sql);
	//user name doesn't exist
	if($result == NULL)
	{
		return "ERROR_CHAIN_NOT_EXIST";
	}
	
	return $result;
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
	
	$sql= "INSERT INTO films(film_userdefine_id,film_name,film_path,chain_id)".
	"VALUES ('$film_userdefine_id','$film_name', '$film_path', '$chain_id')";
	
	if(execute_sqlCommand($sql))
	{
		return "INSERT_FILM_SUCCESS";
	}
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
	if(!is_film_exist($film_id))
	{
		return "ERROR_FILM_NOT_EXIST";
	}
	$sql = "SELECT * FROM films WHERE film_id =  '$film_id'";
	$film_info=get_through_sqlCommand($sql);
	return $film_info["film_name"];
}

function get_all_film()
{
	$sql = "SELECT * FROM films";
	$film_info=get_all_sqlCommand($sql);
	return $film_info;
}


//==============Control User Tree=========


/*test*/
//insert_user(77,"123qwe123",3);
//echo is_password_match(177,"123qwe123");

//$res=get_through_sqlCommand("SELECT * FROM users WHERE user_name = '77' ");

//echo $res["user_password"];

?>
