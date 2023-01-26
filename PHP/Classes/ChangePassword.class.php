<!-- creating database -->
<?php
include '../Includes/Dbh.inc.php';
class ChangePassword extends Dbh{
    
    private $email;
    private $password;
    private $confirmPwd;
    
    public function __construct($email, $password, $confirmPwd) {
        
        $this->email = $email;
        $this->password = $password;
        $this->confirmPwd = $confirmPwd;
    }
    
    public function updateClientPassword() {
        
        if($this->isEmpty() == true){
            
            header("Location: ../../html/index.php?error=emptyinput");
            exit();
        }
        
        if($this->isPasswordMatch() == false){
            
            header("Location: ../../html/index.php?error=password");
            exit();
        }
        
        if($this->isClientExist() == true){
            
            header("Location: ../../html/index.php?error=clientDontExist");
            exit();
        }
        
        $this->setPassword($this->email,$this->password);
        
    }
    
    protected function setPassword($email, $password) {

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
//         $stmt = "UPDATE clients SET pwd='".$hashedPwd."' WHERE email='".$email."'";
        
//         $sql = $this->connect()->prepare('UPDATE clients SET pwd="'.$hashedPwd.'" WHERE email="'.$email.'"');
        $stmt = $this->connect()->prepare('UPDATE clients SET pwd= ? WHERE email= ?');
        
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        if(!$stmt->execute(array($email,$hashedPwd))) {
            
            $stmt = null;
            header("Location: ../../html/index.php?error=stmtfailed");
            exit();
        }
        
        $stmt = null;
       
    }
    
    protected function checkClient($email) {
        
        $stmt = $this->connect()->prepare('SELECT email FROM clients WHERE email = ?;');
        
        //failed executing on the dab
        if(!$stmt->execute(array($email))) {
            
            $stmt = null;
            header("Location: ../../html/index.php?error=stmtfailed");
            exit();
        }
        
        $checkResult;
        if($stmt->rowCount() > 0) {
            $checkResult = false;
        }
        else {
            $checkResult = true;
        }
        
        return $checkResult;
    }
    
    private function isEmpty() {
        $result;
        
        if(empty($this->email) || empty($this->password) || empty($this->confirmPwd)) {
                
            $result = true;
        }
        else {
                
            $result = false;
        }  
        return $result;
    }
    
    
    private function isPasswordMatch() {
        
        $result;
        
        if ($this->password != $this->confirmPwd) {
            
            $result = false;
        }
        else {
            
            $result = true;
        }
        
        return $result;
    }
    
    private function isClientExist() {
        
        $result;
        
        if (!$this->checkClient($this->email)) {
            
            $result = false;
        }
        else {
            
            $result = true;
        }
        
        return $result;
    }
    
}