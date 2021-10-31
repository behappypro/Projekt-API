<?php
    // Aktivera felrapportering
    error_reporting(-1);
    ini_set("display_errors", 1);

    session_start();
    
    
    list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':' , base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
    
    /* Utskrift */
    header("Content-Type:application/json; charset=UTF-8");
    // Gör webbtjänsten tillgänglig från alla domäner
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Methods:POST,GET,DELETE,PUT");
    header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods, Authorization, X-Requested-With");

/*
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        
        exit;
    } else {
        header('HTTP/1.0 201 Authorized');
        
        header("Content-Type:application/json; charset=UTF-8");
        // Gör webbtjänsten tillgänglig från alla domäner
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Methods:POST,GET,DELETE,PUT");
        header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    }
   */



    // Aktivera autoload för att snabba upp registering av klasserna
    spl_autoload_register(function ($class_name) {
        include "classes/". $class_name . ".class.php";
    });
   
