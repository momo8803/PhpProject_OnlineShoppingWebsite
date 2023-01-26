<?php 

class Dbh {
    
    protected  function connect() {
        
        try {
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=127.0.0.1;dbname=dbshopping', $username, $password);
//             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $dbh;
        } catch (PDOException $e) {
            
            print "Error! : " .$e->getMessage(). "<br/>";
            die();
        }
    }
}