<?php
class MathRate {
    public static function ComplexRate($principal,$yearRate,$period,$years){
        $result = 0;
        $result = $principal * pow((1 + ((float)$yearRate/$period)),($period*$years));
        return $result;
    }
}
?>