<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php require_once 'head.php'; ?>
  </head>
<body>
    <div class="grid-container">
    <?php include_once 'menu.php'; ?>
    <!-- Start body -->
    <div class="grid-x grid-margin-x" id="tijelo">
      <div class="cell">
        <div class="callout">
          Program će napraviti tablicu dimenzija dva unesena broja po x i y koordinati
        <?php 
         // inputs
          $x = isset($_GET['x']) ? $_GET['x'] : 0; 
          $y = isset($_GET['y']) ? $_GET['y'] : 0; 
        
        ?>
        <form action="" method="get">

        <label>
          x
          <input type="text" name="x" value="<?=$x?>">
        </label>
        <label>
          y
          <input type="text" name="y" value="<?=$y?>">
        </label>

        
        <input class="medium-6 cell" type="submit" value="Izradi tablicu">

        </form>


<?php
// pravljenje tablice

echo '<table border="1"; width: relative;>';

$z=1;
$firstrow=0;
$firstcol=0;
$k=$x-1;
$l=$y-1;
$zbroj=($x*$y);

$vrijednosti1=range(0,$x);
$vrijednosti2=range(0,$y);
$niz=array(array_combine($vrijednosti1,$vrijednosti1),array_combine($vrijednosti2,$vrijednosti2));

//print_r($niz);

//function matrica($z,$x,$y){


while($z<=$zbroj){
//trebalo bi ispisati prvi donji red
    for($i=$l;$i>=$firstcol;$i--){
    
      echo $niz[$k][$i]=$z++;
    
    }

//smanjim red za jedan da krene prema gore i iteriram po redovima u prvom stupcu
$k--;

if($firstcol<$l){
    for($i=$k;$i>=$firstrow;$i--){

      echo $niz[$i][$firstcol]=$z++;
    }
    }else{break;}
//povećamo stupac za jedan jer ide nadesno pa iteriram po prvom redu
++$firstcol;

//
    if($k>=$firstrow){

      for($i=$firstcol;$i<=$l;$i++)
          echo $niz[$firstrow][$i]=$z++;
    }else{
      break;
    }
  

//povećamo prvi red pa iteriramo prema dolje
$firstrow++;


    if($l>$firstcol){

      for($i=$firstrow;$i<=$k;$i++)
        echo $niz[$i][$l]=$z++;
    }else{break;}
//smanjimo $l varijablu i kreće loop u unutarnju matricu od predzadnjeg reda prema lijevo
$l--;


}

//}

echo '<table border= "1">';

for($i=0;$i<$x;$i++){
    echo '<tr>';
    for($j=0;$j<$y;$j++){
        echo '<th style="background-color: brown; color: white; stroke: #f8a100; ">';
        echo $niz[$i][$j]; 
        echo '</th>';
    }
    echo '</tr>';
}
echo '</table>';



//ne radi isto


  ?>


          
        </div>
      </div>
    </div>
    <!-- End body -->
    <?php 
    require_once 'footer.php'; ?>
    </div>
    <?php require_once 'skripte.php'; ?>
  </body>
</html>