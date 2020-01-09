<?php
  include "Bark.php";
  include "Swim.php";
  class Human implements Bark, Swim{
      public function bark(){
          echo "人類叫聲...是在叫三小!!";
      }
      public function swim(){
          echo "人類在游泳...是在游三小?";
      }
  }
?>