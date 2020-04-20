<?php
class db_connect {
    public function connect(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "images";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if ($conn) {
            return $conn;
        }else{
            return die("Connection failed: " . mysqli_connect_error());
        }
    }
}
