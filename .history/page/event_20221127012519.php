<main class="main">
<?php
      date_default_timezone_set('Asia/Tokyo');
      $month = date("m");
      $date = date("d");
      $i_mo=intval($month);
        $i_da=intval($date);
      if($i_mo<=12){
        include(  "event_exist.php");
            }else{
                include(  "event_nonexist.php");
                echo ""$i_da;
            };
            echo intval($month)+50;
?>
  
</main>