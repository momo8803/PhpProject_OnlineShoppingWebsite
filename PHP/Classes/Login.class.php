<!-- creating database -->
<?php

class Login {
    
    private $email;
    private $password;
    
    public function __construct($email, $password) {
        
        $this->email = $email;
        $this->password = $password;
    }
    
    
    function isEmpty() {
        $result;
        
        if(empty($this->email) || empty($this->password)) {
                
                $result = true;
            }
            else {
                
                $result = false;
            }
            
            return $result;
    }
    
    function clientExists($conn) {
        $sql = "SELECT * FROM clients WHERE email = ?;";
        
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../html/login.php?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $this->email);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($result)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
        
        mysqli_stmt_close();
    }
    
   function loginClient($conn) {
        if($this->clientExists($conn) === false) {
            header("Location: ../../html/login.php?error=clientdoesntexist");
            exit();
        }
        
        $sql = "SELECT * FROM clients WHERE email = ?;";
        
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../html/login.php?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $this->email);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        
        if($row = mysqli_fetch_assoc($result)) {
            $pwdHashed = $row['pwd'];
            $checkPwd = password_verify($this->password, $pwdHashed);
            
            if($checkPwd === false) {
                header("Location: ../../html/login.php?error=wrongpassword");
                exit();
            }
            elseif($checkPwd === true) {
                session_start();
                
                $_SESSION["client_id"] = true;
                $_SESSION["email"] = true;
                $_SESSION["name"] =$row["name"];
                
                header("Location: ../../html/index.php");
//                 exit();
            }
        }
        
    }
}