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
    if(isset($_SESSION['permission']) && ($_SESSION['permission'] == 3)) {
        redir();
    }
    

   // echo "{$_SESSION['userid']} <br>";
    //echo "{$_SESSION['permission']} <br>";
    
?>
<div></div>
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

   
    
    <title>Project_Management</title>
</head>
<body>
    <div class="container">

<?php
    include "./layout/header.php";
    
    $permission = $_SESSION['permission'];

    if($permission == 1) {
        include './layout/admin_nav.php';
    } else if($permission == 2) {
        include './layout/superuser_nav.php';
    } else if($permission == 3) {
        include './layout/user_nav.php';
    }
?>

<!-- +++++++++++++++++ Content +++++++++++++++++ -->


<article>
    
  <?php
        if ($permission == 1 || $permission == 2) {
            echo "<font color='green'><b><a href='./project_add.php'>เพิ่ม รายการโครงการ</a></b></font>";
            echo "<hr>";
        }
    
        //$sql  = "SELECT user_id, user_name, user_surname,  FROM users";
        $sql_success  = "SELECT  PROJECT_ID, PROJECT_TITLE
                         FROM PROJECT
                         WHERE PROJECT_SUCCESS = 1";

        $sql_inwork  = "SELECT  PROJECT_ID, PROJECT_TITLE
                         FROM PROJECT
                         WHERE PROJECT_SUCCESS = 0";

       // SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
//FROM Orders
//INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;
        
        //รายการที่ยังดำเนินการอยู่
        $result = $conn->query($sql_inwork);

        echo "รายการ/โครงการ";
        if ($result->num_rows > 0) {
            echo "<table id='customers'>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รายการ/โครงการ</th>
                        <th colspan='3'>แสดง/แก้ไข/ลบ</th>
                        
                    </tr>";

                    $i = 1;

                    while($row = $result->fetch_assoc())
                    {
                        echo "<tr>
                                <td align='center'>{$i}</td>
                                <td align='center'>{$row['PROJECT_TITLE']} </td>

                                <td align='center'>
                                    <font color='blue'><b><a href='./project_watch.php/?id={$row['PROJECT_ID']}'>แสดง</a></b></font>
                                                         
                                </td>
                                
                                <td align='center'>
                                    <font color='green'><b><a href='./project_edit.php/?id={$row['PROJECT_ID']}'>แก้ไข</a></b></font>
                                                         
                                </td>
                                <td align='center'>
                                    <font color='red'><b><a href='./project_del.php/?id={$row['PROJECT_ID']}'>ลบ</a></b></font>
                                </td>
                              </tr>";
                        $i++;
                    }
            echo "</table>";
        } else {
            echo "0 results";
        }
        
        /*-------------------------------------------------------

        -------------------------------------------------------*/

        //รายการที่ดำเนินการเสร็จแล้ว
        echo "<hr>";
        $result = $conn->query($sql_success);
        echo "รายการ/โครงการ (สำเร็จแล้ว)";
        if ($result->num_rows > 0) {
            echo "<table id='customers'>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รายการ/โครงการ</th>
                        <th colspan='3'>แสดง/แก้ไข/ลบ</th>
                        
                    </tr>";

                    $i = 1;

                    while($row = $result->fetch_assoc())
                    {
                        echo "<tr>
                                <td align='center'>{$i}</td>
                                <td align='center'>{$row['PROJECT_TITLE']} </td>

                                <td align='center'>
                                    <font color='blue'><b><a href='./project_watch.php/?id={$row['PROJECT_ID']}'>แสดง</a></b></font>
                                                         
                                </td>
                                
                                <td align='center'>
                                    <font color='green'><b><a href='./project_edit.php/?id={$row['PROJECT_ID']}'>แก้ไข</a></b></font>
                                                         
                                </td>
                                <td align='center'>
                                    <font color='red'><b><a href='./project_del.php/?id={$row['PROJECT_ID']}'>ลบ</a></b></font>
                                </td>
                              </tr>";
                        $i++;
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