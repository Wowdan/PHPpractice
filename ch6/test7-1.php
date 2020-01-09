<?php
//顯示名字
function name (){
    echo "Peter";
}


//計算成績等級
function score($i) {
    $j = "F";
    $level = intval($i / 10);
    switch ($level) {
        case 10:
        case 9:
            $j = "A";
        break;
        case 8:
            $j = "B";
        break;
        case 7:
            $j = "C";
        break;
        case 6:
            $j = "D";
        break;
        default:
            $j = "E";
    }
    return $j;
}

echo name();
$backscore = score(85);
echo "成績等級 : $backscore";
?>