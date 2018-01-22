<?php
   include_once "inc.php";
    
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
        ถ้าไม่ได้ set permission ให้เรียก function redir เพื่อไปหน้า ตาม permission ที่ได้รับสิทธิ
        เพราะ หน้านี้ user จะเข้าได้ทุกระดับ
    --------------------------------*/
    if(!isset($_SESSION['permission'])) {
        redir();
    }

    echo "{$_SESSION['userid']} <br>";
    echo "{$_SESSION['permission']} <br>";
?>

<?php

    /*------ สร้างตัวแปร ID เพื่อใช้ในการสร้างตารางโชว์ข้อมูล ------*/
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM PROJECT WHERE project_id = '{$id}'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($rows = $result->fetch_assoc()) {
                $project_title      = (string)$rows['project_title'];      //หน่วยเสอนความต้องการ
                $book_no            = (string)$rows['book_no'];            //ที่หนังสือ
                $date_at            = (string)$rows['date_at'];            //ลงวันที่
                $check_budget       = (string)$rows['check_budget'];       //ตรวจสอบงบประมาณเมื่อ
                $budget             = (string)$rows['budget'];             //เป็นเงิน
                $principle_allow    = (string)$rows['principle_allow'];    //อนุมัติหลักการ เมื่อ
                $buy_accept         = (string)$rows['buy_accept'];         //อนุมัติซื้อ-จ้าง เมื่อ
                $check_form         = (string)$rows['check_form'];         //ตรวตร่าง นธน.ฯ
                $order_no           = (string)$rows['order_no'];           //ใบสั่งซื้อ-สั่งจ้าง ที่
                $order_date         = (string)$rows['order_date'];         //ลงวันที่(ใบสั่งซื้อ-สั่งจ้าง)
                $order_deadline     = (string)$rows['order_deadline'];     //กำหนดส่งมอบ (ใบสั่งซื้อ-สั่งจ้าง)
                $promise_no         = (string)$rows['promise_no'];         //สัญญาซื้อ-จ้าง ที่
                $promise_date       = (string)$rows['promise_date'];       //ลงวันที่ (สัญญาซื้อ-จ้าง)
                $promise_deadline   = (string)$rows['promise_deadline'];   //กำหนดส่งมอบ (สัญญาซื้อ-จ้าง) 
                $binding_statement  = (string)$rows['binding_statement'];  //ผูกพันงบประมาณ
                $check_accept       = (string)$rows['check_accept'];       //ตรวจรับ เมื่อ
                $send_withdraw      = (string)$rows['send_withdraw'];      //ส่งขอเบิกเงิน เมื่อ
                $process_success    = (string)$rows['project_success']; 

                //echo $project_title;
            }
            
        } else {
            echo "0 results";
        }
    }

    // ถ้ามีการ submit form ให้ทำการ Update Database
    if(isset($_POST['submit'])) {
        $project_title      = (string)$_POST['project_title'];      //หน่วยเสอนความต้องการ
        $book_no            = (string)$_POST['book_no'];            //ที่หนังสือ
        $date_at            = (string)$_POST['date_at'];            //ลงวันที่
        $check_budget       = (string)$_POST['check_budget'];       //ตรวจสอบงบประมาณเมื่อ
        $budget             = (string)$_POST['budget'];             //เป็นเงิน
        $principle_allow    = (string)$_POST['principle_allow'];    //อนุมัติหลักการ เมื่อ
        $buy_accept         = (string)$_POST['buy_accept'];         //อนุมัติซื้อ-จ้าง เมื่อ
        $check_form         = (string)$_POST['check_form'];         //ตรวตร่าง นธน.ฯ
        $order_no           = (string)$_POST['order_no'];           //ใบสั่งซื้อ-สั่งจ้าง ที่
        $order_date         = (string)$_POST['order_date'];         //ลงวันที่(ใบสั่งซื้อ-สั่งจ้าง)
        $order_deadline     = (string)$_POST['order_deadline'];     //กำหนดส่งมอบ (ใบสั่งซื้อ-สั่งจ้าง)
        $promise_no         = (string)$_POST['promise_no'];         //สัญญาซื้อ-จ้าง ที่
        $promise_date       = (string)$_POST['promise_date'];       //ลงวันที่ (สัญญาซื้อ-จ้าง)
        $promise_deadline   = (string)$_POST['promise_deadline'];   //กำหนดส่งมอบ (สัญญาซื้อ-จ้าง) 
        $binding_statement  = (string)$_POST['binding_statement'];  //ผูกพันงบประมาณ
        $check_accept       = (string)$_POST['check_accept'];       //ตรวจรับ เมื่อ
        $send_withdraw      = (string)$_POST['send_withdraw'];      //ส่งขอเบิกเงิน เมื่อ
        $process_success    = (string)$_POST['project_success'];

        $sql = "UPDATE PROJECT
                SET    `project_title`      = '$project_title',
                       `book_no`            = '$book_no', 
                       `date_at`            = '$date_at',
                       `check_budget`       = '$check_budget',
                       `budget`             = '$budget',
                       `principle_allow`    = '$principle_allow',
                       `buy_accept`         = '$buy_accept',
                       `check_form`         = '$check_form',
                       `order_no`           = '$order_no',
                       `order_date`         = '$order_date', 
                       `order_deadline`     = '$order_deadline',
                       `promise_no`         = '$promise_no',
                       `promise_date`       = '$promise_date',
                       `promise_deadline`   = '$promise_deadline',
                       `binding_statement`  = '$binding_statement',
                       `check_accept`       = '$check_accept',
                       `send_withdraw`      = '$send_withdraw',
                       `project_success`    = '$process_success'
                WHERE   project_id={$id}";
                    
                            
        if (mysqli_query($conn, $sql)) {
            //echo "Updata Success!!";
            echo '<script type="text/javascript">alert("Update Success");</script>';
            header("Location: //{$path}/project_management.php");
            die();
        }
        else {
            echo "Error: {$sql} <br> mysqli_error($conn)";
        }
                            
                            
                            
    }
    
        
    $conn->close();

//-------------------------


?>



<!DOCTYPE html>
<html>
<head>

<meta http-equiv=Content-Type content="text/html; charset=tis-620">

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
?>

<!-- +++++++++++++++++ Content +++++++++++++++++ -->
<div>
<article>

    <div class="w3-container">
        <?php echo "<form method='post' action='//{$path}/project_edit.php/?id={$id}'>";  ?>
            <table class="w3-table">
                <tr>
                    <td >หน่วนเสนอความต้องการ</td>
                    <td colspan="4"><input type="text"   value="<?php echo $project_title ?>" name="project_title" id=""></td>
                </tr>

                <tr>
                    <td>ที่หนังสือ</td>
                    <td><input type="text"   value="<?php echo $book_no ?>" name="book_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td colspan="3"><input type="date"   value="<?php echo $date_at ?>" name="date_at" id=""></td>
                </tr>
                
                <tr>
                    <td>ตรวจสอบงบประมาณ เมื่อ</td>
                    <td><input type="date"   value="<?php echo $check_budget ?>" name="check_budget" id=""></td>
                    <td>เป็นเงิน </td>
                    <td><input type="text"   value="<?php echo $budget ?>" name="budget"  id=""> บาท</td>
                    
                </tr>

                <tr>
                    <td>อนุมัติหลักการ เมื่อ</td>
                    <td><input type="date"   value="<?php echo $principle_allow ?>" name="principle_allow" id=""></td>
                    <td colspan="2">อนุมัติซื้อ-จ้าง เมื่อ <input type="date"   value="<?php echo $buy_accept ?>" name="buy_accept" id=""></td>
                    
                </tr>

                <tr>
                    <td>ตรวจร่าง นธน. ฯ เมื่อ</td>
                    <td colspan="4"><input type="date"   value="<?php echo $check_form ?>" name="check_form" id=""></td>
                </tr>

                <tr>
                    <td>ใบสั่งซื้อ - สั่งจ้าง ที่ </td>
                    <td><input type="text"   value="<?php echo $order_no ?>" name="order_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td><input type="date"   value="<?php echo $order_date ?>" name="order_date" id=""></td>
                    <td >กำหนดส่งมอบ <input type="text"   value="<?php echo $order_deadline ?>" name="order_deadline" id=""> วัน</td>
                </tr>

                <tr>
                    <td>สัญญาซื้อ - สั่งจ้าง ที่ </td>
                    <td><input type="text"   value="<?php echo $promise_no ?>" name="promise_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td><input type="date"   value="<?php echo $promise_date ?>" name="promise_date" id=""></td>
                    <td>กำหนดส่งมอบ <input type="text"   value="<?php echo $promise_deadline ?>" name="promise_deadline" id=""> วัน</td>
                </tr>

                <tr>
                    <td>ผูกพันงบประมาณ เมื่อ</td>
                    <td colspan="4"><input type="date"   value="<?php echo $binding_statement ?>" name="binding_statement" id=""></td>
                </tr>

                <tr>
                    <td>ตรวจรับ เมื่อ</td>
                    <td colspan="4"><input type="date"   value="<?php echo $check_accept ?>" name="check_accept" id=""></td>
                </tr>

                <tr>
                    <td>ส่งขอเบิกเงิน เมื่อ</td>
                    <td colspan="4"><input type="date"   value="<?php echo $send_withdraw ?>" name="send_withdraw" id=""></td>
                </tr>

                <tr>
                    <td>สถานะโครงการ</td>
                    <td colspan="4">
                        <select name="project_success">
                            <option value="0" <?php if($process_success == '0') echo 'selected'; ?>>อยู่ระหว่างดำเนินการ</option>
                            <option value="1" <?php if($process_success == '1') echo 'selected'; ?>>ดำเนินการเรียบร้อย</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="5">
                        <div align="center"><input type="submit" name="submit" value="อัปเดท"> </div>
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