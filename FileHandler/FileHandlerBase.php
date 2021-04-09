<?php

    class FileHandlerBase{

        protected $Directory;
        protected $filename;


        function __construct($Directory,$filename)
        {
            $this->Directory = $Directory;
            $this->filename = $filename;
        }

        function CreateDirectory($path){

            if(!file_exists($path)){
                mkdir($path,0777,true);
            }
        }
    }