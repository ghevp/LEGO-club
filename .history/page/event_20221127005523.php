<main class="main">
<?php
      date_default_timezone_set('Asia/Tokyo');
      $month = date("m");
      $date = date("d");
      if("home"==$page){
      if ($month==2||$month==3){
        include(  "event_.php");
            }else{
                echo"<img src=","img/otamesi.png",">";
            };
      };
?>
  
</main>