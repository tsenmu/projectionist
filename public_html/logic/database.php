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
	echo "Connected Successfully <br>";
	return $conn;
}

function insert_through_sqlCommand($sql)
{
	$conn=connect_database();
	
	mysql_select_db('projectionist');
	$retval=mysql_query($sql,$conn);
	
	if(!$retval)
	{
		die('Could not insert data into the table: '.mysql_error());
	}
	
	echo "Insert user data successfully!<br>";
	
	mysql_close($conn);
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
	
	echo "get data successfully!<br>";
	
	mysql_close($conn);
	
	return $row;
}

function update_through_sqlCommand($sql)
{
	$conn=connect_database();
	
	mysql_select_db('projectionist');
	$retval=mysql_query($sql,$conn);
	
	if(!$retval)
	{
		die('Could not update data: '.mysql_error());
	}
	
	echo "Update data successfully!<br>";
	
	mysql_close($conn);
}

function delete_through_sqlCommand($sql)
{
	$conn=connect_database();
	
	mysql_select_db('projectionist');
	$retval=mysql_query($sql,$conn);
	
	if(!$retval)
	{
		die('Could not delete data: '.mysql_error());
	}
	
	echo "Delete data successfully!<br>";
	
	mysql_close($conn);
}



/*
Control User 
*/
function insert_user($user_name, $user_password, $user_type)
{
	if(is_user_exist($user_name))
	{
		return "ERROR_USER_EXIST";
	}
	$hash_user_password=md5($user_password);
	
	$sql= "INSERT INTO users(user_name,user_password,user_type) VALUES ('$user_name', '$hash_user_password', '$user_type')";
	
	insert_through_sqlCommand($sql);

}

function get_user_Info($user_name)
{
	if(!is_user_exist($user_name))
	{
		return "ERROR_USER_NOT_EXIST";
	}
	
	$sql="SELECT * FROM users WHERE user_name ='$user_name'";
	
	$user_info=get_through_sqlCommand($sql);
	
	return $user_info;
}

function delete_user($user_name)
{
	if(!is_user_exist($user_name))
	{
		return "ERROR_USER_NOT_EXIST";
	}

	$sql= "UPDATE users SET user_available = '0' WHERE user_name= $user_name";
	
	update_through_sqlCommand($sql);
	
}
function update_user_password($user_name,$user_new_password)
{
	if(!is_user_exist($user_name))
	{
		return "ERROR_USER_NOT_EXIST";
	}
	
	$sql="UPDATE users SET user_password = '$user_new_password' WHERE user_name = '$user_name'";
	
	update_through_sqlCommand($sql);
}

/*judge whether this user exists or not*/
function is_user_exist($user_name)
{
	$sql="SELECT user_password FROM users WHERE user_name = '$user_name' AND user_available = '1' ";
	$result=get_through_sqlCommand($sql);
	//user name doesn't exist
	if($result == 0)
	{
		echo " This user is not exist! <br>";
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
		echo " This user is not exist! <br>";
		return "ERROR_USER_NAME";
	}
	else
	{
		$user_info=get_user_Info($user_name);
		if($user_info["user_password"] == md5($user_password))
		{
			echo "password match <br>";
			return "SUCCESS";
		}
		else
		{
			return "ERROR_USER_PASSWORD";
		}
	}
}
//----------------------------------------------------------

//==========Control Chains=========================
function insert_chain($chain_name)
{
	$sql= "INSERT INTO chains(chain_name) VALUES ('$chain_name')";
	
	insert_through_sqlCommand($sql);
}

function delete_chain($chain_name)
{
	$sql= "UPDATE chains SET chain_available='0' WHERE chain_name= '$chain_name' ";
	
	update_through_sqlCommand($sql);
}

//=============Control Film================

function insert_film($film_name, $film_path, $chain_id)
{
	$sql= "INSERT INTO films(film_name,film_path,chain_id) VALUES ('$film_name', '$film_path', '$chain_id')";
	
	insert_through_sqlCommand($sql);
}

function delete_film($film_name, $film_path, $chain_id)
{
	$sql= "UPDATE films SET film_available='0' WHERE film_name= '$film_name' ";
	
	update_through_sqlCommand($sql);
}


//============Control Record=========
function insert_record($user_id,$film_id,$chain_id,$date_time,$location)
{
	$sql= "INSERT INTO records(user_id,film_id,chain_id,date_time,location) VALUES ('$user_id', '$film_id', '$chain_id','$date_time','$location')";
	
	insert_through_sqlCommand($sql);
}





/*test*/
//insert_user(77,"123qwe123",3);
//echo is_password_match(177,"123qwe123");

//$res=get_through_sqlCommand("SELECT * FROM users WHERE user_name = '77' ");

//echo $res["user_password"];
?>
