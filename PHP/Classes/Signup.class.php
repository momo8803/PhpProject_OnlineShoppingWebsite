<!-- changing something in database -->
<?php

class Signup extends Dbh{
    
    private $uid;
    private $name;
    private $address;
    private $phone;
    private $email;
    private $password;
    private $confirmPwd;
    
    public function __construct($name,$address,$phone,$email,$password,$confirmPwd) {   
        
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPwd = $confirmPwd;
    }
    
    public function signupClient(){
        if($this->isEmpty() == true){
            
            header("Location: ../../html/signUp.php?error=emptyinput");
            exit();
        }
//         if($this->isValidPhone() == false){
            
//             header("Location: ../../html/index.php?error=phone");
//             exit();
//         }
        if($this->isPasswordMatch() == false){
            
            header("Location: ../../html/signUp.php?error=passwordNotMatch");
            exit();
        }
        if($this->isValidEmail() == false){
            
            header("Location: ../../html/signUp.php?error=invalidEmail");
            exit();
        }
        if($this->isClientExist() == false){
            
            header("Location: ../../html/signUp.php?error=clientExist");
            exit();
        }
        
        $this->setClient($this->name,$this->address,$this->phone,$this->email,$this->password);
    }
    
    private function isEmpty() {
        $result;
        
        if(empty($this->name) || empty($this->address) || empty($this->phone) || empty($this->email) || 
            empty($this->password) || empty($this->confirmPwd)) {
                
                $result = true;
        }
        else {
            
            $result = false;
        }
        
        return $result;
    }
    
    private function isValidEmail() {
        $result;
        
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                
                $result = false;
            }
            else {
                
                $result = true;
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
    
    protected function setClient($name,$address,$phone,$email,$password) {
        
        $stmt = $this->connect()->prepare('INSERT INTO clients (name, address, phone, email, pwd) VALUES (?, ?, ?, ?, ?);');
        
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        if(!$stmt->execute(array($name,$address,$phone,$email,$hashedPwd))) {
            
            $stmt = null;
            header("Location: ../../html/signUp.php?error=stmtfailed");
            exit();
        }
        
        $stmt = null;
    }
    
    protected function checkClient($email) {
        
        $stmt = $this->connect()->prepare('SELECT email FROM clients WHERE email = ?;');
        
        //failed executing on the dab
        if(!$stmt->execute(array($email))) {
            
            $stmt = null;
            header("Location: ../../html/signUp.php?error=stmtfailed");
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
}