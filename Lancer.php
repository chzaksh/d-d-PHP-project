<?php

class Lancer extends Player{

    
    
public function cubethrowAtt(){ 
    $arrCube = [rand(1,6), rand(1,6)];
    $sumCube = $arrCube[0] + $arrCube[1];
    print_r("<br> The Cube result is: $arrCube[0], $arrCube[1].");
    $sumPwoer = $this->power + $this->dexterity;
    $sumFinel = $sumCube + $sumPwoer;
    print_r("<br>Power: $this->power, Dexterity: $this->dexterity. <br> sum Attaque: $sumFinel.");
    return $sumFinel;
}
public function cubethrowDef(){
    $arrCube = [rand(1,6), rand(1,6)];
    $sumCube = $arrCube[0] + $arrCube[1];
    print_r("<br> The Cube result is: $arrCube[0], $arrCube[1].");
    $sumPwoer = $this->intelligence + $this->agility;
    $sumFinel = $sumCube + $sumPwoer;
    print_r("<br> Power: $this->power, Agility: $this->agility. <br> sum Defense: $sumFinel.");
    return $sumFinel;
}
}