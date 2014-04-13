<?php 
/*
This php file is used for interacting with database

*/

/* Connect Database*/
function connect_database()
{
	$dbhost = 'vps.tsenmu.com';
	$dbuser = 'projectionist';
	$dbpass = '123qwe123';
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
function insert_user($user_name, $user_password, $user_type)
{

	$hash_user_password=md5($user_password);
	
	$sql= "INSERT INTO users(user_name,user_password,user_type) VALUES ('$user_name', '$hash_user_password', '$user_type')";
	//$sql= "INSERT INTO users(user_name,user_password,user_type) VALUES ('hehe', 'qq', '0')";
	insert_through_sqlCommand($sql);

}

function insert_records()
{
	
}

function insert_films()
{
}

function insert_chains()
{

}


function is_user_exist($user_name,$user_password)
{
	$sql="SELECT user_password FROM users WHERE user_name = '$user_name'";
	$result=get_through_sqlComman($sql);
	//user name doesn't exist
	if($result == 0)
	{
		echo " This user is not exist! <br>";
		
	}
	else
	{
		if($result["user_password"] == md5($user_password))
		{
			echo "password match <br>";
			return 1;
		}
		else
		{
			return 0;
		}
	}
	return 0;
}



?>
<?php
/*test*/
insert_user(77,"123qwe123",1);

$res=get_through_sqlCommand("SELECT * FROM users WHERE user_name = '12' ");

echo $res["user_password"];
?>
