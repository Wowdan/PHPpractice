<?php
trait Game{
    function play(){
        echo "Playing a game";
    }
}
trait Music{
    function play(){
        echo "Playing music";
    }
}

class Player{
    use Game, Music{
        //將Game的play別名成gameplay
        Game::play as gamePlay;
        //使用Music的play功能，取消Game的play功能
        Music::play insteadof Game;
    }
}

$player = new Player();
$player->play();
$player->gamePlay();
?>