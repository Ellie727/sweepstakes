<?php
    
//Includes necessary class files
require_once "Connection.php";
require_once "Sweepstakes.php";
require_once "Entrant.php"; 
require_once "Validation.php"; 

//User input grabbed from form sanitzes them and escapes any special characters
$fname = addslashes(filter_var($_POST['firstname'],FILTER_SANITIZE_STRING));
$lname = addslashes(filter_var($_POST['lastname'],FILTER_SANITIZE_STRING)); 
$phone = addslashes(filter_var($_POST['phone'],FILTER_SANITIZE_STRING)); 
$email = addslashes(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));

//Creates new entrant object with user entered data
$Entrant = new Entrant($fname,$lname,$phone,$email); 

//Creates a connection object
$Connection = new Connection(); 

//Creates a validation object that takes an entrant object as an argument
$Validate = new Validation($Connection->getConnected(), $Entrant); 

$Sweepstakes = new Sweepstakes($Connection->getConnected());

echo "<pre>";
//If all the user's data is validated as correct and their e-mail isn't already in the database they can be entered in the database
if($Validate->isValidName() && $Validate->isValidPhone() && $Validate->isValidEmail() && $Validate->isNotDuplicate()){

    //A connection is made to the database and entrant is entered into the sweepstakes database and success message echoed to user
    if($Sweepstakes->addEntrant($Entrant)){
        echo "Congrats $fname! You're entered to WIN!";
    }
    //Otherwise they are informed their entry could not be made
    else{
        echo "Error, Your entry could not be accepted at this time";
    }
}
//If any part of the validation is failed or there is a duplicate e-mail in the database an error message is returned
else{
    echo "Error, please be sure to enter your information and remember 1 e-mail per entrant.";
}
echo "</pre>";