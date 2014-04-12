<?php
$config = array(
    "db" => array(
      "db1" => array(
          "dbname" => "database1"
          "username" => "dbUser"
        ),
      "db2" => array(
          "dbname" => "database2"
        )
      ),
    "urls" => array(
      "baseUrl" => "http://example.com"
      ),
    "paths" => array(
      "resources" => "/path/to/resources",
      "images" => array(
          "content" => $_SERVER["DOCUMENT_ROOT"]. "/images/content",
          "layout" => $_SERVER["DOCUMENT_ROOT"]."/images/layout"
        )
      )
    );


    defined("LIBRARY_PATH")
      or define("LIBRARY_PATH",realpath(dirname(_FILE_).'/library'));

    defined("TEMPLATES_PATH")
      or define("TEMPLATES_PATH",realpath(dirname(_FILE).'/templates'));

    ini_set("error_reporting",true);
    error_reporting(E_ALL|E_STRCT);


 ?>
    
