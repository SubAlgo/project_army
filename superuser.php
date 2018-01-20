<?php

    include_once "inc.php";

?>

<?php
    /*--------------------------------
        Check Login
        ถ้ายังไม่ได้ login ให้ไปที่หน้า index
    --------------------------------*/
    if (!isset($_SESSION['userid'])) {
        header("Location: {$link}/index.php");
        die();
    }

    /*--------------------------------
        Check Permission Access
        ถ้า permission != 1 ให้เรียก function redir เพื่อไปหน้า ตาม permission ที่ได้รับสิทธิ
    --------------------------------*/
    if(isset($_SESSION['permission']) && ($_SESSION['permission'] != 2)) {
        redir();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" type="text/css" href="/projeck_army/css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="/projeck_army/css/w3school.css">
    
    <title>Super User</title>
</head>
<body>
    <div class="container">

<?php
    include "./layout/header.php";
    include './layout/superuser_nav.php';
?>

<!-- +++++++++++++++++ Content +++++++++++++++++ -->


<article>
  <h1>London</h1>
  <p>London is the capital city of England. It is the most populous city in the  United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
  <p>Standing on the River Thames, London has been a major settlement for two millennia, its history going back to its founding by the Romans, who named it Londinium.</p>
</article>

<!-- +++++++++++++++++ Content +++++++++++++++++ -->

<?php
    include './layout/foot.php';
?>



</div>
    
</body>
</html>