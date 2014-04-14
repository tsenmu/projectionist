<?php

require_once('database.php');
//print_r($config);

$ret = is_password_match(177,"123qwe123");
echo $ret."<br>";

//$ret = insert_user(1, 1,0);
//$ret = insert_user(2, 2,1);
//$ret = insert_user(3, 3,2);
//$ret = insert_user(4, 4,3);

//$ret = insert_chain("Beijing Movie Academy");
//$ret = insert_chain("Xi\'an Movie Academy");


//print_r(get_all_film());

//print_r(get_all_chain());


$sql = "SELECT * FROM films WHERE film_name =  '大闹天宫' AND chain_id = '11' ";
	$film_info=get_through_sqlCommand($sql);
	print_r($film_info);

print_r(get_all_film_info());	
	
?>

