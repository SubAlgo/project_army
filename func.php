  <?php

  function redir() {
      
            if(!empty($_SESSION['permission'])) {
            switch ($_SESSION['permission']) {
                case 1:
                    header("Location: http://localhost/projeck_army/admin.php");
                    //header("Location: /{$link}/admin.php");
                    die();
                    break;
                case 2:
                    header("Location: http://localhost/projeck_army/superuser.php");
                    die();
                    break;
                case 3:
                    header("Location: http://localhost/projeck_army/user.php");
                    die();
                    break;
                default:
                    header("Location: http://localhost/projeck_army/index.php");
                    die();
                    break;
            }
        }
        
//echo "PT {$link}";

        }
?>