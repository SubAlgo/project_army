<?php

    include_once "./inc.php";
   
?>

<!-- ********** PHP ตรวจสอบการ login กับ สิทธิการเข้าถึง ********** -->
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

    //echo "{$_SESSION['userid']} <br>";
    //echo "{$_SESSION['permission']} <br>";    
?>


<!-- ********** PHP SELECT STATEMENT ********** -->
<?php
    /*--------------------------------
        SELECT DATA ที่จะ Delete มาโชว์ก่อนที่จะ ตัดสินใจ Delete
        โดย Select ด้วย ID ของ Project ที่เราจะ Delete
        แต่ก่อนอื่นต้องตรวจก่อนว่า มีค่า id ส่งด้วย get มาหรือไม่
    --------------------------------*/

    if (!isset($_GET['id'])) {
        header("Location: //{$path}/project_management.php");
        die();
    } else {
        ///echo "rrrrrrrr - {$_GET['id']}";
         
        $id = $_GET['id'];
        //สร้าง sql statement
        $sql_select = "SELECT * FROM PROJECT WHERE project_id = '{$id}'";
        
        //query sql
        $result_select = mysqli_query($conn, $sql_select);

        if (mysqli_num_rows($result_select) > 0) {
            
            // output data of each row
            while($rows = mysqli_fetch_assoc($result_select)) {
                $project_id         = (string)$rows['project_id'];      //หน่วยเสอนความต้องการ
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
            }
        } else {
            header("Location: //{$path}/project_management.php");
            die();
        }
    }

?>

<!-- +++++++++++++++++ SQL DELETE Statement +++++++++++++++++ -->
<?php
    if(isset($_POST['project_id'])) {
        $project_id = $_POST['project_id'];

        $sql_del = "DELETE FROM PROJECT WHERE project_id = '{$project_id}'";

        if(mysqli_query($conn, $sql_del)) {
            header("Location: //{$path}/project_management.php");
            die();
            //echo "<div align='center'><h2>Delete Success!!</h2></div>";
            //header( "refresh:2; url=//{$path}/project_management.php"); 
            //exit(1);
        } else {
            echo "<div aling='center'>Error: {$sql} <br> mysqli_error($conn) </div>";
            header( "refresh:2; url=//{$path}/project_management.php"); 
            exit(1);
        }
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
        <form method="post" action="">
            <table class="w3-table">
            
                <tr>
                    <td >หน่วนเสนอความต้องการ</td>
                    <td colspan="4"><input type="text" readonly="true" value="<?php echo $project_title ?>" name="project_title" id=""></td>
                    <input type="hidden" readonly="true" value="<?php echo $project_id ?>" name="project_id" id="">
                </tr>

                <tr>
                    <td>ที่หนังสือ</td>
                    <td><input type="text" readonly="true" value="<?php echo $book_no ?>" name="book_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td colspan="3"><input type="date" readonly="true" value="<?php echo $date_at ?>" name="date_at" id=""></td>
                </tr>
                
                <tr>
                    <td>ตรวจสอบงบประมาณ เมื่อ</td>
                    <td><input type="date" readonly="true" value="<?php echo $check_budget ?>" name="check_budget" id=""></td>
                    <td>เป็นเงิน </td>
                    <td><input type="text" readonly="true" value="<?php echo $budget ?>" name="budget"  id=""> บาท</td>
                    
                </tr>

                <tr>
                    <td>อนุมัติหลักการ เมื่อ</td>
                    <td><input type="date" readonly="true" value="<?php echo $principle_allow ?>" name="principle_allow" id=""></td>
                    <td colspan="2">อนุมัติซื้อ-จ้าง เมื่อ <input type="date" readonly="true" value="<?php echo $buy_accept ?>" name="buy_accept" id=""></td>
                    
                </tr>

                <tr>
                    <td>ตรวจร่าง นธน. ฯ เมื่อ</td>
                    <td colspan="4"><input type="date" readonly="true" value="<?php echo $check_form ?>" name="check_form" id=""></td>
                </tr>

                <tr>
                    <td>ใบสั่งซื้อ - สั่งจ้าง ที่ </td>
                    <td><input type="text" readonly="true" value="<?php echo $order_no ?>" name="order_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td><input type="date" readonly="true" value="<?php echo $order_date ?>" name="order_date" id=""></td>
                    <td >กำหนดส่งมอบ <input type="text" readonly="true" value="<?php echo $order_deadline ?>" name="order_deadline" id=""> วัน</td>
                </tr>

                <tr>
                    <td>สัญญาซื้อ - สั่งจ้าง ที่ </td>
                    <td><input type="text" readonly="true" value="<?php echo $promise_no ?>" name="promise_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td><input type="date" readonly="true" value="<?php echo $promise_date ?>" name="promise_date" id=""></td>
                    <td>กำหนดส่งมอบ <input type="text" readonly="true" value="<?php echo $promise_deadline ?>" name="promise_deadline" id=""> วัน</td>
                </tr>

                <tr>
                    <td>ผูกพันงบประมาณ เมื่อ</td>
                    <td colspan="4"><input type="date" readonly="true" value="<?php echo $binding_statement ?>" name="binding_statement" id=""></td>
                </tr>

                <tr>
                    <td>ตรวจรับ เมื่อ</td>
                    <td colspan="4"><input type="date" readonly="true" value="<?php echo $check_accept ?>" name="check_accept" id=""></td>
                </tr>

                <tr>
                    <td>ส่งขอเบิกเงิน เมื่อ</td>
                    <td colspan="4"><input type="date" readonly="true" value="<?php echo $send_withdraw ?>" name="send_withdraw" id=""></td>
                </tr>

                <tr>
                    <td>สถานะโครงการ</td>
                    <td colspan="4"><input 
                                        type="text" readonly="true" 
                                        value="<?php if($process_success == 0) echo 'อยู่ระหว่างดำเนินการ'; else {echo 'ดำเนินการเรียบร้อย';}  ?>" 
                                        name="project_status" id="">
                    </td>
                </tr>

                <tr>
                    <td colspan="5">
                        <div align="center"><input type="submit" name="submit" value="ลบข้อมูล"> </div>
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