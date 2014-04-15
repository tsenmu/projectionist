<?php
ini_set("display_errors", 1);
error_reporting(E_ALL ^ E_NOTICE);
$config = array(
    "db" => array(
        "dbname" => "projectionist",
        "username" => "projectionist",
        "password" => "123qwe123",
      //  "host" => "159.226.178.62"
        "host" => "localhost"
      ),
    "urls" => array(
      "baseUrl" => "localhost"
      ),
    "paths" => array(
        "images" => array(
            "content" => $_SERVER["DOCUMENT_ROOT"]. "/images/content",
            "layout" => $_SERVER["DOCUMENT_ROOT"]."/images/layout"
        ),
        "includes" => $_SERVER["DOCUMENT_ROOT"] . "/includes"
    ),
    "vars" => array(
        "title" => "电影放映管理系统",
        "project_name" => "电影放映管理系统"
    ),
    "includes" => array(
        "header" => $_SERVER["DOCUMENT_ROOT"] ."/includes" . "/header.inc.php",
        "footer" => $_SERVER["DOCUMENT_ROOT"] ."/includes" . "/footer.inc.php" 
    )
);


defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__).'/library'));

defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__).'/templates'));

?>
    
