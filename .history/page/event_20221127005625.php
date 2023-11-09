<main class="main">
<?php
      date_default_timezone_set('Asia/Tokyo');
      $month = date("m");
      $date = date("d");
      
      if ($month==12||$date==){
        include(  "event_exist.php");
            }else{
                echo"<img src=","img/otamesi.png",">";
            };
      
?>
  
</main>