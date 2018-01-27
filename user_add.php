<?php

    include_once "./inc.php";
   
?>
<script>
    function echo_success() {
        alert 'Update Success';
    }
    function echo_fail() {
        alert 'Update Fail';
    }
</script>

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
    if(isset($_SESSION['permission']) && ($_SESSION['permission'] != 1)) {
        redir();
    }

 
    
?>

<!-- +++++++++++++++++ Set Data Value +++++++++++++++++ -->
<?php
    if(isset($_POST['userid']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['username']) && isset($_POST['permis'])  ) {
        $user_id = trim((string)$_POST['userid']);
        $user_password = trim((string)$_POST['password']);
        $user_password2 = trim((string)$_POST['password2']);
        $user_name = trim((string)$_POST['username']);
        $user_surname = trim((string)$_POST['usersurname']);
        $user_permission = trim((string)$_POST['permis']);

        /* Check Empty Value
        -------------------*/
        if($user_id == "" || $user_password == "" || $user_name == "" || $user_surname == "" || $user_permission == "") {
            echo "กรอกข้อมูลไม่ครบ!!";
            header( "refresh:2; url=http://localhost/projeck_army/user_add.php" ); 
            exit(1);
        }

        /* Check Confirm Password
        -------------------------*/
        if($user_password != $user_password2) {
            echo '<script type="text/javascript">alert("กรอกระหัสไม่ถูกต้อง");</script>';
            header("refresh:3; url=http://localhost/projeck_army/user_add.php"); 
            exit(1);
        }

        $sql = "INSERT INTO users (`user_id`, `user_password`, `user_name`, `user_surname`, `permission_id`) 
                VALUES ('$user_id',
                        '$user_password',
                        '$user_name',
                        '$user_surname',
                        '$user_permission'
                        );";

        
        if (mysqli_query($conn, $sql)) {
            echo "<div align='center'><b>New record created successfully</b></div>";
            header( "refresh:2; url=http://localhost/projeck_army/user_management.php" );
            exit(1);
        } else {
            echo "<div align='center'><b> Error: " .  mysqli_error($conn)."</b></div>";
            header( "refresh:2; url=http://localhost/projeck_army/user_add.php" );
            exit(1);
        }

    }

    //Close DB Connect
    $conn->close();
    
?>

<div></div>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
    <?php
        echo "<link rel='stylesheet' type='text/css' href='//{$path}/css/mystyle.css'>";
        echo "<link rel='stylesheet' type='text/css' href='//{$path}/css/w3school.css'>";
        echo "<link rel='stylesheet' type='text/css' href='//{$path}/css/table.css'>";
    ?>

</head>
<body>

<div class="container">

<?php
    include './layout/header.php';
    include './layout/admin_nav.php';
    //include './func_checklogin.php';
?>

<!-- +++++++++++++++++ Content +++++++++++++++++ -->
<div>
<article>

    <div class="w3-container">
        <form method="post" action="user_add.php">
            <table class="w3-table">
                <tr>
                    <th colspan="2" aling="center">
                        <div align="center">
                            Create User
                        </div>
                    </th>
                </tr>

                <tr>
                    <td>รหัสผู้ใช้</td>
                    <td><input type="text" name="userid" id=""></td>
                </tr>

                <tr>
                    <td>รหัสผ่านผู้ใช้</td>
                    <td><input type="password" name="password" id=""></td>
                </tr>

                <tr>
                    <td>รหัสผ่านผู้ใช้ (อีกครั้ง)</td>
                    <td>
                        <input type="password" name="password2" id="">
                    </td>
                </tr>

                <tr>
                    <td>ชื่อ</td>
                    <td><input type="text" name="username" id=""></td>
                </tr>

                <tr>
                    <td>นาสกุล</td>
                    <td><input type="text" name="usersurname" id=""></td>
                </tr>

                <tr>
                    <td>ระดับสิทธิ</td>
                    <td>
                        <select name="permis">
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                            <option value="3">SuperUser</option>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div align="center">
                            <input type="submit" name="" id="" value="บันทึก">
                            <button type="button" onclick="alert('Hello world!')">ยกเลิก</button>
                        </div>
                    </td>
                </tr>
            
            </table>


        </form>
        
    </div>

        
    </table>
    

</article>
</div>



<!-- +++++++++++++++++ Content +++++++++++++++++ -->

<?php
    include './layout/foot.php';
?>



</div>

</body>
</html>