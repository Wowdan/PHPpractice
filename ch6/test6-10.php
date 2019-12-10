<?php
  //一維陣列
  $eggbox["土雞"]=30;
  $eggbox[1]=100;
  $eggbox[]=20;
  $eggbox["duck"]=50;
  $drinkbox=array("啤酒"=>70,"cola"=>30);
  $foodbox=["飯糰"=>50];
  echo $eggbox;
  echo $drinkbox;
  echo $foodbox;


  //二維陣列
  $lunch [0] ["素食"]=100;
  $lunch [0] ["葷食"]=150;
  $lunch ["麵類"] ["拉麵"]=200;
  $lunch["飯類"] ["雞肉飯"]="今天不賣";
  $lunch[1] = array("廣東粥"=>80,"炸雞排"=>70);

  echo $lunch;
?>