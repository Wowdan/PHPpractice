<?php
  $x = 1;
  function hello ($x){
      $sum = $x * 2;
      echo "函式執行結束<br />";
      return $sum;
  }
?>
<p>-------分隔線-------</p>
<?php
  $sum = hello($x);
  echo "x = $x<br />";
  echo "sum = $sum<br />";
?>