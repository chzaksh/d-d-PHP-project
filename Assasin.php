<?php
require_once("config.php");

// $selectPower = "SELECT * FROM `job` WHERE Job='Assassin'";
// $result = $pdo->query($selectPower);

// if ($result->rowCount() > 0) {
// // output data of each row
// while($row = $result->fetch(PDO::FETCH_ASSOC)) {
// }
// } else {
// echo "0 results";


// }

class Assasin extends Player{
    
    
  
    

 
    public function cubethrowAtt(){
        $arrCube = [rand(1,6), rand(1,6), rand(1,6)];
        array_multisort($arrCube);
        print_r("<br> The 3 Cube result is: $arrCube[0], $arrCube[1], $arrCube[2].");
        array_shift($arrCube);
        $sumCube = $arrCube[0] + $arrCube[1];
        $sumPwoer = $this->power + $this->intelligence;
        $sumFinel = $sumCube + $sumPwoer;
        print_r("<br> The two high results are: $arrCube[0], $arrCube[1]. <br> Power: $this->power, Intelligence: $this->intelligence. <br> sum Attaque: $sumFinel.");
        return $sumFinel;
    }
    public function cubethrowDef(){
        $arrCube = [rand(1,6), rand(1,6)];
        $sumCube = $arrCube[0] + $arrCube[1];
        print_r("<br> The Cube result is: $arrCube[0], $arrCube[1].");
        $sumPwoer = $this->agility + $this->dexterity;
        $sumFinel = $sumCube + $sumPwoer;
        print_r("<br> Dexterity: $this->dexterity, Agility: $this->agility. <br> sum Attaque: $sumFinel.");
        return $sumFinel;
    }

}
