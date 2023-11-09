<main class="main">
<?php
      date_default_timezone_set('Asia/Tokyo');
      $month = date("m");
      $date = date("d");
      $i_mo=intval($month);
        
      if (<=12||intval($date)<=11){
        include(  "event_exist.php");
            }else{
                include(  "event_nonexist.php");
                echo intval($month);
            };
            echo intval($month)+50;
?>
  
</main>