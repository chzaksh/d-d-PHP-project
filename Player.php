<?php

 




abstract class Player{

protected $name = null;
protected $job = null;
protected $race = null;
protected $sexe = null;
protected $power = 0;
protected $dexterity = 0;
protected $intelligence = 0;
protected $charism = 0;
protected $agility = 0;
protected $life = 0;
protected $sum = 0;

public function setNameUser($name){
    $this->name = $name;
}

public function getNameUser(){
    return $this->name;
}

abstract public function cubethrowAtt();
abstract public function cubethrowDef();

public function __construct($name = null, $job = null, $race = null, $sexe = null){
    
    if ($name){
        $this->name = $name;
    }else{
        $this->name = rand(1,10000);
    }        
    $this->sexe = $sexe;
    $this->job = $job;
    $this->race = $race;
}

public function getJob(){
    return $this->job;
}

public function getRace(){
    return $this->race;
}

public function getSex(){
    return $this->sexe;
}

public function getName(){
    return $this->name;
}

public function getPower(){
    return $this->power;
}

public function getDexterity(){
    return $this->dexterity;
}

public function getIntelligence(){
    return $this->intelligence;
}

public function getCharism(){
    return $this->charism;
}

public function getAgility(){
    return $this->agility;
}

public function getLife(){
    return $this->life;
}

public function cube(){
    $cube = rand(1,6) + rand(1,6);
    echo "<br> $cube";
    return $cube;
}

public function setPower($num){
    $this->power += $num;
}

public function setDexterity($num){
    $this->dexterity += $num;

}

public function setIntelligence($num){
    $this->intelligence += $num;
}

public function setCharism($num){
    $this->charism += $num;
}

public function setAgility($num){
    $this->agility += $num;
}

public function setLife($num){
    $this->life += $num;
}

public function setSum(){
    $this->sum = $this->life + $this->agility + $this->charism + $this->intelligence + $this->dexterity + $this->power;
}  

} 