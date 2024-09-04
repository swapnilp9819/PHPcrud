<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Password@123');
define('DB_NAME', 'userdata');
define('DB_PORT','3307');
// check for port number as default is 3306, I already have a mysql installation therefore I had to configure my XAMP server's mysql on port 3307

// try connecting to the database

$conn=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

// chech connection
if($conn==false){
    dir('Error: cannot connect');
}




?>
