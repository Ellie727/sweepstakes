
<?php

class Entrant {
    
   //private variables
    private $fname; 
    private $lname; 
    private $phone; 
    private $email; 
    
    public function __construct($fname,$lname,$phone,$email) {
        $this->fname = $fname; 
        $this->lname = $lname; 
        $this->phone = $phone; 
        $this->email = $email; 

    }
    
    //Returns private variable data for public access
    public function getFname(){
        return $this->fname; 
    }
    
    //Returns private variable data for public access
    public function getLname(){
        return $this->lname; 
    }
    
    //Returns private variable data for public access
    public function getPhone(){
        return $this->phone; 
    }
    
    //Returns private variable data for public access
    public function getEmail(){
        return $this->email; 
    }
    
}


?>