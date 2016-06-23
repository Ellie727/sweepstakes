<?php

    //Class that enters Entrants into db and runs sweepstakes
    class Sweepstakes {

        private $conn;
        
        //Class constructor that takes connection to db as argument
        public function __construct($conn) {

            $this->conn = $conn;

        }
        
        //Function that runs a sweepstakes and takes number of winners to be selected as an argument
        public function runSweepstakes($numWinners) {
            
            $sql = "SELECT * FROM entries ORDER BY RAND() LIMIT $numWinners";

            $result = mysqli_query($this->conn,$sql);
            
            //If there are enough entries an associative array of winners is created
            if($result->num_rows >= $numWinners){
                $winners = array();
                while ($row = $result->fetch_assoc()) {
                    $winners[] = $row;
                }
                 //If winners are successfully recorded the array is returned
                if ($this->recordWinners($winners)) {
                    return $winners;
                }
                else {
                    return "Failed to record winners!";
                }
            }//Otherwise if there are not enough entrants an error message is returned
            else{
                return "Not enough entrants!";
            }
        }

        //Function that enters entrant into database
        public function addEntrant($entrant){

            //Inserts Entrant into the entries table along with the date and time of their entry
            $sql = "INSERT INTO entries (firstname,lastname,phone,email,entry_date_time) values ('"
                    . $entrant->getFname() . "','"
                    . $entrant->getLname() . "','"
                    . $entrant->getPhone() . "','"
                    . $entrant->getEmail() . "','"
                    . date("Y-m-d H:i:s") . "');";

            //If successfully connected and entered the function returns true
            if(mysqli_query($this->conn,$sql)){

                return true; 
            }
            //Otherwise false is returned
            else{

                return false; 
            }

        }
        
        //Function that records winners in the database along with the date and time
        private function recordWinners($winners) {
            //Insert command
            $sql = "INSERT INTO winners (entrant_id,sweeps_date_time) values ";

            // Gets current time
            $now = date("Y-m-d H:i:s");
            
            //For each winner their id and sweeps time and date are entered into the winners table
            foreach($winners as $winner) {
                $sql .= "('" . $winner['id'] . "','" . $now . "'),";
            }
            // trim off last comma from the list and add semicolon to make valid sql
            $sql = rtrim($sql, ',') . ";";

            //If successfully connected and entered the function returns true
            if(mysqli_query($this->conn,$sql)){

                return true; 
            }
            //Otherwise false is returned
            else{

                return false; 
            }
        }
        
        //Function that gets winners for displaying to visitors
        public function getWinners() {
            // Select all entry information from (the entry ids who won on (the latest sweepstakes date))
            $sql = "SELECT * FROM entries WHERE id IN ("
                    . "SELECT entrant_id FROM winners WHERE sweeps_date_time=("
                        . "SELECT sweeps_date_time FROM winners ORDER BY sweeps_date_time DESC LIMIT 1"
                    . ") ORDER BY id ASC);";

            $result = mysqli_query($this->conn,$sql);

            if($result){

                $winners = array();

                while ($row = $result->fetch_assoc()) {
                    $winners[] = $row;
                }

                return $winners;
            }
            else{
                return "No sweepstakes have been run!";
            }
        }
}