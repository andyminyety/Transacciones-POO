<?php

 class ServiceCookies{   

    private $CookieName;
    private $utilities;

    public function __construct(){
        session_start();
        $this->CookieName = "Transacciones";
        $this->Utilities = new Utilities();
    }

    public function Add($item){

        $Transactions = $this->GetList();

        if(count($Transactions) == 0){
            $item->Id = 1;
        }else{

            $lastElement = $this->Utilities->GetLastElement($Transactions);

            $item->Id = $lastElement->Id + 1;
        }      

        array_push($Transactions, $item);        

        setcookie($this->CookieName,json_encode($Transactions),$this->GetCookieTime(), "/");

    }

    public function Edit($item){      

        $Transactions = $this->GetList();
        
        $Index = $this->Utilities->GetIndexElement($Transactions,"Id",$item->Id);

        if($index !== null){
            $Transactions[$Index] = $item;

            setcookie($this->CookieName,json_encode($Transactions),$this->GetCookieTime(), "/");    
        }             
    }

    public function Delete($id){
        $Transactions = $this->GetList();

        $index = $this->Utilities->GetIndexElement($Transactions,"Id",$id);

        if(count($Transactions) > 0){
            unset($Transactions[$index]);
            
            setcookie($this->CookieName,json_encode($Transactions),$this->GetCookieTime(), "/");
        }
    }

    public function GetById($id){

        $Transactions = $this->GetList();

        $Transaction = $this->Utilities->SearchProperty($Transactions,"Id",$id);     
        
        return $Transaction[0];
    }

    public function GetList(){

       $Transactions = array();

       if(isset($_COOKIE[$this->CookieName])){

         $Transactions =(array) json_decode($_COOKIE[$this->CookieName]); 

       }
       return $Transactions;
    }

    private function GetCookieTime(){
        return time() + 60 * 60 * 24 * 30;
    }   
}

?>