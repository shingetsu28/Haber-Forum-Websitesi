<?php

    //host
    define("HOST" , "localhost");

    //database
    define("DBNAME" , "forum");

    //user
    define("USER" , "root");

    //password
    define("PASS" , "");

    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."", USER, PASS );

    
