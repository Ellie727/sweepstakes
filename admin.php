<?php

require_once "Connection.php";
require_once "Sweepstakes.php";

$Connection = new Connection();
$Sweepstakes = new Sweepstakes($Connection->getConnected()); 

//Runs sweepstakes and sends the argument of 3 to pick 3 winners
$winners = $Sweepstakes->runSweepstakes(3);

//Echos winners in formated way
echo "<pre>";
echo "Sweepstakes Results:\n\n";
print_r($winners);
echo "<pre>";

?>