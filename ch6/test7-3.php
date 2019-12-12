<?php
  function table99($i=2,$j=1){
    if ($j > 9){
      $i++;
      $j = 1;
      echo "<br />";
    }
    if ( $i <= 9 ){
      printf("%d*%d=%d \t",$i,$j,($i*$j));
      $j++;
      table99($i,$j);
    }
  }
  echo table99();
?>