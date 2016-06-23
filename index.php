<!DOCTYPE html>
<html>
    <head>
        <!---Link to CSS -->
        <link rel="stylesheet" type="text/css" href="bin/css/style.css">
        
        <!---Link to JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        
        <!---Link to BOOTSTRAP -->
         <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
         
         <!---Link to Google Raleway Font-->
         <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        
    </head>
    
    <body>
        
       
        <div class="sweepstakeEntry center container" id="sweeps">
            
            <h1> Enter to WIN BIG! </h1>
            
            <!--Form for user registration information -->
            <form action="registration.php" method="post">
                First Name:<br><input type ="text" name="firstname"><br>
                Last Name: <br><input type ="text" name="lastname"><br>
                Phone #: <br><input type ="text" name="phone"><br>
                E-mail: <br><input type ="text" name="email"><br>
                <input type="submit" value="Submit" class="submitButton" id="submitButton">
            </form>
        </div>

    </body>
</html>
