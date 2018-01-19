<?php
    /* 
        ไฟล์นี้จะเป็นไฟล์สำหรับรวมไฟล์ การสร้าง session และ ติดต่อ database
    */
    
    session_start();
    

    $root_path = $_SERVER['DOCUMENT_ROOT'];
    $projeck_folder = 'projeck_army';               //Ex. localhost/projeck_army -> $projeck_folder  = 'projec_army
    $root_path = "{$root_path}/{$projeck_folder}"; //ตัวอย่าง Path = C:/xampp/htdocs/projeck_army

    include_once "{$root_path}/config.php";
    include_once "{$root_path}/db.php";

    $host =  $_SERVER['HTTP_HOST'];

    $link = "/{$projeck_folder}";
    
    //echo "<br>";
    //echo $root_path;
    //echo "<br>";
    echo "link : {$link}";
    //echo "{$path_db}";
?>