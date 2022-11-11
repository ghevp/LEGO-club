<div class="kainokoushiki">
<h1>解の公式学習システム</h1>
<?php
    for($m=0;$m<50;$m++){
        $a[$m]=rand(-200,200);
        $b[$m]=rand(-16,16);
        $k[$m]=($a[$m]-$b[$m]^2)/4;
        $k[$m]=-$k[$m];
        
        if(is_int($k[$m])){
            
        }else{
            for ($i=1; $i < 4; $i++) { 
                # code...
                $t=$k[$m]+0.25*$i;
                if ($t==ceil($k[$m])) {
                    # code...
                    $a[$m]=$a[$m]+$i;
                    $k[$m]=($k[$m]+0.25*$i);
                    
                }
                
            }
        }
        
        
        $mo=0;
        
        for ($i1=1; $i1 <= abs($k[$m])  ; $i1++) {
           
            $round=$k[$m]/$i1;
            if ($k[$m]%$i1==0){
                $mo++;
                $f[$mo]=$i1;
                
            } 
            $round=0;
            
           # code...
        }
        $wari=rand(1,$mo);
        
        $r[$m]=$f[$wari];
       
        if($k[$m]<0){
            $r[$m]=-$r[$m];
        }
        

        echo"<p>",$m+1,":",$r[$m],"x²+",$b[$m],"x+",$k[$m]/$r[$m],"</p><br>";
       
    }
    for($answer=0;$answer<50;$answer++){
    if($a[$answer]>=0){
        echo"<p>answer",$answer+1,":",$b[$answer],"±√(",$b[$answer]*$b[$answer],"-",$a[$answer],")/",2*$r[$answer],"</p>";
        }else{
            echo"<p>answer",$answer+1,":",$b[$answer],"±√(",$b[$answer]*$b[$answer],"+",-$a[$answer],")/",2*$r[$answer],"</p>";
        }
    }
?>
</div>