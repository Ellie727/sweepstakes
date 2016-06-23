<?php

require_once "Connection.php";
require_once "Sweepstakes.php";

//Creates a connection to db
$Connection = new Connection(); 

//Creates a sweepstakes object
$Sweepstakes = new Sweepstakes($Connection->getConnected());

//Retrieves winners of sweepstakes
$winners = $Sweepstakes->getWinners();

echo "<pre>";
echo "Winners:\n\n";
print_r($winners);
echo "<pre>";