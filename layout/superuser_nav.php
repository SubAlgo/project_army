<?php

  //$host =  $_SERVER['HTTP_HOST'];
  //$project_name = "projeck_army";



  $ln =  "http://{$host}/{$project_name}/";
?>
<nav>
  <ul>
    
    <?php
      //echo "<li><a href='http://localhost/pj_army/user_management.php'>จัดการผู้ใช้</a></li>"
   
      echo "<li><a href='/{$project_name}/project_management.php'>จัดการรายการ/โครงการ</a></li>";
      echo "<hr>";
      echo "<li><a href='/{$project_name}/logout.php'>Logout</a></li>";

    ?>
    <hr>
    
  </ul>
</nav>