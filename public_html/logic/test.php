<?php
header("Content-Type: text/html; charset=utf-8");
require_once('database.php');
require_once('control_record.php');
//print_r($config);

//$ret = is_password_match(177,"123qwe123");
//echo $ret."<br>";

//$ret = insert_user(1, 1,0);
//$ret = insert_user(2, 2,1);
//$ret = insert_user(3, 3,2);
//$ret = insert_user(4, 4,3);

//$ret = insert_chain("Beijing Movie Academy");
//$ret = insert_chain("Xi\'an Movie Academy");


//print_r(get_all_film());

//print_r(get_all_chain());


//print_r(get_all_chain_info());
//print_r(get_all_film_name());
<<<<<<< HEAD
$res=search_record(1,"","","","C");
=======
$res=search_record(50,"","","","","");
>>>>>>> 646b50736767d5ca197aa8defd5056ac6a1e0e02
print_r($res);
echo "<br>";
print_r(split_result($res,2,1));
echo "<br>";
print_r(split_result($res,2,2));
echo "<br>";
print_r(split_result($res,2,3));
//print_r(update_user(1,"pig","123qwe123","admin"));

//print_r(update_user(3,"pig","123qwe123","7"));
?>

