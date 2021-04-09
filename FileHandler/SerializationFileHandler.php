<?php

class SerializationFileHandler extends FileHandlerBase implements IFileHandler{

    function __construct($Directory,$filename)
    {       
        parent::__construct($Directory,$filename);
    }

    function SaveFile($value){

        $this->CreateDirectory($this->Directory);
        $path = $this->Directory . "/". $this->filename . ".txt";

        $serializeData = serialize($value);

        $file = fopen($path,"w+");
        fwrite($file,$serializeData);
        fclose($file);
    }

    function ReadFile(){

        $this->CreateDirectory($this->Directory);
        $path = $this->Directory . "/". $this->filename . ".txt";

        if(file_exists($path)){
            $file = fopen($path,"r");

            $contents = fread($file,filesize($path));
            fclose($file);
            return unserialize($contents);
          
        }else{
            return false;
        }      
    }
}