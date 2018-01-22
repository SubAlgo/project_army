<?php

    include_once "inc.php";

?>

<?php
    /*--------------------------------
        Check Login
        ถ้ายังไม่ได้ login ให้ไปที่หน้า index
    --------------------------------*/
    if (!isset($_SESSION['userid'])) {
        header("Location: //{$path}/index.php");
        die();
    }


    /*--------------------------------
        Check Permission Access
        ถ้า permission != 1 ให้เรียก function redir เพื่อไปหน้า ตาม permission ที่ได้รับสิทธิ
    --------------------------------*/
    if(isset($_SESSION['permission']) && ($_SESSION['permission'] != 1)) {
        redir();
    }

    echo "{$_SESSION['userid']} <br>";
    echo "{$_SESSION['permission']} <br>";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
    <?php
        echo "<link rel='stylesheet' type='text/css' href='//{$path}/css/mystyle.css'>";
        echo "<link rel='stylesheet' type='text/css' href='//{$path}/css/w3school.css'>";
        echo "<link rel='stylesheet' type='text/css' href='//{$path}/css/table.css'>";
    ?>

   
    
    <title>Admin</title>
</head>
<body>
    <div class="container">

<?php
    include "./layout/header.php";
    include './layout/admin_nav.php';
?>

<!-- +++++++++++++++++ Content +++++++++++++++++ -->


<article>
    <a href="./user_add.php">เพิ่ม ผู้ใช้งาน</a>
    <hr>
  <?php
        //$sql  = "SELECT user_id, user_name, user_surname,  FROM users";
        $sql  = "SELECT users.user_id, users.user_name, users.user_surname, users.permission_id, permission.permission_title 
                 FROM users
                 INNER JOIN permission ON users.permission_id = permission.permission_id
                 ORDER BY users.permission_id";

       // SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
//FROM Orders
//INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table id='customers'>
                    <tr>
                        <th>UserID</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>ระดับสิทธิ์</th>
                        <th colspan='2'>แก้ไข/ลบ</th>
                    </tr>";

                    while($row = $result->fetch_assoc())
                    {
                        echo "<tr>
                                <td>{$row['user_id']}</td>
                                <td>{$row['user_name']} </td>
                                <td>{$row['user_surname']}</td>
                                <td>{$row['permission_title']}</td>
                                <td>
                                    <a href='./user_edit.php/?id={$row['user_id']}'>แก้ไข</a>
                                                         
                                </td>
                                <td>
                                    <a href='./user_del.php/?id={$row['user_id']}'>ลบ</a> 
                                </td>
                              </tr>";
                    }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
      ?>
      

      
</article>

<!-- +++++++++++++++++ Content +++++++++++++++++ -->

<?php
    include './layout/foot.php';
?>



</div>
    
</body>
</html>