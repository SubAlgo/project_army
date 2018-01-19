<?php
    include_once "../inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
     echo "{$_SESSION['userid']} <br>";
                    echo "{$_SESSION['permission']} <br>";
                    echo "{$_COOKIE['userid']} <br>";
    echo $link;
    echo "<a href='http://localhost/projeck_army/index.php'>index</a>";
                ?>
               
    
</body>
</html>