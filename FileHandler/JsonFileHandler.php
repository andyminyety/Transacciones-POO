<?php

class JsonFileHandler extends FileHandlerBase implements IFileHandler{

    function __construct($Directory,$filename)
    {       
        parent::__construct($Directory,$filename);
    }

    function SaveFile($value){

        $this->CreateDirectory($this->Directory);
        $path = $this->Directory . "/". $this->filename . ".json";

        $serializeData = json_encode($value);

        $file = fopen($path,"w+");
        fwrite($file,$serializeData);
        fclose($file);
    }

    function ReadFile(){

        parent::CreateDirectory($this->Directory);
        $path = $this->Directory . "/". $this->filename . ".json";      

        if(file_exists($path)){
            $file = fopen($path,"r");

            $contents = fread($file,filesize($path));
            fclose($file);
            return json_decode($contents);
          
        }else{
            return false;
        }      
    }
}

?>