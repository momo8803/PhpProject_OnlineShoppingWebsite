<?php
class Product extends Dbh{
    
    private $productId;
    private $description;
    private $categoryId;
    private $price;
    private $productName;
    private $img;
    
    
    public function __construct($productId=null,$description=null,$categoryId=null,$price=null,$productName=null,$img=null){
        $this->productId=$productId;
        $this->description=$description;
        $this->categoryId=$categoryId;
        $this->price=$price;
        $this->productName=$productName;
        $this->img=$img;
        
  
    }
    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    
    public function getProductName()
    {
        return $this->productName;
    }
    
    public function getImg()
    {
        return $this->img;
    }
    
    
    
    
    

    /**
     * @param string $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }
    
    public function setImg($img)
    {
        $this->img = $img;
    }
    
    
    
     
    
    public static function getHeader(){
        $header="<table border='1'>";
        $header="$header<tr><th>productName</th><th>description</th><th>Price</th>";
        $header="$header<th>Img</th></tr>";
        return $header;
        
    }
    
    public static function getFooter(){
        return "</table>";
        
    }
    //     public function __toString(){
    
    
    
//     public function __toString(){
//         $toString="<tr><td>$this->productId</td><td>$this->description</td><td>$this->categoryId</td>";
//         $toString="$toString<td>$this->price</td><td>$this->productName</td><td>$this->img</td></tr>";
//         return $toString;
        
//     }

    
    public function __toString(){
        $toString="<tr><td>$this->productName</td><td>$this->description</td>";
        $toString="$toString<td>$this->price</td><td></td></tr>";
        return $toString;
    
    }
    
    
    
    public function getAllproducts($connection){
        $counter=0;
        $sqlStmt="select * from products";
        foreach($connection->query($sqlStmt)as $oneRow){
            $product=new Product();
            $product->setProductId($oneRow["productId"]);
            $product->setDescription($oneRow["description"]);
            $product->setCategoryId($oneRow["categoryId"]);
            $product->setPrice($oneRow["price"]);
            
            $tabProducts[$counter++]=$product;
        }
        return serialize($tabProducts);
              
    }
    
//     public function getProductById($connection){
//         $id=$this->productId;
//         $sqlStmt="select * from products where ProductId=:p1";
//         $prepare=$connection->prepare($sqlStmt);
//         $prepare->bindValue(":p1",$id,PDO::PARAM_INT);
//         $prepare->execute();
//         $result=$prepare->fetchAll();
//         $tobj="";
//         if(sizeof($result)>0){
//             $tobj=new Product();
//             $tobj->setProductId($result[0]["ProductId"]);
//             $tobj->setDescription($result[0]["Description"]);
//             $tobj->setCategoryId($result[0]["CategoryId"]);
//             $tobj->setPrice($result[0]["Price"]);
            
//         }
//         return serialize($tobj);
        
//     }
    
    
    public function getProductById($connection){
        $id=$this->productName;
        $sqlStmt="SELECT * FROM `products` WHERE `ProductName` LIKE '%$id%'";
        $prepare=$connection->prepare($sqlStmt);
        //$prepare->bindValue($id,PDO::PARAM_STR_CHAR);
        $prepare->execute();
        $result=$prepare->fetchAll();
        $tobj="";
        if(sizeof($result)>0){
            $tobj=new Product();
          //  $tobj->setProductId($result[0]["ProductId"]);
            $tobj->setProductName($result[0]["ProductName"]);
            $tobj->setDescription($result[0]["Description"]);
          //  $tobj->setCategoryId($result[0]["CategoryId"]);
            $tobj->setPrice($result[0]["Price"]);
            $tobj->setImg($result[0]["Img"]);
            
        }
        return serialize($tobj);
        
    }
    
    
    
    public static function displayOneProduct($result){
        echo Product::getHeader();
        echo $result;
        echo Product::getFooter();
        
    }
    
   
    
}
    
    