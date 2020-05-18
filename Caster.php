<?php

class Caster extends Player{
private $lifeHelp =0;
        

    
public function cubethrowAtt(){
    if($this->life == 1 && $this->lifeHelp == 0){
        $this->life++;
        $this->lifeHelp++;
        echo "<br> The player used the rescue option and added 1 life";
        return 0;        
    }else{
        $arrCube = [rand(1,6), rand(1,6)];
        $sumCube = $arrCube[0] + $arrCube[1];
        print_r("<br> The Cube result is: $arrCube[0], $arrCube[1].");
        $sumPwoer = $this->intelligence + $this->dexterity;
        $sumFinel = $sumCube + $sumPwoer;
        print_r("<br> Intelligence: $this->intelligence, Dexterity: $this->dexterity.<br>  sum Attaque:  $sumFinel.");
        return $sumFinel;
    }    
}

public function cubethrowDef(){
    $arrCube = [rand(1,6), rand(1,6)];
    $sumCube = $arrCube[0] + $arrCube[1];
    print_r("<br> The Cube result is: $arrCube[0], $arrCube[1].");
    $sumPwoer = $this->intelligence + $this->agility;
    $sumFinel = $sumCube + $sumPwoer;
    print_r("<br> Intelligence: $this->intelligence, Agility: $this->agility. <br> sum Defense: $sumFinel.");
    return $sumFinel;
}

}