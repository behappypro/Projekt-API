<?php
    // Aktivera felrapportering
    error_reporting(-1);
    ini_set("display_errors", 1);

    session_start();
    
    /* Utskrift */
    header("Content-Type:application/json; charset=UTF-8");
    // Gör webbtjänsten tillgänglig från alla domäner
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Methods:POST,GET,DELETE,PUT");
    header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods, Authorization, X-Requested-With");

    // Aktivera autoload för att snabba upp registering av klasserna
    spl_autoload_register(function ($class_name) {
        include "classes/". $class_name . ".class.php";
    });
   
 /*
    define ("DBHOST", "studentmysql.miun.se");
    define ("DBUSER", "asha1900");
    define ("DBPASS", "bsan1x7m");
    define ("DBDATABASE", "asha1900");
    */