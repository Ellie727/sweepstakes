<?php

class Validation {
    
    private $conn;
    private $fname; 
    private $lname; 
    private $phone; 
    private $email; 
    
    public function __construct($conn, $entrant) {
        
        $this->conn = $conn;
        
        $this->fname = $entrant->getFname(); 
        $this->lname = $entrant->getLname(); 
        $this->phone = $entrant->getPhone(); 
        $this->email = $entrant->getEmail(); 

    }

    //Validates that the user's first and last name fit the appropriate format
    public function isValidName(){

        //Creates a pattern that doesn't contain any numbers
        $pattern = "/[^0-9]/";

        //Checks to see if the users input matches the pattern
        if(preg_match($pattern,$this->fname) && preg_match($pattern,$this->lname)){
          return true; 
        }
        //Otherwise returns false
        else{
           return false; 
        }
    }


    //Validates that the user's phone number fits the appropriate format and only contains 10 characters
    public function isValidPhone(){
        $pattern = "/^[0-9]*$/";

        if(preg_match($pattern,$this->phone) && $this->phone != "" && strlen($this->phone)== 10){
            return true; 
        }
        else{
            return false; 
        }
    }


    //Function that validates user's email
    public function isValidEmail(){

        //PHP function that validates if email input
        if(filter_var($this->email,FILTER_VALIDATE_EMAIL) && $this->email != ""){
            return true; 
        }
        else{
            return false; 
        }
    }


    //Function that checks to see if database contains duplicate e-mail with the use of a connection object
    public function isNotDuplicate() {

        $sql = "SELECT * FROM entries WHERE email='$this->email' LIMIT 1";

        $result = mysqli_query($this->conn,$sql);

        //Returns number of rows with duplicate e-mail.
        if ($result->num_rows > 0) {
            return false;
        }
        else {
            return true;
        }
    }
    
}



?>