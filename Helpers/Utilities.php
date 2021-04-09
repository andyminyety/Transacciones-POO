<?php

    class Utilities{

    public function GetLastElement($list){

        $countList = count($list);
        $lastElement = $list[$countList -1];

        return $lastElement;

    }

    public function SearchProperty($list,$property,$value){

        $filters = [];

        foreach($list as $item){

            if($item->$property == $value){
                array_push($filters, $item);
            }
        }

        return $filters;
    }

    public function GetIndexElement($list,$property,$value){

        foreach($list as $key => $item){

            if($item->$property == $value){             
                return $key;              
               
            }
        }
    }
}