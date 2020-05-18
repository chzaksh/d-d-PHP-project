<?php
require_once('Require.php');
require_once("config.php");



$jobs = ["Assasin", "Berseker", "Caster", "Saber", "Lancer"];
$races = ["Human", "Demon", "Elves", "Orcs", "Halfelin", "Gobelin"];
$sexes = ["Man", "Woman"];



deleteTable($pdo, 'players');//מוחק את טבלת השחקנים 
deleteTable($pdo, 'lusers');//מוחק את טבלת המפסידים 
$userPlayer = chckUser($jobs, $races, $sexes);// בדיקות האם הערך שמגיע מהמשתמש מתאים למערכים האלה
$list = randPlayer($userPlayer, $jobs, $races ,$sexes, $pdo);// קבלת 15 משתמשים אחרים
randfight($list, $pdo); // החלק של הקרב 
selectLusers($pdo); //קבלת טבלת מפסידים





function deleteTable($pdo, $data){//מוחק את השחקנים שנשארו מהטבלה
   $deletePlayers = "DELETE FROM $data"; 
   $pdo->exec($deletePlayers); 
}
function chckUser($allowed_job, $allowed_race, $allowed_sexe){  // פונקציה א בדיקת משתמש + יצירת השחקן  
  
  if(isset($_POST['job'], $_POST['race'])){
    
    $job = $_POST['job'];
    $race = $_POST['race'];
    $namePlayer = $_POST['namePlayer'];
    $sexe = $_POST['sexe'];

    foreach($job as $jobs){
      if(!in_array($jobs, $allowed_job)){
        echo " <br> error $job[0] is not value <br>";  
        die;
      }        
    }

    foreach($race as $races){
      if(!in_array($races, $allowed_race)){
      echo " <br> error $race[0] is not value <br>";  
      die;
      }      
    }

    foreach($sexe as $sexs){
      if(!in_array($sexs, $allowed_sexe)){
      echo " <br> error $sexe[0] is not value <br>";  
      die;
      }      
    }
  }
  return array("name"=>$namePlayer ,"job"=>$job[0], "race"=>$race[0], "sex"=>$sexe[0]);
}
function randPlayer($userPlayer, $jobs, $races ,$sexes, $pdo){//קבלת 16 שחקנים רנדומלים שונים
  $listFinel = [];
  $playeres = [];
  $userClass = getNewPlayer($pdo, $userPlayer);
  array_push($listFinel, $userClass);
  array_shift($userPlayer);
  array_push($playeres, $userPlayer);
  
  for ($i=0; sizeof($playeres) < 16; $i++) {// יצירת שחקן חדש
    
    $newJob = $jobs[rand(0,4)];
    $newRace = $races[rand(0,5)];
    $newSex = $sexes[rand(0,1)];
    $newPlayer = array("job"=>$newJob, "race"=>$newRace,"sex"=>$newSex);
  
    for ($i=0; $i < sizeof($playeres); $i++){//בדיקה האם השחקן קיים כבר במערך
        $flag = false;  
      if(array_diff($playeres[$i], $newPlayer)){
        continue;
      }else{
        $flag = true;
        break;
      }
    }
    
    if ($flag == false){//אם השחקן אינו קיים הוא נכנס לרשימה
    array_push($playeres ,$newPlayer);
    
    $newPlayer += ["name" => $i];  //הוספת שם
    $newPlayerClass = getNewPlayer($pdo, $newPlayer);
    array_push($listFinel, $newPlayerClass);
     
    }
  }
  return $listFinel;
}
function getNewPlayer($pdo, $player){//יצירת שחקנים עם קלאס 
    $newPlayer = new $player['job']($player["name"], $player['job'], $player['race'], $player['sex']);
    getPowerbasic($pdo, $newPlayer);
    getPowerJob($pdo, $newPlayer);
    getPowerRase($pdo, $newPlayer);
    getPowerSex($pdo, $newPlayer);
    phusDBPlayers($pdo, $newPlayer);//הכנסת השחקנים לדטה בייס
    return $newPlayer;
}
function getPowerBasic($pdo, $player){
  $selectPowerJob = 'SELECT * FROM `basic`';
  $result = $pdo->query($selectPowerJob);
  sum($result, $player);
}
function getPowerJob($pdo, $player){
  $job = ($player->getJob());
  $selectPowerJob = 'SELECT * FROM `job` WHERE Job =' . "'$job'" . '';
  $result = $pdo->query($selectPowerJob);
  sum($result, $player);
}
function getPowerRase($pdo, $player){
  $race = ($player->getRace());
  $selectPowerRace = 'SELECT * FROM `race` WHERE Race =' . "'$race'" . '';
  $result = $pdo->query($selectPowerRace);
  sum($result, $player);
}
function getPowerSex($pdo, $player){
  $sex = ($player->getSex());

  if($player->getJob() == 'Caster' && $player->getSex() == "Man"){
    $sex = 'CasterMan';
  } 
  
  $selectPowerSex = 'SELECT * FROM `sexe` WHERE Sexe =' . "'$sex'" . '';
  $result = $pdo->query($selectPowerSex);
  sum($result, $player);
}
function sum($result, $player){
  if ($result->rowCount() > 0 ) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $player->setPower($row['Power']); 
    $player->setDexterity($row['Dexterity']); 
    $player->setIntelligence($row['Intelligence']); 
    $player->setCharism($row['Charism']); 
    $player->setAgility($row['Agility']); 
    $player->setLife($row['Life']); 
    $player->setSum();
    }
  } else {
    echo "0 results";
  }
}
function phusDBPlayers($pdo, $player){//הכנסת השחקנים לדטה בייס
  $sql = "INSERT INTO players (player, pow, dex ,intel, charism, agility, life) VALUES (?,?,?,?,?,?,?)";
  $result = $pdo->prepare($sql);
  $result->execute([$player->getName(), $player->getPower(), $player->getDexterity(), $player->getIntelligence(), $player->getCharism(), $player->getAgility(), $player->getLife()]);  
}
function randfight($list, $pdo){//קריאה רנדומלית לקרב עד שנשאר האחרון
  echo "<br><br> Eighth final <br><br>";
  $eighthFinal = creatingFight($list, $pdo);
  echo "<br><br> Quarter-finals <br><br>";
  $quarter = creatingFight($eighthFinal, $pdo);
  echo "<br><br> Semifinals <br><br>";
  $semifinals =  creatingFight($quarter, $pdo);
  echo "<br><br> final <br><br>";
  $theWIner = creatingFight($semifinals, $pdo);
  var_dump($theWIner);
}
function creatingFight($list, $pdo){

  $sumPlayerInList = sizeof($list)/2;
  $listWiners = [];

  for ($i = 0; $i < $sumPlayerInList; $i++){
     
    $sizeList = sizeof($list) -1;
      echo "<br> fight no:" . ($i + 1);
      $player1 = $list[rand(0,$sizeList)];
      $player2 = $list[rand(0,$sizeList)];
    
      for ($j=0; $player1 == $player2; $j++){ 
      $player2 = $list[rand(0,$sizeList)];
      }

      $luser = fight($player1, $player2);
     
      
      $numWiner =  array_search($luser[0], $list);
      $playerWiner = array_splice($list, $numWiner, 1);
      $numLuser = array_search($luser[1], $list);
      $playerLuser = array_splice($list, $numLuser, 1);
           
      array_push($listWiners, $luser[0]);
     
      tableLusers($pdo, $playerLuser, ($i + 1));//הכנסת מפסיד לטבלה
    }
    return $listWiners;
}
function whosFirst($player1, $player2){// בדיקה מי משחק ראשון ע"י גו'ב ואם אין הכרעה אז בדיקה ע"י קוביה
  var_dump($player1, $player2);
  
  if ($player1->getJob() == 'Lancer' || $player2->getJob() == 'Lancer'){
     if($player1->getJob() == 'Lancer' && $player2->getJob() == 'Lancer'){
      echo "<br> Both players with the gob Lancer, the decision will go to the cube";
      return  cubePlayFiest($player1, $player2);
    }elseif($player1->getJob() == 'Lancer'){
      echo "<br> the Job of " . $player1->getName() ." is Lancer";
      return  [$player1, $player2];
    }else{
      echo "<br> the Job of " . $player2->getName() ." is Lancer";
      return  [$player2, $player1];
    }
    
  }elseif ($player1->getJob() == 'Berseker' || $player2->getJob() == 'Berseker'){
    if($player1->getJob() == 'Berseker' && $player2->getJob() == 'Berseker'){
      echo "<br>  Both players with the gob Berseker, the decision will go to the cube";
      return cubePlayFiest($player1, $player2);
    }elseif($player1->getJob() == 'Berseker'){
      echo "<br> the Job of " . $player1->getName() ." is Berseker";
      return  [$player2, $player1];
    }else{
      echo "<br> the Job of " . $player2->getName() ." is Berseker";
      return  [$player1, $player2];
    }
  }else{
    return cubePlayFiest($player1, $player2);
  } 
}
function cubePlayFiest($player1, $player2){//בדיקה מי ראשון ע"י קוביה
  echo "<br> Players will throw cube to know who's first  
  <br> the cube for player " . $player1->getName(). "  is: ";
  $cubePlayer1 = $player1->cube() + $player1->getCharism();
  echo "<br> the cube for player " . $player2->getName(). " is: ";
  $cubePlayer2 = $player2->cube() + $player2->getCharism();
  echo "<br> The sum of cube & Charism " . $player1->getName() . " is: $cubePlayer1" . 
  "<br> The sum of cube & Charism " . $player2->getName() . " is: $cubePlayer2";
  
  for ($i=0; $cubePlayer2 == $cubePlayer1; $i++){
    echo "<br> even. <br> Players will throw cube to know who's first";
    "<br> the cube for player " . $player1->getName(). "  is: ";
    $cubePlayer1 = $player1->cube() + $player1->getCharism();
    echo "<br> the cube for player " . $player2->getName(). " is: ";
    $cubePlayer2 = $player2->cube() + $player2->getCharism();
    echo "<br> The sum of cube & Charism " . $player1->getName() . " is: $cubePlayer1" . 
    "<br> The sum of cube & Charism " . $player2->getName() . " is: $cubePlayer2";
  }

    

  if ($cubePlayer1 > $cubePlayer2){
    return [$player1, $player2];  
  }else{
    return [$player2, $player1]; 
  }
}
function att($player1, $player2){
  echo "<br><br><br><br> The " . $player1->getName() . " attacks";
  $att = $player1->cubethrowAtt();
  if ($att != 0){
    echo "<br><br> The " . $player2->getName() .  " is defending";
    $def = $player2->cubethrowDef();
    if ($att > $def){
      $player2->setLife(-1);
      echo "<br> The number of lives left to the "  . $player2->getName() . " are: " . $player2->getLife();
    }
  }   
}
function fight($player1, $player2){
  
  
  echo "<br>name playerOne is: " . $player1->getName() . " vs name playerTwo is: " . $player2->getName();
  $firstPlayer = whosFirst($player1, $player2);// בדיקה מי מתחיל
  echo  " <br> the first player is: " . $firstPlayer[0]->getName();
  
  
  for($i=0;  $player1->getLife() > 0  && $player2->getLife() > 0 ; $i++){
    att($firstPlayer[0], $firstPlayer[1]);
    
    if ($firstPlayer[1]->getLife() == 0){
      echo "<br>" . $firstPlayer[0]->getName() . " win! <br>";
      $firstPlayer[0]->setSum();
      return [$firstPlayer[0], $firstPlayer[1]];
    }

    att($firstPlayer[1], $firstPlayer[0]);

    if ($firstPlayer[0]->getLife() == 0){
      echo "<br>" . $firstPlayer[1]->getName() . " win! <br>";
      $firstPlayer[1]->setSum();
      return [$firstPlayer[1], $firstPlayer[0]];
    }
  }
}
function tableLusers($pdo, $luser, $id){//הכנסת מפסיד לטבלה
  $sql = "INSERT INTO lusers (luser_num, player_name, job, race ,sex) VALUES (?,?,?,?,?)";
  $result = $pdo->prepare($sql);
  $result->execute([$id, $luser[0]->getName(), $luser[0]->getJob(), $luser[0]->getRace(), $luser[0]->getSEX()]); 
}
function selectLusers($pdo){
  $selectLusers = 'SELECT * FROM `lusers`';
  $result = $pdo->query($selectLusers);
  if ($result->rowCount() > 0 ) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    var_dump($row);
    }
  } else {
    echo "0 results";
  }
}

