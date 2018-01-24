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
        ถ้า permission != 1 ให้เรียก function redir เพื่อไปหน้า ตาม permission ที่ได้รับสิทธิ
    --------------------------------*/
    if(isset($_SESSION['permission']) && ($_SESSION['permission'] != 1)) {
        redir();
    }

    //echo "{$_SESSION['userid']} <br>";
    //echo "{$_SESSION['permission']} <br>";
?>

<?php

    if(isset($_POST['project_title'])) {
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
        $process_success    = 0;

        $sql = "INSERT INTO PROJECT (`project_title`, `book_no`, `date_at`, `check_budget`, `budget`, `principle_allow`, `buy_accept`, `check_form`, `order_no`, `order_date`, `order_deadline`, `promise_no`, `promise_date`, `promise_deadline`, `binding_statement`, `check_accept`, `send_withdraw`,`project_success`)
                    VALUES('$project_title',
                            '$book_no',
                            '$date_at',
                            '$check_budget',
                            '$budget',
                            '$principle_allow',
                            '$buy_accept',
                            '$check_form',
                            '$order_no',
                            '$order_date',
                            '$order_deadline',
                            '$promise_no',
                            '$promise_date',
                            '$promise_deadline',
                            '$binding_statement',
                            '$check_accept',
                            '$send_withdraw',
                            '$process_success');";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            header("Location: //{$path}/project_management.php");
            die();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        echo $project_title     . '<br>';
        echo $book_no           . '<br>';
        echo $date_at           . '<br>';
        echo $check_budget      . '<br>';
        echo $budget            . '<br>';
        echo $principle_allow   . '<br>';
        echo $buy_accept        . '<br>';
        echo $check_form        . '<br>';
        echo $order_no          . '<br>';
        echo $order_date        . '<br>';
        echo $order_deadline    . '<br>';
        echo $promise_no        . '<br>';
        echo $promise_date      . '<br>';
        echo $promise_deadline  . '<br>';
        echo $binding_statement . '<br>';
        echo $check_accept      . '<br>';
        echo $send_withdraw     . '<br>';
    }

?>
<div></div>

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
        <form method="post" action="./project_add.php">
            <table class="w3-table">
            
                <tr>
                    <td >หน่วนเสนอความต้องการ</td>
                    <td colspan="4"><input type="text" name="project_title" id=""></td>
                </tr>

                <tr>
                    <td>ที่หนังสือ</td>
                    <td><input type="text" name="book_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td colspan="3"><input type="date" name="date_at" id=""></td>
                </tr>
                
                <tr>
                    <td>ตรวจสอบงบประมาณ เมื่อ</td>
                    <td><input type="date" name="check_budget" id=""></td>
                    <td>เป็นเงิน </td>
                    <td><input type="text" name="budget" id=""> บาท</td>
                    
                </tr>

                <tr>
                    <td>อนุมัติหลักการ เมื่อ</td>
                    <td><input type="date" name="principle_allow" id=""></td>
                    <td colspan="2">อนุมัติซื้อ-จ้าง เมื่อ <input type="date" name="buy_accept" id=""></td>
                    
                </tr>

                <tr>
                    <td>ตรวจร่าง นธน. ฯ เมื่อ</td>
                    <td colspan="4"><input type="date" name="check_form" id=""></td>
                </tr>

                <tr>
                    <td>ใบสั่งซื้อ - สั่งจ้าง ที่ </td>
                    <td><input type="text" name="order_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td><input type="date" name="order_date" id=""></td>
                    <td >กำหนดส่งมอบ <input type="text" name="order_deadline" id=""> วัน</td>
                </tr>

                <tr>
                    <td>สัญญาซื้อ - สั่งจ้าง ที่ </td>
                    <td><input type="text" name="promise_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td><input type="date" name="promise_date" id=""></td>
                    <td>กำหนดส่งมอบ <input type="text" name="promise_deadline" id=""> วัน</td>
                </tr>

                <tr>
                    <td>ผูกพันงบประมาณ เมื่อ</td>
                    <td colspan="4"><input type="date" name="binding_statement" id=""></td>
                </tr>

                <tr>
                    <td>ตรวจรับ เมื่อ</td>
                    <td colspan="4"><input type="date" name="check_accept" id=""></td>
                </tr>

                <tr>
                    <td>ส่งขอเบิกเงิน เมื่อ</td>
                    <td colspan="4"><input type="date" name="send_withdraw" id=""></td>
                </tr>

                <tr>
                    <td colspan="5">
                        <div align="center" >
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