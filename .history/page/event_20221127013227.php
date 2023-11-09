<main class="main">
<?php
      date_default_timezone_set('Asia/Tokyo');
      $month = date("m");
      $date = date("d");
      $i_mo=intval($month);
        $i_da=intval($date);
      if(11<=12 ){
        include(  "event_exist.php");
            }else{
                
                include(  "event_nonexist.php");
                
            };
            echo $i_mo;
            echo "<p>".$i_da."</p>";
?>
  
</main>