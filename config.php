<?php
    /* ------- PROJECT -------
    ------------------------*/

    $project_name   =   "projeck_army";

    /* ------- DATABASE CONFIG -------
    ---------------------------------*/
    $db_server      = 'localhost';
    $db_user        = 'root';
    $db_password    = '';
    $db_name        = 'pj_army';







    /* ------------ PATH ------------
    -------------------------------*/

    $root_doc   =   $_SERVER['DOCUMENT_ROOT'];
    $root_path  =   $_SERVER['HTTP_HOST'];
    $path       =   "{$root_path}/{$project_name}";  


    /* --------- DB Connect ---------
    -------------------------------*/
    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    mysqli_set_charset($conn, "utf8");
?>