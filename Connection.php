
<?php

    //connection class that establishes connection with database
    class Connection {
        
        //private class variables
        private $servername; 
        private $username; 
        private $password; 
        private $dbname; 
        private $connect; 

        //connection class constructor
        public function __construct(){
            
             $this->servername = "localhost";
             $this->username = "root";
             $this->password = ""; 
             $this->dbname = "sweepstakes"; 
             
             
             //establishes connection with class variables
             $this->connect = mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);

            if (!$this->connect) {
                die("Connection failed: " . mysqli_connect_error());
            }
        }
        
        //class public function that return connection for public access
        public function getConnected(){
            
            return $this->connect; 
        }
        
            
     
    }


?>