<main class="main">
<?php
      date_default_timezone_set('Asia/Tokyo');
      $month = date("m");
      $date = date("d");
      $i_mo=intval($month);
        $i_da=intval($date);
      if($i_mo<=12 or $i_da<=13){
        include(  "event_exist.php");
            }else{
                
                include(  "event_nonexist.php");
                
            };
            echo intval($month)+54;
            echo "<p>".$i_da."</p>";
?>
  
</main>