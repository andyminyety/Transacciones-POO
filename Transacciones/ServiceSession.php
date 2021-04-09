<?php

 class ServiceSession{   

    private $SessionName;

    private $Utilities;

    public function __construct(){
        session_start();
        $this->SessionName = "TransactionsList";
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

       $_SESSION[$this->SessionName] = $Transactions;         
    }

    public function Edit($item){      

        $Transactions = $this->GetList();
        
        $index = $this->Utilities->GetIndexElement($Transactions,"Id",$item->Id);

        if($index !== null){
            $Transactions[$index] = $item;
            $_SESSION[$this->sessionName] = $Transactions;    
        }             
    }

    public function Delete($id){
        $Transactions = $this->GetList();

        $index = $this->Utilities->GetIndexElement($Transactions,"Id",$id);

        if(count($Transactions) > 0){
            unset($Transactions[$index]);
            $_SESSION[$this->SessionName] = $Transactions;  
        }
    }

    public function GetById($id){

        $Transactions = $this->GetList();

        $Transaction = $this->Utilities->SearchProperty($Transactions,"Id",$id);     
        
        return $Transaction[0];
    }

    public function GetList(){

        $Transactions = isset($_SESSION[ $this->SessionName]) ? $_SESSION[ $this->SessionName] : [];
        
        return $Transactions;

    }

    
   
}


?>



