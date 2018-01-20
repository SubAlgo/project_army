<?php

  $host =  $_SERVER['HTTP_HOST'];
  $project_name = "projeck_army";



  $ln =  "http://{$host}/{$project_name}/";
?>
<nav>
  <ul>
    
    <?php
      echo "<li><a href='/{$project_name}/logout.php'>Logout</a></li>";
      echo "<hr>";
    ?>
    <hr>
    
  </ul>
</nav>