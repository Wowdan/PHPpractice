<?php
function sum (...$numbers) {
    $total = 0;
    foreach ($numbers as $i){
        $total += $i;
    }
    return $total;
}

echo "總共是 : ".sum(1,9,10,2,8);
?>