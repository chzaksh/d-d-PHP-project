<?php

class Saber extends Player{


    
public function cubethrowAtt(){
    $arrCube = [rand(1,6), rand(1,6)];
    $sumCube = $arrCube[0] + $arrCube[1];
    print_r("<br> The Cube result is: $arrCube[0], $arrCube[1].");
    $sumPwoer = $this->power + $this->dexterity;
    $sumFinel = $sumCube + $sumPwoer;
    print_r("<br>Power: $this->power, Dexterity: $this->dexterity.<br>  sum Attaque:  $sumFinel.");
    return $sumFinel;
}

public function cubethrowDef(){
    $arrCub = [rand(1,6), rand(1,6), rand(1,6)];
    array_multisort($arrCub);
    print_r("<br> The 3 Cube result is: $arrCub[0], $arrCub[1], $arrCub[2].");
    array_shift($arrCub);
    $sumCub = $arrCub[0] + $arrCub[1];
    $sumPwoer = $this->dexterity + $this->agility;
    $sumFinel = $sumCub + $sumPwoer;
    print_r("<br> The two high results are: $arrCub[0], $arrCub[1]. <br> Dexterity: $this->dexterity, Agility: $this->agility.<br>  sum Defense:  $sumFinel.");
    return $sumFinel;
}



}