<?php

  $host =  $_SERVER['HTTP_HOST'];
  $project_name = "projeck_army";



  $ln =  "http://{$host}/{$project_name}/";
?>
<nav>
  <ul>
    
    <?php
      //echo "<li><a href='http://localhost/pj_army/user_management.php'>จัดการผู้ใช้</a></li>"
      echo "<li><a href='{$ln}index.php'>หน้า Login</a></li>";
      echo "<hr>";
      echo "<li><a href='{$ln}project_show.php'>แสดง รายการ/โครงการ</a></li>";
      echo "<hr>";
      echo "<li><a href='{$ln}project_add_form.php'>เพิ่ม รายการ/โครงการ</a></li>";
      echo "<hr>";
      echo "<li><a href='{$ln}user_add_form.php'>เพิ่ม ผู้ใช้งาน</a></li>";
      echo "<hr>";
      echo "<li><a href='{$ln}user_management.php'>จัดการผู้ใช้</a></li>";
      echo "<hr>";
      echo "<li><a href='{$ln}func_logout.php'>Logout</a></li>";
    ?>
    <hr>
    
  </ul>
</nav>