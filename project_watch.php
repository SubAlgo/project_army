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
    } else {
        //echo "{$_SESSION['userid']} <br>";
        //echo "{$_SESSION['permission']} <br>";
    
        $permission = $_SESSION['permission'];
    }

    
?>

<?php
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
    
        
    $conn->close();

//-------------------------


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

        if($permission == 1) {
            include './layout/admin_nav.php';
    } else if($permission == 2) {
        include './layout/superuser_nav.php';
    } else if($permission == 3) {
        include './layout/user_nav.php';
    }
    
?>

<!-- +++++++++++++++++ Content +++++++++++++++++ -->
<div>
<article>

    <div class="w3-container">
        <form method="post" action="./project_watch.php">
            <table class="w3-table">
            
                <tr>
                    <td >หน่วนเสนอความต้องการ</td>
                    
                    <td colspan="4"><label><?php echo $project_title ?></label></td>
                </tr>

                <tr>
                    <td>ที่หนังสือ</td>
                    <td><input type="text" readonly="true" value="<?php if($book_no =="") {echo "-";} else {echo $book_no;} ?>" name="book_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td colspan="3"><input type="date" readonly="true" value="<?php if($date_at =="") {echo "-";} else {echo $date_at;} ?>" name="date_at" id=""></td>
                </tr>
                
                <tr>
                    <td>ตรวจสอบงบประมาณ เมื่อ</td>
                    <td><input type="date" readonly="true" value="<?php echo $check_budget ?>" name="check_budget" id=""></td>
                    <td>เป็นเงิน </td>
                    
                    <td><input type="text" readonly="true" value="<?php if($budget =="") {echo "-";} else {echo $budget;} ?>" name="budget"  id=""> บาท</td>
                    
                </tr>

                <tr>
                    <td>อนุมัติหลักการ เมื่อ</td>
                    <td><input type="date" readonly="true" value="<?php echo $principle_allow ?>" name="principle_allow" id=""></td>
                    <td colspan="1">อนุมัติซื้อ-จ้าง เมื่อ </td>
                    <td><input type="date" readonly="true" value="<?php echo $buy_accept ?>" name="buy_accept" id=""></td>
                </tr>

                <tr>
                    <td>ตรวจร่าง นธน. ฯ เมื่อ</td>
                    <td colspan="4"><input type="date" readonly="true" value="<?php echo $check_form ?>" name="check_form" id=""></td>
                </tr>

                <tr>
                    <td>ใบสั่งซื้อ - สั่งจ้าง ที่ </td>
                    
                    <td><input type="text" readonly="true" value="<?php if($order_no  =="") {echo "-";} else {echo $order_no ;} ?>" name="order_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td><input type="date" readonly="true" value="<?php echo $order_date ?>" name="order_date" id=""></td>
                    
                    <td >กำหนดส่งมอบ <input type="text" readonly="true" value="<?php if($order_deadline  =="") {echo "-";} else {echo $order_deadline ;} ?>" name="order_deadline" id=""> วัน</td>
                </tr>

                <tr>
                    <td>สัญญาซื้อ - สั่งจ้าง ที่ </td>
                    
                    <td><input type="text" readonly="true" value="<?php if($promise_no  =="") {echo "-";} else {echo $promise_no ;} ?>" name="promise_no" id=""></td>
                    <td>ลงวันที่</td>
                    <td><input type="date" readonly="true" value="<?php echo $promise_date ?>" name="promise_date" id=""></td>
                    
                    <td>กำหนดส่งมอบ <input type="text" readonly="true" value="<?php if($promise_deadline  =="") {echo "-";} else {echo $promise_deadline ;} ?>" name="promise_deadline" id=""> วัน</td>
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
                    <td colspan="4"><input type="text" readonly="true" 
                                        value="<?php if($process_success == 0) echo 'อยู่ระหว่างดำเนินการ'; else {echo 'ดำเนินการเรียบร้อย';}  ?>" 
                                        name="project_status" id=""></td>
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