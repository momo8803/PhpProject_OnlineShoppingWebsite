<?php

class client{
    
    private $email;
    private $password;
    private $confirmPwd;
    
    public function __construct($email=null, $password=null, $confirmPwd=null) {

        $this->email = $email;
        $this->password = $password;
        $this->confirmPwd = $confirmPwd;
    }
    
  
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getConfirmPwd()
    {
        return $this->confirmPwd;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param string $confirmPwd
     */
    public function setConfirmPwd($confirmPwd)
    {
        $this->confirmPwd = $confirmPwd;
    }

    public function updatePassword($conn) {
        
         $em = $this->email;
         $pwd = $this->password;
         $cpwd = $this->confirmPwd;
         
         if($this->isClientExist($conn)==false) {
             if($this->isPasswordMatch() == true) {
                 $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                 $stmt = "UPDATE clients SET password=$hashedPwd WHERE email='$em'";
                 $result = $conn->exec($stmt);
             }
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
    
    protected function checkClient($conn) {
        
        $email = $this->email;
        $stmt = $this->$conn->prepare("SELECT email FROM clients WHERE email=$email");
        
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
    
}