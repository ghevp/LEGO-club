<!DOCTYPE html>
<html lang="ja"> 
<?php
    if(isset($_GET['page'])){
     $page=$_GET['page'];
    };
     if(isset($page)){
        
      
     }else{
                   $page="home";     
     };
     $title = array('home' => "ホーム",
     'kainokoushiki' => "解の公式",
     'enword'=>"英語");  
     
     $c=0;
     $x=0;
     $y=0;
     $t=0;
?>
<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6911517647778874"
     crossorigin="anonymous"></script>
        <meta charset="UTF-8">
       <!-- Global site tag (gtag.js) - Google Analytics -->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
            $('.').bxSlider({
                auto: true,
                pause: 5000,
            });
        });
</script>
        <meta name="author" content="ぐゑ">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@ghevp">
        <meta property="og:url" content="https://shizudailego.com">
        <meta property="og:title" content="浜松学生レゴサークル">
        <meta name="og:description" content="このウェブサイトは世の中の家庭教師を支援するためのツールを搭載しています。。">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@500&family=Shippori+Mincho+B1:wght@800&family=Yuji+Syuku&display=swap" rel="stylesheet"> 
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">  
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kosugi&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="css/style.css"><!--後でphpのif文の作成-->
        <title> 
        <?php 
      if (isset($title) == "") {
        echo "浜松学生レゴサークル";
    } else {
        echo "" . $title[$page] . " - 浜松学生レゴサークル";
    }  
   ?>
        </title>
        
    <body>
        <?php
     
    
            include('page/'.$page.".php");
      
    
        
           
    ?>
     <div class="header">
        <div class="header_inner">
            
            <a href="?page=home">浜松学生レゴサークル</a>
        </div>
     </div>
     <footer class="footer">
        <div class="footer_inner">
        <img src="img/logo.png">
        <a href="?page=home">浜松学生レゴサークル</a>
        </div>
        <div class="copyright">
    <p><small>copyright <a href="https://ghevp.com">ぐゑ</a> all rights reserved.</small></p>
        </div>
    </footer>
