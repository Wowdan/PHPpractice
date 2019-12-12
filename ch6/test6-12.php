<?php
$sum = 0;
for ($i = 1; $i <= 50; $i++){
    $sum += $i;
}
echo "總合: $sum";
?>

<?php
$sum = 0;
$i = 0;
while ( $i <= 50 ){
    $sum += $i;
    $i++;
}
echo "總合: $sum";
?>

<?php
$sum = 0;
$i = 1;
do {
    $sum += $i;
    $i++;
}while ($i <= 50);
echo "總合: $sum";
?>

<?php
$sum = 0;
$i = 0;
while (true){
    $i++;
    $sum += $i;
    if ($sum >= 100) break;
}
echo "\$sum : $sum";

?>