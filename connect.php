<?php
    
        $server = "localhost";
        $userid = "ujshry056epnz";
        $pw = "gshsjkmcea9k";
        $db= "dbtwkenloucnmi"; 

        $conn = new mysqli($server, $userid, $pw);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $conn->select_db($db);

        
        return $conn;
    
?>