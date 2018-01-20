<?php
    include_once('inc.php');
    
    if(!isset($_SESSION['userid'])) {
        header("Location: http://localhost/projeck_army/index.php");
        exit;
    } else {
        unset($_SESSION['userid']);
        unset($_SESSION['permission']);
        setcookie('userid', null, time()-3600);

        header("Location: http://localhost/projeck_army/index.php");
        exit;
    }
    
    /*
    echo "<br>";
    echo $_SESSION['userid'];
    echo "<br>";

    echo $_SESSION['permission'];
    echo "<br>";
    echo $_SESSION['userid'];
    */
?>