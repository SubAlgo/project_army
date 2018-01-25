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

    echo "{$_SESSION['userid']} <br>";
    echo "{$_SESSION['permission']} <br>";
    
?>

<!-- +++++++++++++++++ Data for Content +++++++++++++++++ -->
<?php
    
    $id = ($_GET['id']);
    echo $id;
    
    $sql = "SELECT * FROM users WHERE user_id = '{$id}'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $user_id = $row['user_id'];
            //$user_password = $result['user_password'];
            $user_name = $row['user_name'];
            $user_surname = $row['user_surname'];
            $permission_id = $row['permission_id'];
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        header("refresh:2; url=./user_management.php"); 
        exit(1);
    }    
    
?>


<!-- +++++++++++++++++ SQL Update Data +++++++++++++++++ -->
<?php
    if(isset($_POST['userid']) && isset($_POST['username']) && isset($_POST['usersurname'])) {
        $user_id = $_POST['userid'];
        $user_name = $_POST['username'];
        $user_surname = $_POST['usersurname'];
        $user_permission = $_POST['permis'];

        $sql = "UPDATE users
                SET user_name = '{$user_name}',
                    user_surname = '{$user_surname}',
                    permission_id = '{$user_permission}'
                WHERE user_id = '{$user_id}'";

        if (mysqli_query($conn, $sql)) {
            //echo "Updata Success!!";
            echo '<script type="text/javascript">alert("Update Success");</script>';
            header("Location: //{$path}/user_management.php");
            die();
        }
        else {
            echo "Error: {$sql} <br> mysqli_error($conn)";
        }


        //header("Location: http://localhost/projeck_army/user_management.php");
        //header("Location: /{$link}/admin.php");
       // die();

        header("refresh:2; url=http://localhost/projeck_army/user_management.php"); 
        exit(1);
        
        
    }

    //Close DB Connect
    $conn->close();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" type="text/css" href="/projeck_army/css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="/projeck_army/css/w3school.css">
    <link rel="stylesheet" type="text/css" href="./css/table.css">
    
    <title>Admin</title>
    </head>
    <body>
        <div class="container">

            <?php
                include "./layout/header.php";
                include './layout/admin_nav.php';
            ?>

            <article>
                <div class="w3-container">
                    <?php echo "<form method='post' action=''>"; ?>
                        <table class="w3-table">
                            <tr>
                                <th colspan="2" aling="center">
                                    <div align="center">
                                        แก้ไขข้อมูลผู้ใช้
                                    </div>
                                </th>
                            </tr>

                            <tr>
                                <td>รหัสผู้ใช้</td>
                                <td><input type="text" name="userid" readonly="true" value="<?php echo $user_id;  ?>"></td>

                            </tr>

                            <tr>
                                <td>ชื่อ</td>
                                <td><input type="text" name="username" id="" value="<?php echo $user_name;  ?>"></td>
                            </tr>

                            <tr>
                                <td>นาสกุล</td>
                                <td><input type="text" name="usersurname" id="" value="<?php echo $user_surname; ?>" ></td>
                            </tr>

                            <tr>
                                <td>ระดับสิทธิ</td>
                                <td>
                                    <select name="permis">
                                        <option value="1" <?php if($permission_id == '1') echo 'selected'; ?>>Admin</option>
                                        <option value="2" <?php if($permission_id == '2') echo 'selected'; ?>>User</option>
                                        <option value="3" <?php if($permission_id == '3') echo 'selected'; ?>>SuperUser</option>   
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div align="center">
                                        <input type="submit" name="" id="" value="บันทึก">
                                        <button type="button" onclick="alert('ยกเลิก')">ยกเลิก</button>
                                    </div>
                                </td>
                            </tr>

                        </table>

                    </form>

                </div>
            </article>

            <!-- +++++++++++++++++ Content +++++++++++++++++ -->

            <?php
                include './layout/foot.php';
            ?>

        </div>

    </body>
</html>