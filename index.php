<?php

    include_once "inc.php";

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
<a href='http://localhost/projeck_army/sub/sub_test.php'>sub_test</a>

    <form method="post" action="">
        <table align="center">
            <tr>
                <td colspan="2" align="center">Login</td>
            </tr>

            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="userid" id="">   
                </td>
            </tr>

            <tr>
                <td>Password:</td>
                <td>
                    <input type="text" name="password" id="">   
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" name="" id=""></td>
            </tr>
        </table>
    </form>

    <?php
    
        /*Check Login and Create SESSION | COOKIE
        ---------------------------------------*/
        if(isset($_POST['userid']) && isset($_POST['password'])) {

            //กำหนดตัวแปรเบื้องต้น
            $userid = $_POST['userid'];
            $password = $_POST['password'];
            $permission =  "";

            //สร้างคำสั่ง SQL เพื่อใช้ตรวจสอบการ Login
            $sql = "SELECT * FROM users WHERE user_id = '{$userid}' and user_password = '{$password}'";

            //เอาคำสั่ง SQL ไป query แล้วนำผลลัพธ์มาเก็บใน $result
            $result = mysqli_query($conn, $sql);

            /*ถ้าจำนวน row < 0 เท่ากับ login ไม่สำเร็จ
              แต่ถ้า row > 0 
              ก็ให้เอา userid มาเก็บไว้ใน session กับ cookie เพื่อใช้ตรวจสอบการ login เวลาเปลี่ยนหน้าเพจ
              และ เอา permission มาเก็บใน session เพื่อใช้ตรวจสอบสิทธิ์ในการเข้าถึงหน้า Page ตามสิทธิ์การเข้าถึง
            */
            if(!(mysqli_num_rows($result) > 0)) {
                echo "Login fail";
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    $permission = $row["permission_id"];
                    //echo $permission;
                    $_SESSION['userid'] = $userid;
                    $_SESSION['permission'] = $permission;
                    setcookie('userid', $userid, time()+60*15);

                    echo "{$_SESSION['userid']} <br>";
                    echo "{$_SESSION['permission']} <br>";
                    echo "{$_COOKIE['userid']} <br>";
                }   
            }
        }

        /*Redirect Page after login
        --------------------------*/
        if(!empty($_SESSION['permission'])) {
            switch ($_SESSION['permission']) {
                case 1:
                    header("Location: http://localhost/projeck_army/admin.php");
                    die();
                case 2:
                    header("Location: http://localhost/projeck_army/superuser.php");
                    die();
                case 3:
                    header("Location: http://localhost/projeck_army/user.php");
                    die();
            }
        }

        /*
        echo "pp| {$_SESSION['userid']} <br>";
        echo "pp| {$_SESSION['permission']} <br>";
        echo "pp| {$_COOKIE['userid']} T <br>";
        */
    ?>
    
</body>
</html>